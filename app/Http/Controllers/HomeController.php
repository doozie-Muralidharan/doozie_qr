<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Customer;
use App\Models\MenuDetails;

class HomeController extends Controller
{

    public function index()
    {
        $customers = Customer::count();
        $menu_details = MenuDetails::count();

        return view('masters.dashboard')->with('customers',$customers)->with('menu_details',$menu_details);
    }
}
