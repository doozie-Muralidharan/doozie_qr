@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create QR Code Detail'])

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-6">
                    <div class="card  mb-4">
                        <div class="card-header pb-0">
                            <h6 class="fw-bolder">Add QR Details</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="p-3">
                                <form action="{{ route('qr_code_details.store') }}" method="POST" enctype="multipart/form-data" class="">
                                    @csrf
                                    <div class="px-3 form-row">
                                    <div class="form-group p-2 col-5">
                                        <label for="customer_id" class="form-label  fw-bold text-secondary">Customer ID*</label>
                                        <select class="form-select shadow" name="customer_id" id="">
                                            @foreach ($qr_details as $qr_detail)
                                            <option value="{{ $qr_detail->customer_id }}">{{ $qr_detail->customer_id }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('customer_name')
                                        <p class="text-danger textxxs mt-2">{{ $message }}</p>
                                    @enderror


                                    <div class="form-group p-2 col-6">
                                        <label for="" class=" form-label font-20 fw-bold">Background Image</label>
                                        <input type="file" name="background_image_path" class="form-control shadow">
                                    </div>

                                    <div class="form-group p-2 col-6">
                                        <label for="" class=" form-label font-20 fw-bold">QR Code</label>
                                        <input type="file" name="qr_code_path" class="form-control shadow">
                                    </div>

                                    <div class="form-group p-2 col-6">
                                        <label for="" class=" form-label font-20 fw-bold">Customer_label</label>
                                        <input type="file" name="customer_label_path" class="form-control shadow">
                                    </div>


                                    <div class="row ">
                                        <div class="mt-4 col">
                                            <button class="btn bg-gradient-danger btn-sm btn-rounded">Cancel</button>
                                        </div>
                                        <div class=" col mt-4">
                                            <button class="btn bg-gradient-success btn-sm btn-rounded">Save</button>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
