<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $document_types = DocumentType::all();
        return view('masters.document_type.index')->with('document_types', $document_types);
    }
    public function create()
    {
        return view('masters.document_type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $document_type = new DocumentType;
        $document_type->name = $request->input('name');
        $document_type->description = $request->input('description');
        $document_type->save();

        toastr()->success('Document Type  added successfully');
        return redirect()->route('document_type.index');
    }

    public function edit($id)
    {
        //dd($document->name);
        $document = DocumentType::find($id);
        return view('masters.document_type.edit', ['document' => $document]);
    }

    public function update(Request $request, $id)
    {
        // $document->update($request->all());

        $request->validate([
            'name' =>  'required',
            'description' => 'required'
        ]);
        $document = DocumentType::find($id);
        $document->name = $request['name'];
        $document->description = $request['description'];

        $document->save();
        // DocumentType::create($request->all());
        toastr()->success('DocumentType details update successfully');
        return redirect()->route('document_type.index');
    }
}
