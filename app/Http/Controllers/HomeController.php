<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Customer;

class HomeController extends Controller
{

    public function index()
    {
        $customers = Customer::count();

        return view('masters.dashboard')->with('customers',$customers);
    }
}
