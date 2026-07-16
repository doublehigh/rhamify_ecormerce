@extends('frontend.layouts.master')
@section('title')
{{$settings->site_name}} || e-Commerce HTML Template
@endsection

@section('content')

    <!--============================
        BANNER PART 2 START
    ==============================-->
    @include('frontend.home.sections.banner-slider')
    <!--============================
        BANNER PART 2 END
    ==============================-->


    <!--============================
        FLASH SELL START
    ==============================-->
    @if ($flashSaleDate)
        @include('frontend.home.sections.flash-sale')
    @endif
    <!--============================
        FLASH SELL END
    ==============================-->


    <!--============================
       MONTHLY TOP PRODUCT START
    ==============================-->
    @if ($popularCategory && $homepage_secion_banner_one)
        @include('frontend.home.sections.top-category-product')
    @endif
    <!--============================
       MONTHLY TOP PRODUCT END
    ==============================-->


    <!--============================
        BRAND SLIDER START
    ==============================-->
    @include('frontend.home.sections.brand-slider')
    <!--============================
        BRAND SLIDER END
    ==============================-->


    <!--============================
        SINGLE BANNER START
    ==============================-->
    @if ($homepage_secion_banner_two)
        @include('frontend.home.sections.single-banner')
    @endif
    <!--============================
        SINGLE BANNER END
    ==============================-->


    <!--============================
        HOT DEALS START
    ==============================-->
    @if ($homepage_secion_banner_three)
        @include('frontend.home.sections.hot-deals')
    @endif
    <!--============================
        HOT DEALS END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    @if ($categoryProductSliderSectionOne)
        @include('frontend.home.sections.category-product-slider-one')
    @endif
    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    @if ($categoryProductSliderSectionTwo)
        @include('frontend.home.sections.category-product-slider-two')
    @endif

    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        LARGE BANNER  START
    ==============================-->
    @if ($homepage_secion_banner_four)
        @include('frontend.home.sections.large-banner')
    @endif

    <!--============================
        LARGE BANNER  END
    ==============================-->


    <!--============================
        WEEKLY BEST ITEM START
    ==============================-->
    @if ($categoryProductSliderSectionThree)
        @include('frontend.home.sections.weekly-best-item')
    @endif
    <!--============================
        WEEKLY BEST ITEM END
    ==============================-->


    <!--============================
      HOME SERVICES START
    ==============================-->
    @include('frontend.home.sections.services')
    <!--============================
        HOME SERVICES END
    ==============================-->


    <!--============================
        HOME BLOGS START
    ==============================-->
    @include('frontend.home.sections.blog')
    <!--============================
        HOME BLOGS END
    ==============================-->

@endsection
