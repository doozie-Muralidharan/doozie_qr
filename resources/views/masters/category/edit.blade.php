@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Create Category'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card  mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Category</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">

                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="form-row">
                        @csrf
                        <div class="row px-3">
                            <div class="form-group col-md-6">
                                <label for="name" class=" form-label font-20 fw-bold">Category Name*</label>
                                <input type="text" name="name" class="form-control shadow" value="{{ $category->name }}">
                                @error('name')
                                <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class=" form-label font-20 fw-bold">Thumbnail*</label>
                                <input type="file" name="thumbnail_path" class="form-control shadow" accept="image/png, image/jpeg, image/jpg">
                                @error('thumbnail_path')
                                <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="details" class=" form-label font-20 fw-bold">Details</label>
                                <textarea name="details" class="form-control shadow" id="" cols="15" rows="7">{{ $category->details }}</textarea>
                            </div>

                            <div class="row ">
                                <div class="mt-4 col-md-6">
                                    <a href="{{ URL::previous() }}" class="btn bg-gradient-danger btn-sm btn-rounded">Cancel</a>
                                </div>
                                <div class=" col-md-6 mt-4">
                                    <button type="submit" class="btn float-end bg-gradient-success btn-sm btn-rounded">Update</button>
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
