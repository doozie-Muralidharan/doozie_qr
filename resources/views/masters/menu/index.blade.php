@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Menu Details'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card  mb-4">
                <div class="card-header pb-0">
                    <h6>Menu Details</h6>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <th class="    fw-bolder ">Sr.
                                </th>
                                <th class="    fw-bolder ">Customer Name
                                </th>
                                <th class="    fw-bolder ">Display Name
                                </th>
                                <th class="    fw-bolder ">Action</th>
                            </thead>
                            <tbody>
                                @php
                                $no = count($customers);
                            @endphp
                                @foreach ($customers as $customer)

                                <tr>
                                    <td>
                                        <div class="px-4 py-1">
                                            <p class="fw-bold font-20 mb-0">{{ $no-- }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="px-4 py-1 ">
                                            <a href="{{ route('menu_details.edit', $customer->id) }}" class="btn btn-success btn-sm" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="{{ route('menu_details.show', ['id' => $customer->id]) }}" class="btn btn-info btn-sm" title="View"><i class="fa-regular fa-eye"></i></a>
                                            <a href="{{env('APP_URL') . '/' . $customer->url_path}}" class="btn btn-warning btn-sm" title="Open Menu" target="_blank"><i class="fa fa-link"></i></a>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="px-4 py-1">
                                            <p class="fw-bold font-20 mb-0">{{ $customer->restaurant_name }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="px-4 py-1">
                                            <p class="fw-bold font-20 mb-0">{{ $customer->display_name }}</p>
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
