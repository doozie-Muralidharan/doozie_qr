<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $packages = Package::all();
        return view('masters.customer.create')->with('packages',$packages);
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
            'company_name' => 'required',
            'display_name' => 'required',




        ]);
        //  DD($request->all());
        $customer = new Customer;
        $customer->company_name = $request['company_name'];
        $customer->url_path = Str::slug($request['company_name']);
        $customer->display_name = $request['display_name'];
        $customer->email = $request['email'];
        $customer->gst_number = $request['gst_number'];
        $customer->address = $request['address'];
        $customer->website = $request['website'];
        $customer->package_id = $request['package_id'];

        if ($request->customer_logo) {
            $fileName1 = time() . '_' . $request->customer_logo->getClientOriginalName();
            $request->customer_logo->move('uploads/customer_logo/', $fileName1);
            $customer->logo_path = $fileName1;
        }
        $customer->contact_no = $request['contact_no'];
        $customer->facebook_link = $request['facebook_link'];
        $customer->instagram_link = $request['instagram_link'];
        $customer->zomato = $request['zomato'];


        $customer->save();

        $password = empty($request['password']) ? Str::random(6) : $request['password'];
        $hashedPassword = Hash::make($password);

        $user = new User;
        $user->username = $customer->company_name;
        $user->email = $customer->email;
        $user->customer_id = $customer->id;
        $user->role = 'customer';
        $user->password = $hashedPassword;

        $user->save();
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
        $packages = Package::all();
        return view('masters.customer.edit')->with('customer', $customer)->with('packages',$packages);
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
            'company_name' => 'required',
            'display_name' => 'required',

        ]);

        $customer =  Customer::find($customer->id);
        $customer->company_name = $request['company_name'];
        $customer->url_path = Str::slug($request['company_name']);
        $customer->display_name = $request['display_name'];
        //  hidden_customer_logo
        if ($request->customer_logo == "") {
            $customer->logo_path = $request['hidden_customer_logo'];
        } else {
            $fileName1 = time() . '_' . $request->customer_logo->getClientOriginalName();
            $request->customer_logo->move('uploads/customer_logo/', $fileName1);
            $customer->logo_path = $fileName1;
        }
        $customer->contact_no = $request['contact_no'];
        $customer->website = $request['website'];
        $customer->facebook_link = $request['facebook_link'];
        $customer->instagram_link = $request['instagram_link'];
        $customer->zomato = $request['zomato'];


        $customer->email = $request['email'];
        $customer->gst_number = $request['gst_number'];
        $customer->address = $request['address'];

        $customer->save();


        toastr()->success('Customer updated successfully');
        return redirect()->route('customers.index');
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
