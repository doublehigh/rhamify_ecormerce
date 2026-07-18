<section id="wsus__large_banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                @if ($homepage_secion_banner_four->banner_one->status == 1)
                <div class="wsus__large_banner_content">
                    <a href="{{advertisementLink($homepage_secion_banner_four->banner_one->banner_url, route('products.index'))}}">
                        <img class="img-fluid" src="{{asset($homepage_secion_banner_four->banner_one->banner_image)}}" alt="">
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
