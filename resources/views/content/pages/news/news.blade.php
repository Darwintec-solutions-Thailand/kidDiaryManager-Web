@php
    $configData = Helper::appClasses();
    $isMenu = false;
    $navbarHideToggle = false;
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Without menu - Layouts')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/ui-carousel.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/ui-carousel.js') }}"></script>
@endsection

@section('content')
    <div class="d-flex">
        <div class="col-md-6">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('assets/img/elements/10.jpg') }}" alt="First slide"
                            style="max-height: 300px;" />
                        <div class="carousel-caption d-none d-md-block">
                            <h4>First slide</h4>
                            <p>Eos mutat malis maluisset et, agam ancillae quo te, in vim congue pertinacia.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('assets/img/elements/2.jpg') }}" alt="Second slide"
                            style="max-height: 300px;" />
                        <div class="carousel-caption d-none d-md-block">
                            <h4>Second slide</h4>
                            <p>In numquam omittam sea.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('assets/img/elements/13.jpg') }}" alt="Third slide"
                            style="max-height: 300px;" />
                        <div class="carousel-caption d-none d-md-block">
                            <h4>Third slide</h4>
                            <p>Lorem ipsum dolor sit amet, virtute consequat ea qui, minim graeco mel no.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card ml-1" style="min-height: 300px; margin-left:10px;">
                
                sss
            </div>
        </div>
    </div>

@endsection
