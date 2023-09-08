@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Create Menu Detail'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card  mb-4">
                <div class="card-header pb-0">
                    <h6>Add Menu Details</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{ route('menu_details.store') }}" id="myform" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mx-3 ">
                            <div class="form-group col-md-6">
                                <label for="menu_item_name" class=" form-label font-20 fw-bold"> Customer name*</label>
                                <select class="form-select shadow" name="customer_name" id="customer_name" disabled>
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->display_name }}
                                    </option>
                                </select>
                                <input type="hidden" name="customer_id" value="{{ $customer->id }}" id="customer_id" data-url="{{ route('menu_details.currency',['id' => $customer->id ]) }}">
                                <p class="text-danger customer_name"></p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="menu_item_name" class=" form-label font-20 fw-bold">Currency</label>
                                <select class="form-select shadow" name="currency" id="currency">
                                    <option value="" selected>Select Currency</option>
                                    @foreach($currencies as $currency)
                                    <option value="{{ $currency->id }}" @if($customer->currency) @if($customer->currency->id == $currency->id) selected @endif @endif>{{ $currency->code }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>



                        <div class="d-flex justify-space-between mx-3">
                           <div class="col-md">
                                <a href="{{ route('menu_details.exportExcel') }}" class="btn btn-success text-white ">Export to Excel</a>
                            </div>
                            <div class="col-md">
                                <a class="btn btn-info text-white float-end  addmenu"  data-toggle="modal" data-target="#addmenumodel">Add</a>
                            </div>
                        </div>



                        <div class="d-flex justify-space-between mx-3 mt-4 mb-0">
                            <div class="col-md">
                                <a href="#" data-toggle="modal" data-target=".import-excel" class="btn btn-secondary text-white ">Add Excel</a>
                            </div>
                                <div class="col-md">
                                    <a onclick="return myConfirm();" href="{{ Route('menu_details.deleteAll') }}" class="btn py-2 px-2  btn-danger text-white float-end" title="Delete"><i class="fa-solid fa-trash-can  mx-3"></i></a>
                                </div>

                        </div>



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
                                        <td style="text-align:center;">
                                            <a onclick="return myConfirm();" href="{{ Route('menu_details.destroy',['id' => $row->id]) }}" class=" text-danger" title="Delete"><i class="fa-solid fa-trash-can  mx-3"></i></a>
                                            <a data-toggle="modal" data-target="#edititem" data-edit="{{ Route('menu_details.edit.item',['id' => $row->id]) }}" data-menuitem="{{ $row->menu_item_name }}" data-cuisines_order="{{ $row->cuisines_order }}" data-cost="{{ $row->cost_in_inr }}" data-menu_priority="{{ $row->menu_priority }}" data-image="{{ $row->image_thumbnail }}" data-video="{{ $row->video_url }}" class="edititem" title="Edit"><i class="fa-regular fa-pen-to-square text-info "></i></a>

                                        </td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $n++ }}</td>
                                        <td>{{ $row->menu_item_name }}</td>
                                        <td>{{$customer->currency->symbol}} {{ $row->cost_in_inr }}</td>
                                        {{-- <td>{!! chunk_split(substr($row->short_description,0,250),50, "<br>") !!}</td> --}}
                                        <!-- <td>{!! chunk_split(substr($row->detailed_description,0,2500),50, "<br>") !!}</td> -->
                                        <td>
                                            @if($row->category_ids)
                                            @foreach ($categories as $cat)
                                            @if(in_array($cat->id,$row->category_ids))
                                            <div style="display:inline-block">
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

                        <hr>
                        {{-- add menu modal --}}
                        <div class="modal fade" id="addmenumodel" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Menu</h5>
                                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button> --}}
                                    </div>
                                    <div class="modal-body">
                                        <div class="row px-3 " >
                                            <div class="form-group col-md-6">
                                                <label for="cuisines_name" class="form-label font-20  fw-bold">Cuisine Name*</label>
                                                <select class="form-select shadow" name="cuisines_name" id="cuisines_name">
                                                    <option value="select" selected>Select</option>
                                                    @foreach ($cuisines as $cuisine)
                                                    @if($cuisines_last)
                                                    @if($cuisine->cuisine_name == $cuisines_last[0]->cuisines_name)
                                                    <option value="{{ $cuisine->id }}" selected> {{ $cuisine->cuisine_name }}</option>
                                                    @endif
                                                    @endif
                                                    <option value="{{ $cuisine->id }}">
                                                        {{ $cuisine->cuisine_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger cuisines_name"></p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="cuisines_order" class=" form-label font-20 fw-bold">Cuisines Priority</label>
                                                @if($cuisines_last)
                                                <input type="number" name="cuisines_order" value="{{ $cuisines_last[0]->cuisines_order }}" id="cuisines_order" class="form-control shadow">
                                                @else
                                                <input type="number" name="cuisines_order" value="{{ old('cuisines_order') }}" id="cuisines_order" class="form-control shadow">
                                                @error('cuisines_order')
                                                <p class="text-danger ">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="menu_item_name" class=" form-label font-20 fw-bold">Item
                                                    Priority</label>

                                                <input type="number" name="menu_priority" value="{{ old('menu_priority') }}" id="menu_priority" class="form-control shadow">

                                                @endif
                                                @error('menu_priority')
                                                <p class="text-danger ">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="menu_item_name" class=" form-label font-20 fw-bold"> Item
                                                    Name*</label>
                                                <input type="text" name="menu_item_name" value="{{ old('menu_item_name') }}" id="menu_item_name" class="form-control shadow">
                                                <p class="text-danger menu_item_name"></p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="cost_in_inr" class=" form-label font-20 fw-bold">Cost in
                                                    INR</label>
                                                <input type="text" name="cost_in_inr" value="{{ old('cost_in_inr') }}" id="cost_in_inr" class="form-control shadow">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="image_thumbnail" class=" form-label font-20 fw-bold">Image
                                                    Thumbnail*(400*400)</label>
                                                <input type="file" name="image_thumbnail" accept="image/png, image/gif, image/jpeg" class="form-control shadow" id="image_thumbnail">
                                                @error('image_thumbnail')
                                                <p class="text-danger ">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group col-md-6">
                                                <label for="large_image_to_display" class=" form-label font-20 fw-bold">Large
                                                    Image to display(2MB)</label>
                                                <input type="file" name="large_image_to_display" accept="image/png, image/gif, image/jpeg" class="form-control shadow" id="large_image_to_display">
                                            </div> --}}
                                            <div class="form-group col-md-6">
                                                <label for="video_url" class=" form-label font-20 fw-bold">Video URL</label>
                                                <input type="text" name="video_url" value="{{ old('video_url') }}" id="video_url" class="form-control shadow">
                                            </div>

                                            {{-- <div class="form-group col-md-12">
                                                <label for="category_ids" class=" form-label font-20 fw-bold">Category
                                                    Tags</label>

                                                <div class="row">
                                                    <input type="hidden" name="category_ids" id="category_ids">
                                                    @foreach ($categories as $cat)

                                                    <div class="col-md-1" style="margin-bottom:10px;text-align:center;">
                                                        <button onclick="toggleCategory({{ $cat->id }})" class="category" type="button" id="cat{{ $cat->id }}"> <img width="auto" height="40px;" src="{{ asset('/uploads/category_thumbnail/' . $cat->thumbnail_path) }}" alt="">
                                                        </button>
                                                    </div>
                                                    @endforeach

                                                </div>
                                            </div> --}}

                                            <div class="row my-3">
                                                <div class="mt-4 col-md-6">
                                                </div>
                                                <div class=" col-md-6 mt-4">
                                                    <button type="submit" class="btn float-end btn-facebook  btn-rounded add_data">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- add menu modal end --}}

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- edit item modal --}}
<!-- Modal -->
<div class="modal fade" id="edititem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form action="" method="post" id="MyFromEditItem" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Item</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="row px-3 ">
                        <div class="form-group col-md-6">
                            <label for="cuisines_order" class=" form-label font-20 fw-bold">Cuisines Priority</label>
                            <input type="number" name="cuisines_order" value="{{ old('cuisines_order') }}" id="cuisines_order1" class="form-control shadow">
                            @error('cuisines_order')
                            <p class="text-danger ">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="menu_item_name" class=" form-label font-20 fw-bold">Item
                                Priority</label>
                            <input type="number" name="menu_priority" value="{{ old('menu_priority') }}" id="menu_priority1" class="form-control shadow">
                            @error('menu_priority')
                            <p class="text-danger ">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="menu_item_name" class=" form-label font-20 fw-bold"> Item
                                Name*</label>
                            <input type="text" name="menu_item_name" value="{{ old('menu_item_name') }}" id="menu_item_name1" class="form-control shadow">
                            <p class="text-danger menu_item_name"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cost_in_inr" class=" form-label font-20 fw-bold">Cost in
                                INR</label>
                            <input type="text" name="cost_in_inr" value="{{ old('cost_in_inr') }}" id="cost_in_inr1" class="form-control shadow">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image_thumbnail" class=" form-label font-20 fw-bold">Image
                                Thumbnail*(400*400)</label>
                            <input type="file" name="image_thumbnail" accept="image/png, image/gif, image/jpeg" class="form-control shadow" id="image_thumbnail1">
                            <input type="hidden" name="image_thumbnail_hidden" id="image_thumbnail_hidden">
                            <img class="mt-3" width="150px" id="hideimg" src="" alt="">
                            @error('image_thumbnail')
                            <p class="text-danger ">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="video_url" class=" form-label font-20 fw-bold">Video URL</label>
                            <input type="text" name="video_url" value="{{ old('video_url') }}" id="video_url1" class="form-control shadow">
                        </div>

                        {{-- <div class="form-group col-md-12">
                            <label for="category_ids" class=" form-label font-20 fw-bold">Category
                                Tags</label>
                            <div class="row">
                                <input type="hidden" name="category_ids" id="category_ids1">
                                @foreach ($categories as $cat)
                                <div class="col-md-1" style="margin-bottom:10px;text-align:center;">
                                    <button onclick="toggleCategoryItem({{ $cat->id }})" class="category" type="button" id="cat1{{ $cat->id }}"> <img width="auto" height="40px;" src="{{ asset('/uploads/category_thumbnail/' . $cat->thumbnail_path) }}" alt="">
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div> --}}
                        <div class="row my-3">
                            <div class="mt-4 col-md-6">
                            </div>
                            <div class=" col-md-6 mt-4">
                                <button type="submit" class="btn float-end btn-facebook  btn-rounded editvalid">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

