@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Cuisine Details'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-4">
                    <div class="card-header pb-0">
                        <h6>Packages</h6>
                        <div class="d-flex justify-content-end">
                            <span><a href="{{ route('packages.create') }}"
                                    class=" btn bg-gradient-info btn-sm">Add</a></span>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="p-3">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <th class="fw-bolder ">Sr </th>
                                    <th class="fw-bolder ">Action</th>
                                    <th class="fw-bolder "> Name </th>
                                    <th class="fw-bolder "> Number of Codes
                                    </th>
                                </thead>
                                <tbody>
                                    @php $sr = 1; @endphp
                                    @foreach ($packages as $row)
                                        <tr>
                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $sr++ }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-4 py-1 ">
                                                    <a href="{{ route('packages.edit', $row->id) }}"
                                                        class="btn btn-info " title="Edit"><i
                                                            class="fa-regular fa-pen-to-square"></i></a>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $row->name }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $row->number_of_codes }}</p>
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
