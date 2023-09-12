@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Customer Details'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Dashboard</h6>
                    <div class="d-flex justify-content-end">
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">

                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Unique Visits</p>
                                <h5 class="font-weight-bolder">
                                    {{-- {{$unique_visits}} --}}
                                </h5>
                                <!-- <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+55%</span> increase

                                </p> -->
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Visits</p>
                                <h5 class="font-weight-bolder">
                                    {{-- {{$total_visits}} --}}
                                </h5>
                                <p class="mb-0">
                                    <!-- <span class="text-success text-sm font-weight-bolder">+5%</span> last month -->
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Clients</p>
                                <h5 class="font-weight-bolder">
                                    {{-- {{$customers}} --}}
                                </h5>
                                <!-- <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+3%</span>
                                    current month
                                </p> -->
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Items</p>
                                <h5 class="font-weight-bolder">
                                    {{$menu_details}}
                                </h5>
                                <!-- <p class="mb-0">
                                    <span class="text-danger text-sm font-weight-bolder">+2%</span> last month
                                </p> -->
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>

</div>
@endsection
