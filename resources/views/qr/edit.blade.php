@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'QR Code Details'])
<style>
    /* Custom style */
    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='%23333' xmlns='http://www.w3.org/2000/svg'%3e%3cpath fill-rule='evenodd' d='M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z' clip-rule='evenodd'/%3e%3c/svg%3e");
        transform: scale(.7) !important;
    }

    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='%23333' xmlns='http://www.w3.org/2000/svg'%3e%3cpath fill-rule='evenodd' d='M0 8a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2H1a1 1 0 0 1-1-1z' clip-rule='evenodd'/%3e%3c/svg%3e");
    }

    .upload-photo {
        opacity: 0;
        position: absolute;
        z-index: -1;
    }

    .class_two {
        border: #004eff 5px solid;
        ;
    }

</style>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6 class="fw-bolder">QR Code details</h6>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container p-0 mb-4">

                        <form method="post" id="myform" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="accordion" id="myAccordion">
                                        <div class="accordion-item mt-3" id="1">
                                            <h2 class="accordion-header bg-light" id="headingTwo">
                                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo"><span style="margin-right: 33px;"><i class="fa fa-paint-brush " aria-hidden="true"></i></span><b class="">Set Colors</b></button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse " data-bs-parent="#myAccordion">
                                                <div class="card-body">
                                                    <h5> Foreground Color</h5>
                                                    <div class="contanier">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-check mb-2">
                                                                    <label class="form-check-label" for="">Single Color</label>
                                                                    <input class="form-check-input" type="radio" id="gradient-hide" name="single_color" value="1" checked>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check mb-2">
                                                                    <label class="form-check-label" for="">Color Gradient</label>
                                                                    <input class="form-check-input" type="radio" id="gradientch" name="single_color" value="0">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <label class="form-check-label" for=""> Custom Eye Color </label>
                                                                    <input class="form-check-input " type="checkbox" name="blankCheckbox" id="blankCheckbox">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input class="border-0 btn-group h-100 p-0" type="color" id="colorpicker" name="color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000">
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control w-65" type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000" id="hexcolor">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 gradient" style="display: none">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input class="border-0 btn-group h-100 p-0" type="color" id="gradient" name="gradient" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#0277BD">
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control w-65" type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#0277BD" id="gradient1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 gradient" style="display: none">
                                                                <div class="row">
                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-light gradient-change" type="button"><i class="fa fa-exchange"></i></button>
                                                                        </span>
                                                                        <select ng-model="qrcode.config.gradientType" class="bg-gray-100 fa-1x form-control h-75 px-2" style="" id="gradientType">
                                                                            <option value="linear" selected="selected">Linear Gradient</option>
                                                                            <option value="radial">Radial Gradient</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3 eyes" style="display: none">
                                                            <h5>Eye Color</h5>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input class="border-0 btn-group h-100 p-0" type="color" id="eyecolor1" name="eyecolor1" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000">
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control w-65" type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000" id="eyecolor-1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input class="border-0 btn-group h-100 p-0" type="color" id="eyecolor2" name="eyecolor2" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000">
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control w-65" type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000" id="eyecolor-2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input class="border-0 btn-group h-100 p-0" type="color" id="eyecolor3" name="eyecolor3" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000">
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control w-65" type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000" id="eyecolor-3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4" hidden>
                                                                <div class="row">
                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-light eye-change" type="button"><i class="fa fa-exchange"></i></button>
                                                                        </span>
                                                                        <!-- <input disabled class="bg-gray-100 fa-1x form-control h-75 px-2" type="button" value="Copy Foreground"> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3 eyes" style="display: none">
                                                            <h5>Eye Ball Color</h5>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input class="border-0 btn-group h-100 p-0" type="color" id="eyeballcolor1" name="eyeballcolor1" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000">
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control w-65" type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000" id="eyeballcolor-1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input class="border-0 btn-group h-100 p-0" type="color" id="eyeballcolor2" name="eyeballcolor2" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000">
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control w-65" type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000" id="eyeballcolor-2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input class="border-0 btn-group h-100 p-0" type="color" id="eyeballcolor3" name="eyeballcolor3" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000">
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control w-65" type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#000000" id="eyeballcolor-3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4" hidden>
                                                                <div class="row">
                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-light eye-change" type="button"><i class="fa fa-exchange"></i></button>
                                                                        </span>
                                                                        <!-- <input disabled class="bg-gray-100 fa-1x form-control h-75 px-2" type="button" value="Copy Foreground"> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <h5>Background Color</h5>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input class="border-0 btn-group h-100 p-0" type="color" id="bgcolor" name="bgcolor" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#FFFFFF">
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control w-65" type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#FFFFFF" id="bgcolor1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item my-2" id="2">
                                            <h2 class="accordion-header bg-light" id="headingOne">
                                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne"><span style="margin-right: 33px;"><i class="fa fa-picture-o " aria-hidden="true"></i></span><b class="">Add Logo Image</b></button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="bg-gray-100 border-dashed height-200 py-3 text-bolder text-center  w-xxl-90">
                                                                <span class="nologo pt-7"> NO LOGO</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="bg-info border border-radius-xl p-2 text-lg text-white" for="uploadphoto">Upload Image</label>
                                                                <input class="upload-photo log_img" type="file" name="log_img" id="uploadphoto" />
                                                                <input type="hidden" id="uploadphoto_path" />
                                                            </div>
                                                            <button class="btn btn-default" type="button" id="remove_image">Remove Image</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item" id="3">
                                            <h2 class="accordion-header bg-light" id="headingThree">
                                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree"><span style="margin-right: 33px;"><i class="fa fa-qrcode " aria-hidden="true"></i></span><b class="">Customize Design</b></button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <h5>Body Shape</h5>
                                                        <input type="hidden" name="bodylogo" id="bodylogo">
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor " src="{{ asset('vendor/qrcodemonkey/qrcode/body/circle-zebra-vertical.png') }}" bodycolor="circle-zebra-vertical" alt="">
                                                            </a>

                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" src="{{ asset('vendor/qrcodemonkey/qrcode/body/circle-zebra.png') }}" bodycolor="circle-zebra" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" src="{{ asset('vendor/qrcodemonkey/qrcode/body/circle.png') }}" bodycolor="circle" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" src="{{ asset('vendor/qrcodemonkey/qrcode/body/circular.png') }}" bodycolor="circular" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" src="{{ asset('vendor/qrcodemonkey/qrcode/body/diamond.png') }}" bodycolor="diamond" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" src="{{ asset('vendor/qrcodemonkey/qrcode/body/dot.png') }}" bodycolor="dot" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" src="{{ asset('vendor/qrcodemonkey/qrcode/body/edge-cut-smooth.png') }}" bodycolor="edge-cut-smooth" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="edge-cut" src="{{ asset('vendor/qrcodemonkey/qrcode/body/edge-cut.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="japnese" src="{{ asset('vendor/qrcodemonkey/qrcode/body/japnese.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="leaf" src="{{ asset('vendor/qrcodemonkey/qrcode/body/leaf.png') }}" alt="">
                                                            </a>
                                                        </div>

                                                        {{-- 12 --}}
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="mosaic" src="{{ asset('vendor/qrcodemonkey/qrcode/body/mosaic.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="pointed-edge-cut" src="{{ asset('vendor/qrcodemonkey/qrcode/body/pointed-edge-cut.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="pointed-smooth" src="{{ asset('vendor/qrcodemonkey/qrcode/body/pointed-smooth.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="pointed-in-smooth" src="{{ asset('vendor/qrcodemonkey/qrcode/body/pointed-in-smooth.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="pointed" src="{{ asset('vendor/qrcodemonkey/qrcode/body/pointed.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="pointed-in" src="{{ asset('vendor/qrcodemonkey/qrcode/body/pointed-in.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="round" src="{{ asset('vendor/qrcodemonkey/qrcode/body/round.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="rounded-in-smooth" src="{{ asset('vendor/qrcodemonkey/qrcode/body/rounded-in-smooth.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="rounded-in" src="{{ asset('vendor/qrcodemonkey/qrcode/body/rounded-in.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="rounded-pointed" src="{{ asset('vendor/qrcodemonkey/qrcode/body/rounded-pointed.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="square" src="{{ asset('vendor/qrcodemonkey/qrcode/body/square.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light bodycolor" bodycolor="star" src="{{ asset('vendor/qrcodemonkey/qrcode/body/star.png') }}" alt="">
                                                            </a>
                                                        </div>

                                                        {{-- 12 --}}



                                                    </div>
                                                    <div class="row mt-3">
                                                        <h5>Eye Frame Shape</h5>
                                                        <input type="hidden" name="eyelogo" id="eyelogo">
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" eyelogo="frame0" class="bg-light eyelogo" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame0.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame1" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame1.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame2" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame2.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame3" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame3.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame4" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame4.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame5" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame5.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame6" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame6.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame7" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame7.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame8" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame8.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame9" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame9.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame10" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame10.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame11" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame11.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame12" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame12.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame13" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame13.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame14" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame14.png') }}" alt="">
                                                            </a>
                                                        </div>

                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyelogo" eyelogo="frame16" src="{{ asset('vendor/qrcodemonkey/qrcode/eye/frame16.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <h5>Eye Ball Shape</h5>
                                                        <input type="hidden" name="eyeball" id="eyeball">
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball0" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball0.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball1" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball1.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball2" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball2.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball3" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball3.png') }}" alt="">
                                                            </a>
                                                        </div>

                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball5" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball5.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball6" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball6.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball7" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball7.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball8" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball8.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball10" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball10.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball11" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball11.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball12" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball12.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball13" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball13.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball14" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball14.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball15" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball15.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball16" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball16.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball17" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball17.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball18" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball18.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 mt-4 mx-1">
                                                            <a>
                                                                <img width="50px" style="border-radius: 5px;" class="bg-light eyeball" eyeball="ball19" src="{{ asset('vendor/qrcodemonkey/qrcode/eyeBall/ball19.png') }}" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div id="qr_code_display" class="mb-4">
                                        <img width="330px" src="{{$qr_details->qr_path}}" alt="">
                                    </div>
                                    <button type="button" class="btn btn-success  mx-3 generate">Generate Qr Code</button>
                                    <a href="{{$qr_details->qr_path}}" id="download_qr" download>
                                        <button type="button" class="btn btn-info flo"> PNG</button>
                                    </a>
                                    <a href="{{str_replace('.png','.eps',$qr_details->qr_path)}}" id="download_qr_eps" download>
                                        <button type="button" class="btn btn-info flo">* EPS</button>
                                    </a>
                                    <a href="{{str_replace('.png','.svg',$qr_details->qr_path)}}" id="download_qr_svg" download>
                                        <button type="button" class="btn btn-info flo"> SVG</button>
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="row " style="float:right;">
                        <div class="col-md-6"><a class="btn btn-danger mx-3" href="{{ route('qr_code_details.index') }}">Cancel</a> </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.bodycolor', function() {
            $('.bodycolor').removeClass('class_two');
            var bodycolor = $(this).attr('bodycolor');
            $(this).addClass('class_two');
            $('#bodylogo').val(bodycolor);
        })

        $(document).on('click', '.eyelogo', function() {
            $('.eyelogo').removeClass('class_two');
            var eyelogo = $(this).attr('eyelogo');
            $(this).addClass('class_two');
            $('#eyelogo').val(eyelogo);

        })
        $(document).on('click', '.eyeball', function() {
            $('.eyeball').removeClass('class_two');
            var eyeball = $(this).attr('eyeball');
            $(this).addClass('class_two');
            $('#eyeball').val(eyeball);
        })
    });
    $(document).ready(function() {
        $('#colorpicker').on('input', function() {
            $('#hexcolor').val(this.value);
        });
        $('#hexcolor').on('input', function() {
            $('#colorpicker').val(this.value);
        });
        //eyecolor1
        $('#eyecolor1').on('input', function() {
            $('#eyecolor-1').val(this.value);
        });
        $('#eyecolor-1').on('input', function() {
            $('#eyecolor1').val(this.value);
        });
        //eyecolor2
        $('#eyecolor2').on('input', function() {
            $('#eyecolor-2').val(this.value);
        });
        $('#eyecolor-2').on('input', function() {
            $('#eyecolor2').val(this.value);
        });
        //eyecolor3
        $('#eyecolor3').on('input', function() {
            $('#eyecolor-3').val(this.value);
        });
        $('#eyecolor-3').on('input', function() {
            $('#eyecolor3').val(this.value);
        });

        //eyeballcolor1
        $('#eyeballcolor1').on('input', function() {
            $('#eyeballcolor-1').val(this.value);
        });
        $('#eyeballcolor-1').on('input', function() {
            $('#eyeballcolor1').val(this.value);
        });
        //eyeballcolor2
        $('#eyeballcolor2').on('input', function() {
            $('#eyeballcolor-2').val(this.value);
        });
        $('#eyeballcolor-2').on('input', function() {
            $('#eyeballcolor2').val(this.value);
        });
        //eyeballcolor3
        $('#eyeballcolor3').on('input', function() {
            $('#eyeballcolor-3').val(this.value);
        });
        $('#eyeballcolor-3').on('input', function() {
            $('#eyeballcolor3').val(this.value);
        });

        //background  color
        $('#bgcolor').on('input', function() {
            $('#bgcolor1').val(this.value);
        });
        $('#bgcolor1').on('input', function() {
            $('#bgcolor').val(this.value);
        });
        //gradient
        $('#gradient').on('input', function() {
            $('#gradient1').val(this.value);
        });
        $('#gradient1').on('input', function() {
            $('#gradient').val(this.value);
        });
        $('#gradientch').on('change', function() {
            if ($(this).is(":checked")) {
                $('.gradient').show();
            }
        });
        $('#gradient-hide').on('change', function() {
            if ($(this).is(":checked")) {
                $('.gradient').hide();
            }
        });

        $('#remove_image').click(function() {
            $('#uploadphoto_path').val('');
            $('.nologo').text('No Logo');

        });
        //image show
        uploadphoto.onchange = evt => {
            const [file] = uploadphoto.files
            if (file) {
                var formData = new FormData();
                formData.append('file', document.querySelector('#uploadphoto').files[0]);
                formData.append('_token', "{!! csrf_token() !!}");

                $.ajax({
                    url: '{{ route("upload_logo") }}'
                    , type: 'POST'
                    , data: formData
                    , processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    success: function(data) {
                        console.log(data);
                        // alert(data);
                        $('#uploadphoto_path').val(data);
                        $('.nologo').text('');
                        $('.nologo').html('<img id="logim" class="logim h-100 w-100" src="" alt="">')
                        logim.src = URL.createObjectURL(file)
                    }
                });

            }

        }
        //change gradient
        $('.gradient-change').on('click', function() {
            var colorpicker = $('#colorpicker').val();
            var gradient = $('#gradient').val();
            var hexcolor = $('#hexcolor').val();
            var gradient1 = $('#gradient1').val();
            $('#colorpicker').val(gradient);
            $('#hexcolor').val(gradient1);
            $('#gradient').val(colorpicker);
            $('#gradient1').val(hexcolor);
        })
        //eyes
        $('.eye-change').on('click', function() {
            var eyecolor1 = $('#eyecolor1').val();
            var eyecolor2 = $('#eyecolor2').val();
            var eyecolor21 = $('#eyecolor-1').val();
            var eyecolor22 = $('#eyecolor-2').val();
            $('#eyecolor1').val(eyecolor2);
            $('#eyecolor2').val(eyecolor1);
            $('#eyecolor-1').val(eyecolor22);
            $('#eyecolor-2').val(eyecolor21);

        });
        $('#blankCheckbox').on('change', function() {
            if ($(this).is(":checked")) { // check if the radio is checked
                $('.eyes').show();
            } else {
                $('.eyes').hide();
            }

        });


        // qr code generate
        $(".generate").click(function() {
            var hexcolor = $('#hexcolor').val();
            var uploadphoto_path = 'logos/' + $('#uploadphoto_path').val();
            var gradient = $('#gradient1').val();
            var eyecolor1 = $('#eyecolor-1').val();
            var eyecolor2 = $('#eyecolor-2').val();
            var eyecolor3 = $('#eyecolor-3').val();
            var eyeballcolor1 = $('#eyeballcolor-1').val();
            var eyeballcolor2 = $('#eyeballcolor-2').val();
            var eyeballcolor3 = $('#eyeballcolor-3').val();
            var bgcolor1 = $('#bgcolor1').val();
            var bodylogo = $('#bodylogo').val();
            var eyelogo = $('#eyelogo').val();
            var eyeball = $('#eyeball').val();
            var gradientType = $('#gradientType').val();
            var single_color = $('input[name="single_color"]:checked').val();
            $.ajax({
                type: 'post'
                , url: '{{ route("generate_qr_code") }}'
                , data: {
                    hexcolor: hexcolor
                    , gradient: gradient
                    , gradientType: gradientType
                    , bodylogo: bodylogo
                    , eyecolor1: eyecolor1
                    , eyecolor2: eyecolor2
                    , eyecolor3: eyecolor3
                    , eyeballcolor1: eyeballcolor1
                    , eyeballcolor2: eyeballcolor2
                    , eyeballcolor3: eyeballcolor3
                    , bgcolor1: bgcolor1
                    , eyelogo: eyelogo
                    , eyeball: eyeball
                    , uploadphoto_path: uploadphoto_path
                    , single_color: single_color
                    , customer_id: "{!! $qr_details->id !!}"
                    , '_token': "{!! csrf_token() !!}"
                , }
                , success: function(response) {
                    console.log(response);
                    $("#qr_code_display").html('<img width="330px"  src="/' + response + '" />');
                    $('#download_qr').attr('href', '/' + response);
                    $('#download_qr_eps').attr('href', '/' + response.replace("png", 'eps'));
                    $('#download_qr_svg').attr('href', '/' + response.replace("png", 'svg'));
                }
            });
        });
    });

</script>
@endsection