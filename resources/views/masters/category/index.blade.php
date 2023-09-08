@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Category Details'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-4">
                    <div class="card-header pb-0">
                        <h6>Category Details</h6>
                        <div class="d-flex justify-content-end">
                            <span><a href="/category_details_create" class=" btn bg-gradient-info btn-sm">Add</a></span>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <th class="    fw-bolder ">Sr
                                    </th>
                                    <th class="    fw-bolder ">Action</th>
                                    <th class="    fw-bolder ">Category Name
                                    </th>
                                    <th class="    fw-bolder ">Details</th>
                                    <th class="    fw-bolder ">thumbnail</th>
                                </thead>
                                <tbody>
                                    @php $sr = 1; @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $sr++ }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-4 py-1 ">
                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                        class="btn btn-info" title="Edit"><i
                                                            class="fa-regular fa-pen-to-square"></i></a>
                                                    @if ($category->deleted_at == null)
                                                        <a href="{{ route('categories.deactivate', ['id' => $category->id]) }}"
                                                            id="view" class="btn  btn-success" title="Activate"><i
                                                                class="fa fa-power-off " aria-hidden="true"></i></a>
                                                    @else
                                                        <a href="{{ route('categories.deactivate', ['id' => $category->id]) }}"
                                                            id="view" class="btn  btn-danger" title="Deactivate"><i
                                                                class="fa fa-power-off" aria-hidden="true"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $category->name }}</p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="px-4 py-1">
                                                    <p class="fw-bold font-20 mb-0">{{ $category->details }}</p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="px-4 py-1">
                                                    <img src="{{ asset('/uploads/category_thumbnail/' . $category->thumbnail_path) }}"
                                                        alt="" width="45" height="45" class="img-fluid">
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
