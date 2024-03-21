@extends('frontend.layout.app')
@section('content')
    @if($slider)
    <div class="site-blocks-cover" style="background-image: url({{asset('img/slider/'.$slider->image ?? '')}});" data-aos="fade">
        <div class="container">
            <div class="row align-items-start align-items-md-center justify-content-end">
                <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                    <h1 class="mb-2">{{$slider->name ?? __('Merhaba')}}</h1>
                    <div class="intro-text text-center text-md-left">
                        <p class="mb-4">{{$slider->content}}</p>
                        <p>
                            <a href="{{$slider->link ?? ''}}" class="btn btn-sm btn-primary">Ürünlerimiz</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="site-section site-section-sm site-blocks-1 border-0" data-aos="fade">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                    <div class="icon mr-4 align-self-start">
                        <span class="{{$about->text_1_icon}}"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">{{$about->text_1}}</h2>
                        <p>{!! $about->text_1_content !!}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon mr-4 align-self-start">
                        <span class="{{$about->text_2_icon}}"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">{{$about->text_2}}</h2>
                        <p>{!! $about->text_2_content !!}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon mr-4 align-self-start">
                        <span class="{{$about->text_3_icon}}"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">{{$about->text_3}}</h2>
                        <p>{!! $about->text_3_content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section site-blocks-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                    <a class="block-2-item" href="{{route('kadinurunler')}}">
                        <figure class="image">
                            <img src="images/women.jpg" alt="" class="img-fluid">
                        </figure>
                        <div class="text">
                            <span class="text-uppercase">Giyim</span>
                            <h3>Kadın</h3>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
                    <a class="block-2-item" href="{{route('cocukurunler')}}">
                        <figure class="image">
                            <img src="images/children.jpg" alt="" class="img-fluid">
                        </figure>
                        <div class="text">
                            <span class="text-uppercase">Giyim</span>
                            <h3>Çocuk</h3>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                    <a class="block-2-item" href="{{route('erkekurunler')}}">
                        <figure class="image">
                            <img src="images/men.jpg" alt="" class="img-fluid">
                        </figure>
                        <div class="text">
                            <span class="text-uppercase">Giyim</span>
                            <h3>Erkek</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Yeni Ürünlerimiz</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Tank Top</a></h3>
                                    <p class="mb-0">Finding perfect t-shirt</p>
                                    <p class="text-primary font-weight-bold">350 TL</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Corater</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">350 TL</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="images/cloth_2.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Polo Shirt</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">350 TL</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="images/cloth_3.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">T-Shirt Mockup</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Corater</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section block-8">
        <div class="container">
            <div class="row justify-content-center  mb-5">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Kampanya!</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-7 mb-5">
                    <a href="#"><img src="images/blog_1.jpg" alt="Image placeholder" class="img-fluid rounded"></a>
                </div>
                <div class="col-md-12 col-lg-5 text-center pl-md-5">
                    <h2>Ürünlerimizde %50 İndirim Fırsatı</h2>
                    <p>Seçili ürünlerde indirim fırsatını kaçırmayın.</p>
                    <p><a href="{{route('productsOnSale')}}" class="btn btn-primary btn-sm">İndirimdeki Ürünler</a></p>
                </div>
            </div>
        </div>
    </div>
    @endsection
