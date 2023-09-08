<?php

namespace App\Http\Controllers;

use Faker\Core\File;
use App\Models\Customer;
use App\Models\QR_details;
use Illuminate\Http\Request;
use nguyenary\QRCodeMonkey\QRCode;
use Illuminate\Support\Facades\File as FacadesFile;

class QRDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('id','DESC')->get();
        return view('qr.index', ['customers' => $customers]);
    }

    public function upload(Request $request){
        if ($request->file !== "undefined") {
                $path = time() . '_' . $request->file->getClientOriginalName();
                $request->file->move('logos/', $path);
            } else {
                $path = "";
            }
        return $path;
    }

    public function generate(Request $request)
    {
        $customer =  Customer::find($request->customer_id);
        $qr_url = env('APP_URL') . '/' . $customer->url_path;
        $qrcode = new QRCode($qr_url);
        if ($request->single_color == 1) {
            $qrcode->setConfig([
                'bgColor' => $request->bgcolor1,
                'body' => $request->bodylogo,
                'bodyColor' => $request->hexcolor,
                'eye' => $request->eyelogo,
                'eye1Color' => $request->eyecolor1,
                'eye2Color' => $request->eyecolor2,
                'eye3Color' => $request->eyecolor3,
                'eyeBall1Color' => $request->eyeballcolor1,
                'eyeBall2Color' => $request->eyeballcolor2,
                'eyeBall3Color' => $request->eyeballcolor3,
                'eyeBall' => $request->eyeball,
            ]);
        } else {
            $qrcode->setConfig([
                'bgColor' => $request->bgcolor1,
                'body' => $request->bodylogo,
                'gradientType' => $request->gradientType,
                'gradientColor1' => $request->hexcolor,
                'gradientColor2' => $request->gradient,
                'eye' => $request->eyelogo,
                'eye1Color' => $request->eyecolor1,
                'eye2Color' => $request->eyecolor2,
                'eye3Color' => $request->eyecolor3,
                'eyeBall1Color' => $request->eyeballcolor1,
                'eyeBall2Color' => $request->eyeballcolor2,
                'eyeBall3Color' => $request->eyeballcolor3,
                'eyeBall' => $request->eyeball,
            ]);
        }
        // return strlen($request->uploadphoto_path);
        if(strlen($request->uploadphoto_path) > 10){
            $qrcode->setLogo($request->uploadphoto_path);
        }
        $qrcode->setSize(2000);
        $time = time();
        $qrcode->setFileType('eps');
        $filpath = 'qrcodes/'.$customer->url_path.'/'. $customer->url_path . '_' .$time . '.eps';
        $qrcode->create($filpath);

        $qrcode->setFileType('svg');
        $filpath = 'qrcodes/'.$customer->url_path.'/'. $customer->url_path . '_' . $time . '.svg';
        $qrcode->create($filpath);

        $qrcode->setFileType('png');
        $filpath = 'qrcodes/'.$customer->url_path.'/'. $customer->url_path . '_' . $time . '.png';
        $qrcode->create($filpath);
        $customer->qr_path = '/' . $filpath;
        $customer->save();


        return $filpath;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QR_details  $qR_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qr_details = Customer::find($id);
        return view('qr.edit')->with('qr_details', $qr_details);
    }
}
