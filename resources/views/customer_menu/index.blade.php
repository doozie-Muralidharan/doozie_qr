@extends('customer_menu.layout.main')
<style>
    .modal-content {
        background: none !important;
        border: none !important;
    }

    .navbar-toggler:focus {
        box-shadow: none !important;
    }

    .myform {
        text-align: center;
        padding: 5px;

    }

    .qty {
        width: 22px;
        text-align: center;
    }

    input.qtyplus {
        width: 22px;
    }

    input.qtyminus {
        width: 22px;
    }
</style>
@section('title')
<title>{{ $customer->restaurant_name }}</title>
@endsection

@section('logo_img')
<div class="row">
    <div class="col-md-2">
        <a href="#" class="navbar-brand" style="margin-right: 0px !important;magin-top:10px;">
            <img src="{{ asset('uploads/customer_logo/') }}/{{ $customer->logo_path }}" onerror="this.onerror=null; this.src='https://app.vinrindia.com/img/footer-logo-1.png'" alt="VINR" width="100px"></a>
        <!-- @if ($customer->instagram_link != '')
    <a class="text-decoration-none" href="{{ $customer->instagram_link }}"><i
                            class="fa-brands text-light fa-instagram    "></i> </a>
    @endif
                @if ($customer->facebook_link != '')
    <a class="text-decoration-none" href="{{ $customer->facebook_link }}"><i
                            class="fa-brands text-light fa-facebook     "></i> </a>
    @endif
                @if ($customer->zomato != '')
    <a class="text-decoration-none" href="{{ $customer->zomato }}"><img class="mb-3 rounded-4" width="35px"
                            src="uploads/customer_logo/zomate-icon.png" alt=""> </a>
    @endif -->

    </div>

</div>
@endsection
@section('phone_number')
<div class="d-flex justify-content-center align-items-center">
    <div>
        @if ($customer->contact_type == 'Whatsapp')
        <a href="https://wa.me/{{ $customer->contact_type_value }}"><i class="fab fa-whatsapp mx-2" style="color:green;font-size:1.5em;"></i></a>
        @elseif($customer->contact_type == 'Call')
        <a href="tel:{{ $customer->contact_type_value }}"><i class="fas fa-phone  mx-2"></i></a>
        @elseif($customer->contact_type == 'Swiggy')
        <a href="https://www.swiggy.com/search?q={{ $customer->contact_type_value }}"><img src="{{ asset('logos/swiggy.png') }}" alt="Swiggy logo" height="35"></a>
        @elseif($customer->contact_type == 'Zomato')
        <a href="https://www.zomato.com/search?entity_id={{ $customer->contact_type_value }}"><img src="{{ asset('logos/Zomato-Logo-Font-LOGO.png') }}" alt="Zomato logo" height="35"></a>
        @endif

    </div>


    {{-- <i class="fa-solid fa-cart-plus text-light      mx-2" data-toggle="modal" data-target="#cartmodal"></i> --}}
