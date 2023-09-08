<?php

namespace App\Http\Controllers;

use DB;
use carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('masters.category.index', ['categories' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.category.create');
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
            'name' => 'required|unique:categories,name',
            'thumbnail_path' => 'required'
        ]);
        $category = Category::where('name', 'LIKE', $request->name)->first();
        if ($category) {
            $name_error = 'Caategory name is already existing';
            return redirect()->route('categories.create');
        }
        $category = new Category;
        $category->name = $request->input('name');
        $category->details = $request->input('details');

        if ($request->hasFile('thumbnail_path')) {
            $file = $request->file('thumbnail_path');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/category_thumbnail/', $filename);
            $category->thumbnail_path = $filename;
        }

        $category->save();


        toastr()->success('Category details added successfully');

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('masters.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category)
    {
       // DD($category->id);
        // $category->validate([
        //     'name' =>  'required | unique:categories,name' . $category->id,
        //     'thumbnail_path' => 'required'
        // ]);
        request()->validate([
            'name' =>  'required | unique:categories,name,'. $category->id,
            
        ]);

        $category->name = request()->input('name');
        $category->details = request()->input('details');

        if (request()->hasFile('thumbnail_path')) {
            $destination = 'uploads/category_thumbnail/.' . $category->thumbnail_path;
            if (FacadesFile::exists($destination)) {
                FacadesFile::delete();
            }
            $file = request()->file('thumbnail_path');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/category_thumbnail/', $filename);
            $category->thumbnail_path = $filename;
        }

        $category->update();


        toastr()->success('Category updated added successfully');
        return redirect()->route('categories.index');
    }

    public function deactivate($id)
    {
        $category = Category::find($id);
        if ($category->deleted_at == null) {
            DB::table('categories')->where('id', '=', $id)->update([
                "deleted_at" => Carbon::now(),
            ]);
            toastr()->error('Category deactivated successfully');
            return redirect()->route('categories.index');
        } else {
            DB::table('categories')->where('id', '=', $id)->update([
                "deleted_at" => null,
            ]);
            toastr()->success('Category activated successfully');
            return redirect()->route('categories.index');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
