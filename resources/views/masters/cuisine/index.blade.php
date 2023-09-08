@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Cuisine Details'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-4">
                    <div class="card-header pb-0">
                        <h6>Cuisines Details</h6>
                        <div class="d-flex justify-content-end">
                            <span><a href="/cuisine_create" class=" btn bg-gradient-info btn-sm">Add</a></span>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="p-3">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <th class="fw-bolder ">Sr </th>
                                    <th class="fw-bolder ">Action</th>
                                    <th class="fw-bolder ">Cuisines Name                                    </th>
                                    <th class="fw-bolder ">Short Description
                                    </th>
                                </thead>
                                <tbody>
                                    @php $sr = 1; @endphp
                                    @foreach ($cuisines as $cuisine)
                                        <tr>
                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $sr++ }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-4 py-1 ">
                                                    @if ($cuisine->deleted_at == null)
                                                        <a href="{{ route('cuisines.edit', $cuisine->id) }}"
                                                        class="btn btn-info " title="Edit"><i
                                                            class="fa-regular fa-pen-to-square"></i></a>
                                                        <a href="{{ route('cuisines.deactivate', ['id' => $cuisine->id]) }}"
                                                            id="view" class="btn  btn-success" title="Activate"><i
                                                                class="fa fa-power-off " aria-hidden="true"></i></a>
                                                    @else
                                                        <a href="{{ route('cuisines.deactivate', ['id' => $cuisine->id]) }}"
                                                            id="view" class="btn  btn-danger" title="Deactivate"><i
                                                                class="fa fa-power-off" aria-hidden="true"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $cuisine->cuisine_name }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $cuisine->short_description }}</p>
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
