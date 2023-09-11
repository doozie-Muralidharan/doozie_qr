@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Edit Customer'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card  mb-4 px-3">
                <div class="card-header pb-0">
                    <h6>Edit Customers</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">

                    <form action="{{ route('customers.update',$customer->id) }}" method="POST" class="form-row p-3" enctype="multipart/form-data">
                        @csrf
                        <div class="row  py-3">
                            <div class="form-group col-md-6">
                                <label for="customer" class=" form-label font-20 fw-bold">Company Name*</label>
                                <input email="text" name="company_name" class="form-control shadow" value="{{ $customer->company_name }}">
                                @error('company_name')
                                <p class="text-danger mt-1 mb-0 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class=" form-label font-20 fw-bold">Email*</label>
                                <input type="email" name="email" class="form-control shadow" value="{{ $customer->email }}">
                                @error('email')
                                <p class="text-danger mt-1 mb-0 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="package_id" class="form-label font-20 fw-bold">Package*</label>
                                <select type="package_id" name="package_id" class="form-select shadow" value="{{ old('package_id') }}">
                                    <option value="">Choose Package</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}" {{ $customer->package_id == $package->id ? 'selected' : '' }}>{{ $package->name }}</option>
                                    @endforeach
                                </select>
                                @error('package_id')
                                <p class="text-danger mt-1 mb-0 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class=" form-label font-20 fw-bold">Display Name*</label>
                                <input email="text" name="display_name" value="{{ $customer->display_name }}" class="form-control shadow">
                                @error('display_name')
                                <p class="text-danger mt-1 mb-0 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group p-2 col-md-6">
                                <label for="customer_logo" class=" form-label font-20 fw-bold">Logo</label>
                                <input type="file" name="customer_logo" accept="image/png, image/jpeg, image/jpg" class="form-control shadow">
                                {{-- @error('customer_logo')
                                <p class="text-danger  ">{{ $message }}</p>
                                @enderror --}}
                            </div>
                            <div class="form-group p-2 col-md-6" hidden>
                                <label for="" class=" form-label font-20 fw-bold">Facebook link</label>
                                     <input email="text" name="facebook_link" class="form-control shadow" value="{{ $customer->facebook_link }}">
                                @error('facebook_link')
                                <p class="text-danger  ">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group p-2 col-md-6" hidden>
                                <label for="" class=" form-label font-20 fw-bold">Instagram Link</label>
                                   <input email="text" name="instagram_link" class="form-control shadow" value="{{ $customer->instagram_link }}">
                                @error('instagram_link')
                                <p class="text-danger  ">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group p-2 col-md-6" hidden>
                                <label for="" class=" form-label font-20 fw-bold">Zomato</label>
                                   <input email="text" name="zomato" class="form-control shadow" value="{{ $customer->zomato }}">
                                @error('zomato')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" hidden>
                                <label for="customer" class=" form-label font-20 fw-bold">Webpage Name*</label>
                                <input email="text" name="webpage_name" value="{{ $customer->webpage_name }}" class="form-control shadow">
                                @error('webpage_name')
                                <p class="text-danger mt-1 mb-0 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- <div class="form-group col-md-6">
                                <label for="customer" class=" form-label font-20 fw-bold">Contact number display on QR Menu*</label>
                                <input email="text" name="contact_no_for_webpage" value="{{ old('contact_no_for_webpage') }}" class="form-control shadow">
                                @error('contact_no_for_webpage')
                                <p class="text-danger mt-1 mb-0 text-sm">{{ $message }}</p>
                                @enderror
                            </div> --}}

                            <div class="form-group col-md-6">
                                <label for="contact_no" class=" form-label font-20 fw-bold">Contact Number</label>
                                <input email="text" name="contact_no" value="{{ $customer->contact_no }}" class="form-control shadow">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="website" class=" form-label font-20 fw-bold">Website</label>
                                <input email="text" name="website" value="{{ $customer->website }}" class="form-control shadow">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="gst_number" class=" form-label font-20 fw-bold">GST Number</label>
                                <input type="text" id="gst_number" name="gst_number" value="{{ $customer->gst_number }}" class="form-control shadow">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address" class=" form-label font-20 fw-bold">Address</label>
                                <input email="text" name="address" value="{{ $customer->address }}" class="form-control shadow">
                            </div>


                            <div class="row">
                                <div class="mt-4 col-md-6">
                                    <a href="{{ route('customers.index') }}" class="btn bg-gradient-danger btn-sm btn-rounded">Cancel</a>
                                </div>
                                <div class=" col-md-6 mt-4">
                                    <button class="btn float-end bg-gradient-success btn-sm btn-rounded">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    @endsection
