@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'QR Code Details'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    {{-- <h6 class="fw-bolder">QR Code details</h6> --}}

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="    font-weight-bolder ">
                                        Sr.</th>
                                    <th class="text-center     font-weight-bolder ">
                                        Action (*eps no support for color gradients)</th>
                                    <th class="    font-weight-bolder ">
                                        Customer Name</th>
                                    <th class="    font-weight-bolder ">
                                        Display Name</th>
                                    <th class="text-center     font-weight-bolder ">
                                        QR Code</th>

                                    <th class=" "></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = count($customers);
                                @endphp
                                @foreach ($customers as $customer)
                                <tr>
                                    <td>
                                        <div class="px-4 py-1 ">
                                            <p class="font-20 font-weight-bold mb-0">{{ $no-- }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        @if(strlen($customer->qr_path) > 0)
                                        <div class="text-center py-1 ">
                                            <a href="{{$customer->qr_path}}" class="btn btn-success btn-sm mb-0 " title="Download PNG" download><i class="fa fa-download"></i> PNG</a>
                                            <a href="{{str_replace('.png','.eps',$customer->qr_path)}}" class="btn btn-info btn-sm mb-0 " title="Download EPS" download><i class="fa fa-download"></i> *EPS </a>
                                            <a href="{{str_replace('.png','.svg',$customer->qr_path)}}" class="btn btn-info btn-sm mb-0 " title="Download SVG" download><i class="fa fa-download"></i> SVG </a>
                                            @else

                                            @endif
                                            <a href="{{ route('qr_code_details.edit', ['id' => $customer->id]) }}" class="btn btn-facebook btn-sm mb-0 " title="Edit"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="px-4 py-1 ">
                                            <p class="font-20 font-weight-bold mb-0">{{ $customer->restaurant_name }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="px-4 py-1 ">
                                            <p class="font-20 font-weight-bold mb-0">{{ $customer->display_name }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="px-4 py-1 text-center">
                                            @if(strlen($customer->qr_path) > 0)
                                            <img src="{{$customer->qr_path}}" alt="" width="145" height="145" class="img-fluid">
                                            @else
                                            ---
                                            @endif

                                        </div>
                                    </td>


                                </tr>

                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
