@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Cuisine'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-10">
                <div class="card  mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Package</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">

                        <form action="{{ route('packages.update',$package->id) }}" method="POST" class="form-row">
                            @csrf
                            <div class="row px-4">
                                <div class="form-group col-md-6">
                                    <label for="" class=" form-label font-20 fw-bold"> Name*</label>
                                    <input type="text" name="name" value="{{ $package->name }}"
                                        class="form-control shadow">
                                    @error('name')
                                        <p class="text-danger  ">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="number_of_codes" class=" form-label font-20 fw-bold">Number of Codes*</label>\
                                    <input type="text" class="form-control shadow" value="{{ $package->number_of_codes }}" name="number_of_codes" id="number_of_codes">
                                    @error('number_of_codes')
                                        <p class="text-danger    ">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cost" class=" form-label font-20 fw-bold">Cost*</label>\
                                    <input type="text" class="form-control shadow" name="cost" id="cost" value="{{ $package->cost }}">
                                    @error('cost')
                                        <p class="text-danger    ">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="monthly_cap" class=" form-label font-20 fw-bold">Monthly Cap*</label>\
                                    <input type="text" class="form-control shadow" name="monthly_cap" id="monthly_cap" value="{{ $package->monthly_cap }}">
                                    @error('monthly_cap')
                                        <p class="text-danger    ">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="row ">
                                    <div class="mt-4 col-md-6">
                                        <a href="{{ route('packages.index') }}"
                                            class="btn bg-gradient-danger btn-sm btn-rounded" type="button">Cancel</a>
                                    </div>
                                    <div class=" col-md-6 mt-4">
                                        <button class="btn bg-gradient-success btn-sm btn-rounded float-end">Update</button>
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
