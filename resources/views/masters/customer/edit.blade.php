@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Edit Customer'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card  mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Customers</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">

                    <form action="{{ route('customers.update', $customer->id) }}" method="post" class="form-row p-3" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="customer" class=" form-label font-20 fw-bold">Type</label>
                                <select name="type" value="{{ $customer->type }}" class="form-select shadow">
                                    <option value="restaurant" @if($customer->type == 'restaurant') selected @endif>Restaurant</option>
                                    <option value="caterer" @if($customer->type == 'caterer') selected @endif>Caterer</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="restaurant_name" class=" form-label font-20 fw-bold">Restaurant
                                    Name*</label>
                                <input type="text" name="restaurant_name" class="form-control shadow" value="{{ $customer->restaurant_name }}">
                                @error('restaurant_name')
                                <p class="text-danger mt-1 mb-0 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="customer" class=" form-label font-20 fw-bold">Display Name*</label>
                                <input type="text" name="display_name" class="form-control shadow" value="{{ $customer->display_name }}">
                                @error('display_name')
                                <p class="text-danger mt-1 mb-0 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="" class=" form-label font-20 fw-bold">Logo</label>
                                <input type="file" name="customer_logo" accept="image/png, image/jpeg, image/jpg" class="form-control shadow">
                                <input type="hidden" name="hidden_customer_logo" value="{{ $customer->logo_path }}">
                            </div>
                            @error('customer_logo')
                            <p class="text-danger  ">{{ $message }}</p>
                            @enderror

                            <div class="form-group p-2 col-md-6" hidden>
                                <label for="" class=" form-label font-20 fw-bold">Facebook link</label>
                                <input type="text" name="facebook_link" class="form-control shadow" value="{{ $customer->facebook_link }}">
                                @error('facebook_link')
                                <p class="text-danger  ">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group p-2 col-md-6" hidden>
                                <label for="" class=" form-label font-20 fw-bold">Instagram Link</label>
                                <input type="text" name="instagram_link" class="form-control shadow" value="{{ $customer->intagram_link }}">
                                @error('instagram_link')
                                <p class="text-danger  ">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group p-2 col-md-6" hidden>
                                <label for="" class=" form-label font-20 fw-bold">Zomato</label>
                                <input type="text" name="zomato" class="form-control shadow" value="{{ $customer->zomato }}">
                                @error('zomato')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" hidden>
                                <label for="customer" class=" form-label font-20 fw-bold">Webpage Name</label>
                                <input type="text" name="webpage_name" class="form-control shadow" value="{{ $customer->webpage_name }}">
                            </div>

                            {{-- <div class="form-group col-md-6">
                                <label for="customer" class=" form-label font-20 fw-bold">Contact number display on QR Menu*</label>
                                <input type="text" name="contact_no_for_webpage" class="form-control shadow" value="{{ $customer->contact_no_for_webpage }}">
                                @error('contact_no_for_webpage')
                                <p class="text-danger mt-1 mb-0 text-sm">{{ $message }}</p>
                                @enderror
                            </div> --}}

                            <div class="form-group col-md-6">
                                <label for="customer" class=" form-label font-20 fw-bold">Contact Number</label>
                                <input type="text" name="contact_no" class="form-control shadow" value="{{ $customer->contact_no }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="customer" class=" form-label font-20 fw-bold">Website</label>
                                <input type="text" name="website" class="form-control shadow" value="{{ $customer->website }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="customer" class=" form-label font-20 fw-bold">QR Link</label>
                                <select name="link_type" value="{{ $customer->link_type }}" class="form-select shadow">
                                    <option value="menu" @if($customer->link_type == 'menu') selected @endif>Menu</option>
                                    <option value="external" @if($customer->link_type == 'external') selected @endif>External Link</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="customer" class=" form-label font-20 fw-bold">External Link</label>
                                <input type="text" name="external_link" value="{{ $customer->external_link }}" class="form-control shadow">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contact_type" class=" form-label font-20 fw-bold">Contact Type *</label>
                                <select name="contact_type" value="{{ old('contact_type') }}" class="form-select shadow">
                                    <option value="Whatsapp" @if($customer->contact_type == 'Whatsapp') selected @endif>Whatsapp</option>
                                    <option value="Call" @if($customer->contact_type == 'Call') selected @endif>Call</option>
                                    <option value="Swiggy" @if($customer->contact_type == 'Swiggy') selected @endif>Swiggy</option>
                                    <option value="Zomato" @if($customer->contact_type == 'Zomato') selected @endif>Zomato</option>
                                </select>
                                @error('contact_type')
                                <p class="text-danger mt-1 mb-0 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contact_type_value" class=" form-label font-20 fw-bold">Contact Type Value *</label>
                                <input type="text" name="contact_type_value" value="{{ $customer->contact_type_value }}" class="form-control shadow">
                                @error('contact_type_value')
                                <p class="text-danger mt-1 mb-0 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="mt-4 col-md-6">
                                    <a href="{{ route('customers.index') }}" class="btn bg-gradient-danger btn-sm btn-rounded">Cancel</a>
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
    @endsection
