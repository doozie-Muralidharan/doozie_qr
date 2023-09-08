<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CustomerMenuController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $url_path)
    {
        visitor()->visit();
        $customer = Customer::where('url_path', $url_path)->first();
        if ($customer) {
            if ($customer->link_type == 'menu') {
                $categories = Category::all();
                $menu_details = DB::table('menu_details as md')
                    ->select('md.*', 'md.id as menu_id')
                    ->where('md.customer_id', $customer->id)
                    ->get();
                foreach ($menu_details as $key => $menu_detail) {
                    if ($menu_detail->category_ids) {
                        $menu_details[$key]->category_ids = explode(',', $menu_detail->category_ids);
                    }
                }
                $cuisines_names = array_unique(DB::table('menu_details as md')->where('md.customer_id', $customer->id)->orderBy('cuisines_order', 'ASC')->get()->pluck('cuisines_name')->toArray());
                return view('customer_menu.index')->with('categories', $categories)->with('customer', $customer)->with('menu_details', $menu_details)->with('cuisines_names', $cuisines_names);
            } else {
                return Redirect::to($customer->external_link);
            }
        } else {
            return abort(404);
        }
    }

    public function details(string $url_path, int $menu_details_id)
    {
        //fetch details and pass to view of details page
        return view('customer_menu.details');
    }
}
