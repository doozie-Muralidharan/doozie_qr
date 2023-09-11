@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Customer Details'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Customers</h6>
                    <div class="d-flex justify-content-end">
                        <span><a href="/customer_create" class=" btn bg-gradient-info btn-sm">Add</a></span>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th class="     font-weight-bolder ">
                                            Action</th>
                                        <th class="    font-weight-bolder ">
                                            Logo</th>
                                        <th class="    font-weight-bolder ">
                                            Company Name</th>
                                        <th class="    font-weight-bolder  ps-2">
                                            Display Name</th>

                                        <th class="     font-weight-bolder ">
                                            Contact number display on QR Menu</th>
                                        <th class="     font-weight-bolder ">
                                            Contact Number</th>
                                        <th class="     font-weight-bolder ">
                                            Website</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sr = count($customers); @endphp
                                    @foreach ($customers as $customer)
                                    <tr>
                                        <td>
                                            <div class="px-4 py-1">
                                                {{ $sr-- }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="px-4 py-1 ">
                                                <a href="{{ route('customers.edit',$customer->id) }}" class="btn btn-info " title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>

                                                @if ($customer->status == "0")
                                                <a href="{{ route('customer.inactive', ['id' => $customer->id]) }}" id="view" class="btn  btn-success" title="Activate"><i class="fa fa-power-off " aria-hidden="true"></i></a>
                                                @else
                                                <a href="{{ route('customer.active', ['id' => $customer->id]) }}" id="view" class="btn  btn-instagram" title="Deactivate"><i class="fa fa-power-off" aria-hidden="true"></i></a>
                                                @endif
                                                <a href="{{ route('customers.delete',$customer->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger " title="DELETE"><i class="fa-solid fa-trash-can"></i></a>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="px-4 py-1 ">
                                                <img width="100px" src="{{ url('uploads/customer_logo/') }}/{{ $customer->logo_path }}" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="px-4 py-1 ">
                                                <p class="font-20 font-weight-bold mb-0">{{ $customer->company_name }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="px-4 py-1 ">
                                                <p class="font-20 font-weight-bold mb-0">{{ $customer->display_name }}</p>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="px-4 py-1 ">
                                                <p class="font-20 font-weight-bold mb-0">{{ $customer->contact_no_for_webpage }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="px-4 py-1 ">
                                                <p class="font-20 font-weight-bold mb-0">{{ $customer->contact_no }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="px-4 py-1 ">
                                                <p class="font-20 font-weight-bold mb-0">{{ $customer->website }}</p>
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
    <script>
        function ConfirmDelete() {
            return confirm("Are you sure you want to delete?");
        }

    </script>
    @endsection
