<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Prgayman\QRCodeMonkey\QRCode\CustomeGenerate;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::orderBy('id', 'DESC')->get();
        return view('masters.customer.index', ['customers' => $customer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_name' => 'required',
            'display_name' => 'required',

            //'contact_no_for_webpage' => 'required',
            'contact_type' => 'required',
            'contact_type_value' => 'required',



        ]);
        //  DD($request->all());
        $customer = new Customer;
        $customer->restaurant_name = $request['restaurant_name'];
        $customer->url_path = Str::slug($request['restaurant_name']);
        $customer->display_name = $request['display_name'];
        $customer->type = $request['type'];
        $customer->link_type = $request['link_type'];
        $customer->external_link = $request['external_link'];
        $customer->contact_type = $request['contact_type'];
        $customer->contact_type_value = $request['contact_type_value'];
        if ($request->customer_logo) {
            $fileName1 = time() . '_' . $request->customer_logo->getClientOriginalName();
            $request->customer_logo->move('uploads/customer_logo/', $fileName1);
            $customer->logo_path = $fileName1;
        }
        $customer->contact_no_for_webpage = $request['contact_no_for_webpage'];
        $customer->contact_no = $request['contact_no'];
        $customer->facebook_link = $request['facebook_link'];
        $customer->instagram_link = $request['instagram_link'];
        $customer->zomato = $request['zomato'];

        $customer->website = $request['website'];

        $customer->save();
        toastr()->success('Customer added successfully');
        //DD($request->all());
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('masters.customer.edit')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {

        request()->validate([
            'restaurant_name' => 'required',
            'display_name' => 'required',

            //'contact_no_for_webpage' => 'required',
            'contact_type' => 'required',
            'contact_type_value' => 'required',

            // 'contact_no_for_webpage' => 'required'

        ]);

        $customer =  Customer::find($customer->id);
        $customer->restaurant_name = $request['restaurant_name'];
        $customer->url_path = Str::slug($request['restaurant_name']);
        $customer->display_name = $request['display_name'];
        //  hidden_customer_logo
        if ($request->customer_logo == "") {
            $customer->logo_path = $request['hidden_customer_logo'];
        } else {
            $fileName1 = time() . '_' . $request->customer_logo->getClientOriginalName();
            $request->customer_logo->move('uploads/customer_logo/', $fileName1);
            $customer->logo_path = $fileName1;
        }
        $customer->contact_no_for_webpage = $request['contact_no_for_webpage'];
        $customer->contact_no = $request['contact_no'];
        $customer->website = $request['website'];
        $customer->facebook_link = $request['facebook_link'];
        $customer->instagram_link = $request['instagram_link'];
        $customer->zomato = $request['zomato'];
        $customer->contact_type = $request['contact_type'];
        $customer->contact_type_value = $request['contact_type_value'];

        $customer->type = $request['type'];
        $customer->link_type = $request['link_type'];
        $customer->external_link = $request['external_link'];

        $customer->save();
        toastr()->success('Category updated successfully');
        return redirect('customer');
    }

    public function changeStatus(Request $request)
    {
        $customers =  Customer::find($request->customer_id);
        $customers->status = $request->status;
        $customers->save();

        //toastr()->success('Status changed auccessfully');

        return response()->json(['success' => 'Status updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $customer = Customer::find($id);
        $customer->delete();
        toastr()->success('Customer deleted successfully');
        return redirect()->back();
    }
    public function active($id)
    {
        $active = Customer::find($id);
        $active->status = '0';
        $active->save();
        toastr()->success('Status activated');
        return redirect()->back();
    }

    public function inactive($id)
    {
        $active = Customer::find($id);
        $active->status = '1';
        $active->save();
        toastr()->success('Status deactivated');
        return redirect()->back();
    }
}
