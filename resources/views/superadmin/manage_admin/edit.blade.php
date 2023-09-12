@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Package'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-10">
                <div class="card  mb-4">
                    <div class="card-header pb-0">
                        <h6>Update Admin</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">

                        <form action="{{ route('manage_admin.update', $admin->id) }}" method="POST" class="form-row">
                            @csrf
                            <div class="row px-4">
                                <div class="form-group col-md-6">
                                    <label for="first_name" class=" form-label font-20 fw-bold"> First Name*</label>
                                    <input type="text" name="first_name" value="{{ $admin->firstname }}"
                                        class="form-control shadow">
                                    @error('first_name')
                                        <p class="text-danger  ">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name" class=" form-label font-20 fw-bold"> Last Name*</label>
                                    <input type="text" name="last_name" value="{{ $admin->lastname }}"
                                        class="form-control shadow">
                                    @error('last_name')
                                        <p class="text-danger  ">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username" class=" form-label font-20 fw-bold"> Username*</label>
                                    <input type="text" name="username" value="{{ $admin->username }}"
                                        class="form-control shadow">
                                    @error('username')
                                        <p class="text-danger  ">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email" class=" form-label font-20 fw-bold">Email*</label>\
                                    <input type="email" class="form-control shadow" name="email" id="email" value="{{ $admin->email }}">
                                    @error('email')
                                        <p class="text-danger    ">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password" class=" form-label font-20 fw-bold">Change Paasowrd</label>\
                                    <input type="text" class="form-control shadow" name="password" id="password">
                                    @error('password')
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
