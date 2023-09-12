@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Document Types'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-4">
                    <div class="card-header pb-0">
                        <h6>Manage Admin</h6>
                        <div class="d-flex justify-content-end">
                            <span><a href="{{ route('manage_admin.create') }}"
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
                                    <th class="fw-bolder "> Email</th>
                                </thead>
                                <tbody>
                                    @php $sr = 1; @endphp
                                    @foreach ($manage_admin as $row)
                                        <tr>
                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $sr++ }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-4 py-1 d-flex gap-2">
                                                    <a href="{{ route('manage_admin.edit', $row->id) }}"
                                                        class="btn btn-info " title="Edit"><i
                                                            class="fa-regular fa-pen-to-square"></i></a>


                                                    @if ($row->deleted_at == null)
                                                        <form method="POST"
                                                            action="{{ route('manage_admin.deactivate', $row->id) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success"
                                                                title="Deactivate"><i class="fa fa-power-off"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('manage_admin.activate', $row->id) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger"
                                                                title="Activate"><i class="fa fa-power-off"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                    @endif
                                                </div>


                                            </td>
                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $row->username }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $row->email }}</p>
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
