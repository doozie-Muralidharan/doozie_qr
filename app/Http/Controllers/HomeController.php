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
        $unique_visits = DB::table('menu_visits')->distinct('ip')->count('ip');
        $total_visits = DB::table('menu_visits')->count();
        return view('masters.dashboard')->with('customers',$customers)->with('menu_details',$menu_details)->with('unique_visits',$unique_visits)->with('total_visits',$total_visits);
    }
}
