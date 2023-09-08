@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Menu Details'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card  mb-4">
                <div class="card-header pb-0">
                    <h6>Menu Details View</h6>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive mx- mb-3">
                        <table class="table table-bordered">
                            <thead>
                                <th>Action</th>
                                <th>No.</th>
                                <th>Menu Item</th>
                                <th>Cost in</th>
                                {{-- <th>Short Description ( 250 Characters )</th> --}}
                                <!-- <th>Detailed Description ( 2500 Characters )</th> -->
                                <th>Categories</th>

                            </thead>
                            <tbody>
                            @php $c = 0 @endphp
                                @foreach($cuisines_names as $cuisines_name)
                                <tr style="background-color:{{$colors[$c]}};color:#fff">
                                    <td></td>
                                    <td class="font-weight-bolder font-18">{{ $loop->index+1 }}</td>
                                    <td class="font-weight-bolder font-18" colspan="5">{{ $cuisines_name }}</td>
                                </tr>
                                @php
                                $n=1;
                                @endphp
                                @foreach ($menu_details as $row)
                                @if($cuisines_name == $row->cuisines_name)

                                <tr style="color:{{$colors[$c]}}">
                                    <td style="text-align:center;"><a onclick="return myConfirm();" href="{{ Route('menu_details.destroy',['id' => $row->id]) }}" class=" text-danger" title="Delete"><i class="fa-solid fa-trash-can"></i></a></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $n++ }}</td>
                                    <td >{{ $row->menu_item_name }}</td>
                                    <td>{{$customer->currency->symbol}} {{ $row->cost_in_inr }}</td>
                                    {{-- <td>{!! chunk_split(substr($row->short_description,0,250),50, "<br>") !!}</td> --}}
                                    <!-- <td>{!! chunk_split(substr($row->detailed_description,0,2500),50, "<br>") !!}</td> -->
                                    <td>
                                        @if($row->category_ids)
                                        @foreach ($categories as $cat)
                                        @if(in_array($cat->id,$row->category_ids))
                                        <div style="display:inline-block" >
                                             <img width="auto" height="40px;" src="{{ asset('/uploads/category_thumbnail/' . $cat->thumbnail_path) }}" alt="">
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                    </td>

                                </tr>
                                @endif
                                @endforeach
                                @php $c++ @endphp
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
