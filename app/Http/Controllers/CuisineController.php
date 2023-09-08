<?php

namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;
use App\Models\Cuisine;
use Illuminate\Http\Request;

class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuisine = Cuisine::all();
        return view('masters.cuisine.index', ['cuisines' => $cuisine]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.cuisine.create');
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
            'cuisine_name' => 'required|unique:cuisines,cuisine_name',
            'short_description' => 'required'
        ]);
        $cuisine = new Cuisine;
        $cuisine->cuisine_name = $request['cuisine_name'];
        $cuisine->short_description = $request['short_description'];
        $cuisine->save();
        toastr()->success('Cuisine details added successfully');
        return redirect()->route('cuisines.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function show(Cuisine $cuisine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($cuisine->cuisine_name);
        $cuisine = Cuisine::find($id);
        return view('masters.cuisine.edit', ['cuisine' => $cuisine]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // $cuisine->update($request->all());

        $request->validate([
            'cuisine_name' =>  'unique:cuisines,cuisine_name,' . $id,
            'short_description' => 'required'
        ]);
        $cuisine = Cuisine::find($id);
        $cuisine->cuisine_name = $request['cuisine_name'];
        $cuisine->short_description = $request['short_description'];

        $cuisine->save();
       // Cuisine::create($request->all());
        toastr()->success('Cuisine details update successfully');
        return redirect()->route('cuisines.index');

    }

    public function deactivate($id){
         $cuisine = Cuisine::find($id);
         if($cuisine->deleted_at == null){
                DB::table('cuisines')->where('id', '=', $id)->update([
                    "deleted_at" => Carbon::now(),
                ]);
                toastr()->error('Cuisine details deactivate successfully');
                return redirect()->route('cuisines.index');
         }else{
            DB::table('cuisines')->where('id', '=', $id)->update([
                "deleted_at" => null,
            ]);
            toastr()->success('Cuisine details activate successfully');
                return redirect()->route('cuisines.index');
         }
    }

    public function active($id){

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuisine $cuisine)
    {
        //
    }
}
