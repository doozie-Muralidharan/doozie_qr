@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Document Type'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Document Type</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">

                        <form action="{{ route('document_type.update', $document->id) }}" method="POST" class="form-row">
                            @csrf
                            <div class="row px-4">
                                <div class="form-group p-2 col-md-8">
                                    <label for="" class=" form-label font-20 fw-bold">Cuisine Name*</label>
                                    <input required type="text" name="name" value="{{ $document->name }}"
                                        class="form-control shadow">
                                    @error('name')
                                        <p class="text-danger  ">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group p-2 col-md-8">
                                    <label for="" class=" form-label font-20 fw-bold">Details*</label>
                                    <textarea required name="description" class="form-control shadow" id="" cols="15" rows="7">{{ $document->description }}</textarea>
                                    @error('description')
                                        <p class="text-danger    ">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="row ">
                                    <div class="mt-4 col-md-6">
                                        <a href="{{ route('document_type.index') }}"
                                            class="btn bg-gradient-danger btn-sm btn-rounded">Cancel</a>
                                    </div>
                                    <div class=" col-md-6 mt-4">
                                        <button class="btn float-end bg-gradient-success btn-sm btn-rounded">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
