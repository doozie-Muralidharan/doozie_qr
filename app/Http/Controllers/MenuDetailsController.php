<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Menu;
use App\Models\Cuisine;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\MenuDetails;
use Illuminate\Http\Request;
use App\Exports\MenuDetailsExport;
use App\Imports\MenuDetailsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\File as FacadesFile;

class MenuDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('id','DESC')->get();
        return view('masters.menu.index', ['customers' => $customers]);
    }

    public function currency(Request $request, $id)
    {

        $currency = Customer::find($id);
        $currency->currency_id = $request->currency;
        $currency->save();
        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd( $request->all());
        //store menu details

        $menuDetails = new MenuDetails;
        $menuDetails->customer_id = $request->customer_id;
        $menuDetails->cuisines_name =  Cuisine::find($request->cuisines_name)->cuisine_name;
        $menuDetails->cuisines_order = $request->cuisines_order;
        $menuDetails->menu_priority = $request->menu_priority;
        $menuDetails->menu_item_name = $request->menu_item_name;
        $menuDetails->cost_in_inr = $request->cost_in_inr;
        $menuDetails->video_url = $request->video_url;
        $menuDetails->category_ids = $request->category_ids;
        $menuDetails->detailed_description = $request->detailed_description;
        $menuDetails->short_description = $request->short_description;
        if ($request->image_thumbnail) {
            $image_thumbnail = time() . '_' . $request->image_thumbnail->getClientOriginalName();
            $request->image_thumbnail->move('uploads/image_thumbnail/', $image_thumbnail);
            $menuDetails->image_thumbnail = $image_thumbnail;
        }
        if ($request->large_image_to_display) {
            $large_image_to_display = time() . '_' . $request->large_image_to_display->getClientOriginalName();
            $request->large_image_to_display->move('uploads/large_image_to_display/', $large_image_to_display);
            $menuDetails->large_image_to_display = $large_image_to_display;
        }
        $menuDetails->save();
        toastr()->success('Menu details added successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $colors = array('#162196','#43960B','#820B37','#AD0EF9','#611DF2','#800680', '#6B2DF0','#B04D2F','#3C0D6B','#5085C7','#8D229C','#6716AA','#17A13E','#B90DF4','#1D01E2','#4906D4','#5624DD','#7458E2','#8C93ED','#611DF2','#402235');
        $customer = Customer::find($id);
        $cuisines = Cuisine::whereNull('deleted_at')->get();
        $currencies = Currency::whereNull('deleted_at')->get();
        $categories = Category::all();
        $menu_details = DB::table('menu_details as md')
            ->where('md.customer_id', $id)
            ->get();
        foreach ($menu_details as $key => $menu_detail) {
            if ($menu_detail->category_ids) {
                $menu_details[$key]->category_ids = explode(',', $menu_detail->category_ids);
            }
        }
        $cuisines_names = array_unique(DB::table('menu_details as md')->where('md.customer_id', $id)->orderBy('cuisines_order','ASC')->get()->pluck('cuisines_name')->toArray());

        return view('masters.menu.show')->with('menu_details', $menu_details)->with('cuisines_names', $cuisines_names)->with('cuisines', $cuisines)->with('currencies', $currencies)->with('categories', $categories)->with('customer', $customer)->with('colors', $colors);

    }

    public function updateItem(Request $request, $id){
       // dd($request->all());
        $menuDetails =  MenuDetails::find($id);
        $menuDetails->cuisines_order = $request->cuisines_order;
        $menuDetails->menu_priority = $request->menu_priority;
        $menuDetails->menu_item_name = $request->menu_item_name;
        $menuDetails->cost_in_inr = $request->cost_in_inr;
        $menuDetails->video_url = $request->video_url;
        $category = $menuDetails->category_ids;

        if($request->category_ids == ""){
            $menuDetails->category_ids =  $category;
        }else{
            $menuDetails->category_ids = $request->category_ids;
        }

        if($request->image_thumbnail == ''){
            $menuDetails->image_thumbnail = $request->image_thumbnail_hidden;
        }else{
            $image_thumbnail = time() . '_' . $request->image_thumbnail->getClientOriginalName();
            $request->image_thumbnail->move('uploads/image_thumbnail/', $image_thumbnail);
            $menuDetails->image_thumbnail = $image_thumbnail;
        }

        $menuDetails->save();
        toastr()->success('Menu Item Updated successfully');
        return redirect()->back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($customer_id)
    {
        $colors = array('#162196','#43960B','#820B37','#AD0EF9','#611DF2','#800680', '#6B2DF0','#B04D2F','#3C0D6B','#5085C7','#8D229C','#6716AA','#17A13E','#B90DF4','#1D01E2','#4906D4','#5624DD','#7458E2','#8C93ED','#611DF2','#402235');
        $customer = Customer::find($customer_id);
        $cuisines = Cuisine::whereNull('deleted_at')->get();
        $currencies = Currency::whereNull('deleted_at')->get();
        $categories = Category::all();
        $menu_details = DB::table('menu_details as md')
            ->where('md.customer_id', $customer_id)
            ->get();
        foreach ($menu_details as $key => $menu_detail) {
            if ($menu_detail->category_ids) {
                $menu_details[$key]->category_ids = explode(',', $menu_detail->category_ids);
            }
        }
        $cuisines_names = array_unique(DB::table('menu_details as md')->where('md.customer_id', $customer_id)->orderBy('cuisines_order','ASC')->get()->pluck('cuisines_name')->toArray());
       $cuisines_last = DB::table('menu_details as md')->where('md.customer_id', $customer_id)->select('md.cuisines_order','md.cuisines_name')->orderBy('id','desc')->get();
       $cuisines_count = DB::table('menu_details as md')->where('md.customer_id', $customer_id)->select('md.cuisines_order','md.cuisines_name')->orderBy('id','desc')->count();
        if($cuisines_count){
            $cuisines_last = $cuisines_last;
        }else{
            $cuisines_last = 0;
        }
        return view('masters.menu.edit')->with('menu_details', $menu_details)->with('cuisines_names', $cuisines_names)->with('cuisines_last', $cuisines_last)->with('cuisines', $cuisines)->with('currencies', $currencies)->with('categories', $categories)->with('customer', $customer)->with('colors', $colors);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuDetails $menudetails)
    {
        $menudetails->cuisines_name = $request->input('cuisines_name');
        $menudetails->name = $request->input('name');
        $menudetails->video_url = $request->input('video_url');
        $menudetails->short_description = $request->input('short_description');
        $menudetails->detailed_description = $request->input('detailed_description');
        $menudetails->cost_in_inr = $request->input('cost_in_inr');

        if ($request->hasFile('image_thumbnail')) {
            $destination = 'uploads/menu_thumbnail/.' . $menudetails->image_thumbnail;
            if (FacadesFile::exists($destination)) {
                FacadesFile::delete();
            }
            $file = $request->file('image_thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/menu_thumbnail/', $filename);
            $menudetails->image_thumbnail = $filename;
        }

        if ($request->hasFile('large_image_to_display')) {
            $destination = 'uploads/menu_img_to_display/.' . $menudetails->large_image_to_display;
            if (FacadesFile::exists($destination)) {
                FacadesFile::delete();
            }
            $file = $request->file('large_image_to_display');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/menu_img_to_display/', $filename);
            $menudetails->large_image_to_display = $filename;
        }


        $menudetails->update();

        toastr()->success('Menu details updated successfully');

        return redirect()->route('menu_details.index');
    }





    public function exportExcel(){

        return Excel::download(new MenuDetailsExport, 'menu_details.xlsx');
    }

    public function importExcel(Request $request){
        $customer_id = 2; // replace with the actual customer ID
        $import = new MenuDetailsImport($customer_id);
        Excel::import($import, $request->file('file'));
        toastr()->success('File imported successfully');

        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = MenuDetails::find($id);
        $id->delete();
        toastr()->success('Menu details deleted successfully');
        return redirect()->back();
    }

    public function destroyAll(){
        FacadesDB::table('menu_details')->delete();
        toastr()->success('Menu details deleted successfully');
        return redirect()->back();
    }
}