{{-- Import Excel --}}


  <!-- Modal -->
  <div class="modal fade import-excel" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('menu_details.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file" class="form-label">Import Data</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>
            <div class="modal-footer row mb-0">
                <div class="col text-start">
                    <button type="button" class="btn btn-danger" style="width: 50%"
                        data-dismiss="modal">Close</button>
                </div>
                <div class="col text-end">
                    <button type="submit" class="btn btn-success" style="width: 50%">Save</button>
                </div>
            </div>
          </form>

        </div>

      </div>
    </div>
  </div>



{{-- edit item modal --}}
<script type="text/javascript">
    function myConfirm() {
        var result = confirm("Are you sure you want to delete?");
        if (result == true) {
            return true;
        } else {
            return false;
        }
    }
    var category_ids = [];

    function toggleCategoryItem(category_id) {

        console.log(category_id);
        var index = category_ids.indexOf(category_id);
        if (index >= 0) {
            category_ids.splice(index, 1);
            $('#cat1' + category_id).css('border', 'none')
        } else {
            category_ids.push(category_id);
            $('#cat1' + category_id).css('border', '2px solid red')
        }
        $("#category_ids1").val(category_ids);
    }

    function toggleCategory(category_id) {
        console.log(category_id);
        var index = category_ids.indexOf(category_id);
        if (index >= 0) {
            category_ids.splice(index, 1);
            $('#cat' + category_id).css('border', 'none')
        } else {
            category_ids.push(category_id);
            $('#cat' + category_id).css('border', '2px solid red')
        }
        $("#category_ids").val(category_ids);
    }

    $(document).ready(function() {
        //edit item
        $(document).on('click', '.edititem', function() {
            var url = $(this).attr('data-edit');

            var menuitem = $(this).attr('data-menuitem');
            var cuisines = $(this).attr('data-cuisines_order');
            var cost = $(this).attr('data-cost');
            var menu_priority = $(this).attr('data-menu_priority');
            var image = $(this).attr('data-image');
            var video = $(this).attr('data-video');
            var path = "{{ asset('/uploads/image_thumbnail/') }}/" + image;

            $('#hideimg').attr('src', path);

            $('#cuisines_order1').val(cuisines);
            $('#image_thumbnail_hidden').val(image);
            $('#menu_priority1').val(menu_priority);
            $('#menu_item_name1').val(menuitem);
            $('#cost_in_inr1').val(cost);
            $('#video_url1').val(video);
            $('#MyFromEditItem').attr('action', url);

           // $('#edititem').modal('show');

        });
        //edit item validations
        $(document).on('click', '.editvalid', function() {
            var menu_item = $('#menu_item_name1').val();
            if (menu_item == '') {
                alert('Please Enter Item Name');
                return false;
            }

        });
        //currency update
        $(document).on('change', '#currency', function() {
            var currency = $(this).val();
            var urls = $('#customer_id').attr('data-url');

            $.ajax({
                type: 'POST'
                , url: urls
                , data: {
                    currency: currency
                    , '_token': "{!! csrf_token() !!}"
                , }
                , success: function(respons) {

                }

            });
        });
        $(document).on('click', '.category', function() {
            // var array = [];
            var id = $(this).attr('data-id');
            $('#category_tag').val(id);

        });

//add menu model
$(document).on('click','.addmenu', function() {
    //$('#addmenumodel').modal('show');
})
        $('#customer_name').select2();
        $("#currency").select2();
        var img = '{{ asset("/uploads/category_thumbnail/") }}';
        $(document).on('click', '.add_data', function() {

            var customer = $("#customer_name option:selected").text().trim();
            var currency = $('#currency').val();
            var cuisines = $('#cuisines_name option:selected').text().trim();
            var menu_priority = $('#menu_priority').val();
            var menu_item = $('#menu_item_name').val();
            var image_thumbnail = $('#image_thumbnail').val();
            var large_image_to_display = $('#large_image_to_display').val();
            var video_url = $('#video_url').val();
            var category_ids = $('#category_ids').val();
            var cost_in = $('#cost_in_inr').val();
            var category = $('#category_tag').val();
            var details = $('#detailed_description').val();
            var short = $('#short_description').val();

            if (customer == "Select Customer...") {
                $('.customer_name').text('The customer field is required');
                setTimeout(function() {
                    $('.customer_name').text('');
                }, 3000);
                $(window).scrollTop(0);
                return false;
            }

            if (cuisines == "Select Cuisine") {
                $('.cuisines_name').text('The cuisines field is required');
                setTimeout(function() {
                    $('.cuisines_name').text('');
                }, 3000);
                $(window).scrollTop(0);
                return false;
            }
            if (menu_item == "") {
                $('.menu_item_name').text('The menu item field is required');
                setTimeout(function() {
                    $('.menu_item_name').text('');
                }, 3000);
                $(window).scrollTop(0);
                return false;
            }
            if (short == "") {
                $('.short_description').text('The short description field is required');
                setTimeout(function() {
                    $('.short_description').text('');
                }, 3000);

                return false;
            }


        });

        $(document).on('click', '.delete', function() {
            $(this).closest("tr").remove();
        });


        // var price = document.getElementsByClassName("preis");
        // price.addEventListener("click", output, true);
    });

</script>
@endsection