</div>
@endsection
@section('content')
    <div class="container bg-black">
        {{-- <h1 style="color:brown;margin:20px 0;">{{$customer->display_name}} - Menu </h1> --}}
        <span class="d-sm-none d-md-block d-md-none d-lg-block d-none d-sm-block">
            <ul class="nav nav-tabs " id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link border mx-2 my-2 active" id="all-tab" data-bs-toggle="tab"
                        data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">
                        <h5>All</h5>
                    </button>
                </li>
                @foreach ($cuisines_names as $cuisines_name)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link border mx-2 my-2 " id="{{ Str::slug($cuisines_name) }}-tab"
                            data-bs-toggle="tab" data-bs-target="#{{ Str::slug($cuisines_name) }}" type="button"
                            role="tab" aria-controls="{{ Str::slug($cuisines_name) }}" aria-selected="true">
                            <h5>{{ $cuisines_name }}</h5>
                        </button>
                    </li>
                @endforeach
            </ul>
        </span>
    @section('menu')
        <li class="nav-item d-md-none d-lg-none d-lg-block" role="presentation">
            <button class="hidebtn btn btn-outline-light rounded-pill border-0 px-2 py-1 me-2 mb-2" id="all-tab" data-bs-toggle="tab"
                data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">
                All
            </button>
        </li>

        @foreach ($cuisines_names as $cuisines_name)
            <li class="nav-item d-md-none d-lg-none d-lg-block" role="presentation">
                <a class="hidebtn btn btn-outline-light rounded-pill border-0 px-2 py-1 me-2 mb-2"  href="#{{ Str::slug($cuisines_name) }}" data-bs-toggle="tab" role="tab" aria-controls="{{ Str::slug($cuisines_name) }}" aria-selected="true">{{ $cuisines_name }}</a>
            </li>
            @foreach ($cuisines_names as $cuisines_name)
            <li class="nav-item" role="presentation">
                <button class="nav-link border mx-2 my-2 " id="{{ Str::slug($cuisines_name) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ Str::slug($cuisines_name) }}" type="button" role="tab" aria-controls="{{ Str::slug($cuisines_name) }}" aria-selected="true">
                    <h5>{{ $cuisines_name }}</h5>
                </button>
            </li>
            @endforeach
        </ul>
    </span>
    @section('menu')

    <li class="nav-item d-md-none d-lg-none d-lg-block" role="presentation">
        <a class="hidebtn btn btn-outline-light rounded-pill border-0 px-2 py-1 me-2 mb-2" href="#all" data-bs-toggle="tab" role="tab" aria-controls="all" aria-selected="true">All</a>
    </li>

    @foreach ($cuisines_names as $cuisines_name)
    <li class="nav-item d-md-none d-lg-none d-lg-block" role="presentation">
        <a class="hidebtn btn btn-outline-light rounded-pill border-0 px-2 py-1 me-2 mb-2" href="#{{ Str::slug($cuisines_name) }}" data-bs-toggle="tab" role="tab" aria-controls="{{ Str::slug($cuisines_name) }}" aria-selected="true">{{ $cuisines_name }}</a>
    </li>

    @endforeach
    @endsection

    <div class="tab-content" id="myTabContent" style="overflow-y:scroll;">

        <div class="tab-pane fade  show active  " id="all" role="tabpanel" aria-labelledby="all-tab">
            @foreach ($cuisines_names as $cuisines_name)
            <h3 class="text-center text-bg-danger py-2"> {{ $cuisines_name }}</h3>
            <div class="menu">

                @foreach ($menu_details as $row)
                @php
                $n = 1;
                @endphp
                @if ($cuisines_name == $row->cuisines_name)
                <div class="card bg-black text-light">
                    <div class="card-dish">
                        <a href="#" class="@if ($row->video_url) play_video @endif" data-video="{{ $row->video_url }}">
                            <img src="{{ asset('uploads/image_thumbnail/' . $row->image_thumbnail) }}" class="card-img" alt="">
                        </a>
                        <b class="text-center"> {{ $row->menu_item_name }}</b>

                        @if ($row->cost_in_inr > 0)
                        <h3 class="card-rate">
                            <span>{{ $customer->currency->symbol }}</span>
                            <span>{{ $row->cost_in_inr }}</span>
                        </h3>
                        @endif

                    </div>
                    {{-- <div  class="mb-5 ">
                                    <input type='hidden' name='' id="qtyhidden" value='1' />
                                    <button id="btnAdd" style="width: 44px"
                                        class="addToCart text-end  btn-outline-success float-end btn btn-sm"
                                        data-pname="{{ $row->menu_item_name }}" data-price="{{ $row->cost_in_inr }}"
                    data-id="{{ $row->id }}">Add</button>
                </div> --}}

                <div style="display:inline-block;text-align:center">
                    @if ($row->category_ids)
                    @foreach ($categories as $cat)
                    @if (in_array($cat->id, $row->category_ids))
                    <img width="auto" height="40px;" src="{{ asset('/uploads/category_thumbnail/' . $cat->thumbnail_path) }}" alt="">
                    @endif
                    @endforeach
                    @endif
                </div>

            </div>
            @endif
            @endforeach

        </div>
        @endforeach
    </div>



    @foreach ($cuisines_names as $cuisines_name)
    <div class="tab-pane fade  " id="{{ Str::slug($cuisines_name) }}" role="tabpanel" aria-labelledby="{{ Str::slug($cuisines_name) }}-tab">
        <h3 class="text-center text-bg-danger py-2"> {{ $cuisines_name }}</h3>

        <div class="menu">
            @foreach ($menu_details as $row)
            @php
            $n = 1;
            @endphp
            @if ($cuisines_name == $row->cuisines_name)
            <div class="card bg-black text-light">
                <div class="card-dish">

                    <a href="#" class="@if ($row->video_url) play_video @endif" data-video="{{ $row->video_url }}">
                        <img src="{{ asset('uploads/image_thumbnail/' . $row->image_thumbnail) }}" class="card-img" alt="">
                    </a>
                    <b> {{ $row->menu_item_name }}</b>

                    @if ($row->cost_in_inr > 0)
                    <h3 class="card-rate">{{ $customer->currency->symbol }}
                        {{ $row->cost_in_inr }}
                    </h3>
                    @endif
                </div>
                {{--
                    <div style="display:inline-block;text-align:center">
                        @if ($row->category_ids)
                        @foreach ($categories as $cat)
                        @if (in_array($cat->id, $row->category_ids))
                        <img width="auto" height="40px;" src="{{ asset('/uploads/category_thumbnail/' . $cat->thumbnail_path) }}" alt="">
                @endif
                @endforeach
                @endif
            </div> --}}

        </div>
        @endif
        @endforeach

    </div>
