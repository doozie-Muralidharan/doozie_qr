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

                            <input type="hidden" name="menu_details" id="menu_details">
                            <div class="row px-3">
                                <div class="form-group col-md-6">
                                    <label for="menu_item_name" class=" form-label font-20 fw-bold"> Customer name*</label>
                                    <select class="form-select shadow" name="customer_name" id="customer_name">
                                    <option value="select">Select Customer...</option>
                                        @foreach ($customer_name as $customer)
                                            <option value="{{ $customer->id }}">
                                                {{ $customer->display_name }}</option>
                                        @endforeach
                                    </select>
                                        <p  class="text-danger customer_name"></p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="menu_item_name" class=" form-label font-20 fw-bold">Currency</label>
                                    <select class="form-select shadow" name="currency" id="currency">
                                        <option value="" selected>Select Currency</option>
                                        @foreach($currency as  $value)
                                        <option value="{{ $value->code }}">{{ $value->code }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cuisines_name" class="form-label  fw-bold text-secondary">Cuisine Name*</label>
                                    <select class="form-select shadow" name="cuisines_name" id="cuisines_name">
                                        <option value="select" selected>Select Cuisine</option>
                                        @foreach ($menuDetails as $cuisineName)
                                            <option value="{{ $cuisineName->id }}">
                                                {{ $cuisineName->cuisine_name }}</option>
                                        @endforeach
                                    </select>
                                        <p class="text-danger cuisines_name"></p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="menu_item_name" class=" form-label font-20 fw-bold">Menu
                                        Priority</label>
                                    <input type="number" name="menu_priority" value="{{ old('menu_priority') }}" id="menu_priority"
                                        class="form-control shadow">
                                    @error('menu_priority')
                                        <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="menu_item_name" class=" form-label font-20 fw-bold">Menu Item
                                        Name*</label>
                                    <input type="text" name="menu_item_name" value="{{ old('menu_item_name') }}" id="menu_item_name"
                                        class="form-control shadow">
                                        <p class="text-danger menu_item_name"></p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cost_in_inr" class=" form-label font-20 fw-bold">Cost in
                                        INR</label>
                                    <input type="text" name="cost_in_inr" value="{{ old('cost_in_inr') }}" id="cost_in_inr"
                                        class="form-control shadow">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image_thumbnail" class=" form-label font-20 fw-bold">Image
                                        Thumbnail*(400*400)</label>
                                    <input type="file" name="image_thumbnail" accept="image/png, image/gif, image/jpeg" class="form-control shadow" id="image_thumbnail">
                                    @error('image_thumbnail')
                                        <p class="text-danger ">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="large_image_to_display" class=" form-label font-20 fw-bold">Large
                                        Image to display(2MB)</label>
                                    <input type="file" name="large_image_to_display" accept="image/png, image/gif, image/jpeg" class="form-control shadow" id="large_image_to_display">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="video_url" class=" form-label font-20 fw-bold">Video URL</label>
                                    <input type="text" name="video_url" value="{{ old('video_url') }}" id="video_url"
                                        class="form-control shadow">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="video_url" class=" form-label font-20 fw-bold">Add Category
                                        Tag</label>

                                    <div class="row">
                                        @foreach ($category as $cat)

                                            <div class="col-md-2 mx-2">
                                                <button class="" type="button" id=""
                                                    data-img="{{ asset('/uploads/category_thumbnail/' . $cat->thumbnail_path) }}"> <img width="80px"
                                                        src="{{ asset('/uploads/category_thumbnail/' . $cat->thumbnail_path) }}"
                                                        alt="">
                                                        <input type="hidden" name="category_tag" id="category_tag" value="{{ $cat->thumbnail_path }}">
                                                </button>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="detailed_desciption" class=" form-label font-20 fw-bold">Detailed
                                        Description</label>
                                    <textarea name="detailed_description" class="form-control shadow" id="detailed_description" cols="5" rows="3">{{ old('detailed_description') }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="short_description" class=" form-label font-20 fw-bold">Short
                                        Description*</label>
                                    <textarea name="short_description" class="form-control shadow" id="short_description" cols="5" rows="3">{{ old('short_description') }}</textarea>
                                        <p class="text-danger text-sm mt-1 short_description"></p>
                                </div>
                                <div class="row my-3">
                                    <div class="mt-4 col-md-6">
                                    </div>
                                    <div class=" col-md-6 mt-4">
                                        <button type="button" class="btn float-end btn-facebook  btn-rounded add_data">Add</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0 border">
                                        <thead>
                                            <th class="  text-secondary  opacity-7">Customer name</th>
                                            <th class="  text-secondary  opacity-7">Currency</th>
                                            <th class="  text-secondary  opacity-7">Cuisine</th>
                                            <th class="  text-secondary  opacity-7">Menu</th>
                                            <th class="  text-secondary  opacity-7">Menu Item</th>
                                            <th class="  text-secondary  opacity-7">Cost in</th>
                                            <th class="  text-secondary  opacity-7">Category</th>
                                            <th class="  text-secondary  opacity-7">Detailed</th>
                                            <th class="  text-secondary  opacity-7">Short</th>

                                            <th class="  text-secondary  opacity-7">Action</th>
                                        </thead>
                                        <tbody class="data">
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row ">
                                    <div class="mt-4 col-md-6">
                                        <a href="{{ URL::previous() }}"
                                            class="btn bg-gradient-danger btn-sm btn-rounded">Cancel</a>
                                    </div>
                                    <div class=" col-md-6 mt-4">
                                        <button class="btn float-end bg-gradient-success btn-sm btn-rounded save">Proceed</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script type="text/javascript">
        $(document).ready(function() {
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

                var cost_in = $('#cost_in_inr').val();
                var category = $('#category_tag').val();
                var details = $('#detailed_description').val();
                var short = $('#short_description').val();

                if(customer == "Select Customer..."){
                    $('.customer_name').text('The customer field is required');
                    setTimeout(function() {
                        $('.customer_name').text('');
                    }, 3000);
                        $(window).scrollTop(0);
                    return false;
                }

                if(cuisines == "Select Cuisine"){
                    $('.cuisines_name').text('The cuisines field is required');
                    setTimeout(function() {
                        $('.cuisines_name').text('');
                    }, 3000);
                        $(window).scrollTop(0);
                    return false;
                }
                if(menu_item == ""){
                    $('.menu_item_name').text('The menu_item field is required');
                    setTimeout(function() {
                        $('.menu_item_name').text('');
                    }, 3000);
                        $(window).scrollTop(0);
                    return false;
                }
                if(short == ""){
                    $('.short_description').text('The short description field is required');
                    setTimeout(function() {
                        $('.short_description').text('');
                    }, 3000);

                    return false;
                }

                $('.data').append('\
                    <tr>\
                        <td class="text-center customer">'+ customer +' </td>\
                        <td class="text-center currency">'+ currency +' </td>\
                        <td class="text-center cuisines">'+ cuisines +' </td>\
                        <td class="text-center menu_priority">'+ menu_priority +' </td>\
                        <td class="text-center menu_item">'+ menu_item +' </td>\
                        <td class="text-center cost_in">'+ cost_in +' </td>\
                        <td class="text-center category" style="display:none">'+ category +' </td>\
                        <td class="text-center image_thumbnail" style="display:none">'+ image_thumbnail +' </td>\
                        <td class="text-center large_image_to_display" style="display:none">'+ large_image_to_display +' </td>\
                        <td class="text-center video_url" style="display:none">'+ video_url +' </td>\
                        <td class="text-center"><img src='+img+'/'+category +' width="80px" alt=""> </td>\
                        <td class="text-center details">'+ details +' </td>\
                        <td class="text-center short">'+ short +' </td>\
                        <td class="text-center"> <i class="fa-solid fa-trash-can  delete text-danger"></i></td>\
                    </tr>\
                ');
            });

            $(document).on('click', '.delete', function() {
                $(this).closest("tr").remove();
             });

             //save
             $(document).on('click', '.save', function() {

                var menu_details = {};
                    var count = 0;
                    $(".data > tr").each(function() {
                        menu_details[count] = {};

                        menu_details[count]['currency'] = $(this).closest('tr').find('.currency')
                            .text()
                        menu_details[count]['menu_priority'] = $(this).closest('tr').find(
                            '.menu_priority').text()
                        menu_details[count]['menu_item'] = $(this).closest('tr').find(
                            '.menu_item').text()
                        menu_details[count]['cost_in'] = $(this).closest('tr').find('.cost_in').text()
                        menu_details[count]['category'] = $(this).closest('tr').find('.category').text()
                        menu_details[count]['details'] = $(this).closest('tr').find('.details').text()
                        menu_details[count]['short'] = $(this).closest('tr').find('.short').text()
                        menu_details[count]['image_thumbnail'] = $(this).closest('tr').find('.image_thumbnail').text()
                        menu_details[count]['large_image_to_display'] = $(this).closest('tr').find('.large_image_to_display').text()
                        menu_details[count]['video_url'] = $(this).closest('tr').find('.video_url').text()
                        count++;
                    });
                    $("#menu_details").val(JSON.stringify(menu_details));

                    $('#myform').submit();
             });
            // var price = document.getElementsByClassName("preis");
            // price.addEventListener("click", output, true);
        });
    </script>
@endsection