</div>
@endforeach

</div>
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid" id="video_body">

                </div>
            </div>
        </div>
    </div>
</div>
</div>
{{-- add to cart script --}}
<!-- Modal -->
<!-- Modal -->

<div class="modal fade" id="cartmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog bg-body" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Cart</h5>

            </div>
            <div class="modal-body">
                {{-- <form id='' method='POST' class='quantity text-center text-end' action='#'><input type='button' value='-' datau-price='"+ item.Price +"' datau-pname='" + item.Product + "' class='qtyminus minus' field='quantity' /><input type='text' name='' id='quantity' value='1' class='qty' /> <input type='button' value='+' datau-price='"+ item.Price +"' datau-pname='" + item.Product + "' class='qtyplus plus1' field='quantity' /></form> --}}
                <table id="cart" class="border" style="visibility:hidden; width:100%; font-size: x-small;">
                    <thead>
                        <tr>
                            <th class='p-2'>Menu Item</th>
                            <th class=''>Price</th>
                            <th style="width: 82px" class='p-2'>Qty</th>
                            <th class=''>All Total</th>
                            <th class='p-2'></th>
                        </tr>
                    </thead>
                    <tbody id="cartBody">

                    </tbody>
                </table>
                <div class="row">
                    <table>
                        <tr>
                            <td class="px-3">Grand total :</td>
                            <td class="text-end px-3"> <b class="gtotal"></b></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var cart = [];
    $(function() {
        if (localStorage.cart) {
            cart = JSON.parse(localStorage.cart);
            showCart();
        }
    });


    $(document).on('click', '.addToCart', function() {
        var price = $(this).attr('data-price');
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-pname');
        var qty = $("#qtyhidden").val();

        // update qty if product is already present
        for (var i in cart) {
            if (cart[i].Product == name) {
                cart[i].Qty = qty;
                showCart();
                saveCart();
                return;
            }
        }
        // create JavaScript Object
        var item = {
            Product: name,
            Price: price,
            Qty: qty
        };
        cart.push(item);
        saveCart();
        showCart();
    })


    function deleteItem(index) {
        cart.splice(index, 1); // delete item at index
        showCart();
        saveCart();
    }

    function saveCart() {
        if (window.localStorage) {
            localStorage.cart = JSON.stringify(cart);
        }
    }

    function showCart() {
        if (cart.length == 0) {
            $("#cart").css("visibility", "hidden");
            return;
        }

        $("#cart").css("visibility", "visible");
        $("#cartBody").empty();
        $('.gtotal').text('')
        var total = '';
        for (var i in cart) {
            var item = cart[i];
            var row = "<tr class='border'><td class='p-2'>" + item.Product + "</td>\
                    <td class='p-2'>" + item.Price +
                "</td>\
                    <td class='quantity'><form id='' method='POST' class=' text-center text-end' action='#'><input type='button' value='-' datau-price='" +
                item.Price + "' datau-pname='" + item.Product +
                "' class='qtyminus minus mx-1' field='quantity' /><input type='text' name='' id='quantity' value='" +
                item.Qty + "' class='qty' /> <input type='button' value='+' datau-price='" + item.Price +
                "' datau-pname='" + item.Product + "' class='qtyplus plus1' field='quantity' /></form></td>\
                    <td class='p-2'>" + item.Qty * item.Price + "</td>\
                    <td class='p-2'>" + "<button class='btn btn-sm text-danger ' onclick='deleteItem(" + i +
                ")'><i class='fa-solid fa-trash'></i></button></td></tr>";
            $("#cartBody").append(row);
            var d = item.Qty * item.Price;
            var total = Number(total) + Number(item.Qty * item.Price);

        }
        $('.gtotal').text(total)
    }
    $(document).ready(function() {
        $(document).on('click', '.plus1', function(e) {

            let $input = $(this).prev('input.qty');
            let val = parseInt($input.val());
            $input.val(val + 1).change();
            let val1 = parseInt($input.val());


            var price = $(this).attr('datau-price');
            var id = $(this).attr('datau-id');
            var name = $(this).attr('datau-pname');
            var qty = val1;

            // update qty if product is already present
            for (var i in cart) {
                if (cart[i].Product == name) {
                    cart[i].Qty = qty;
                    showCart();
                    saveCart();
                    return;
                }
            }
            // create JavaScript Object
            var item = {
                Product: name,
                Price: price,
                Qty: qty
            };
            cart.push(item);
            saveCart();
            showCart();

        });

        $(document).on('click', '.minus', function() {
            let $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            if (val > 1) {
                $input.val(val - 1).change();
                let val1 = parseInt($input.val());
                var price = $(this).attr('datau-price');
                var id = $(this).attr('datau-id');
                var name = $(this).attr('datau-pname');
                var qty = val1;

                // update qty if product is already present
                for (var i in cart) {
                    if (cart[i].Product == name) {
                        cart[i].Qty = qty;
                        showCart();
                        saveCart();
                        return;
                    }
                }
                // create JavaScript Object
                var item = {
                    Product: name,
                    Price: price,
                    Qty: qty
                };
                cart.push(item);
                saveCart();
                showCart();

            }
        });
    })
</script>

<script>
    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
        // Use above variables to manipulate the DOM
    });
</script>
<script>
    $(function() {
        $('#tab_selector').on('change', function(e) {
            $('.form-tabs li a').eq($(this).val()).tab('show');
        });

        $(document).ready(function() {
            $(document).on('click', '.play_video', function() {
                $('#video_body').html($(this).attr('data-video'));
                $('#modelId').modal('show');

            })
            $(document).on('click', '.hidebtn', function() {
                $('#navbarSupportedContent').removeClass('show');
            });

            $('#modelId').on('hidden.bs.modal', function(e) {
                $('#video_body').html("");
            })
        })


    });
</script>

<style>
    .card-rate {
        display: flex;
        align-items: center;
    }

    .card-rate span {
        margin-left: 5px;


    }
</style>
@endsection