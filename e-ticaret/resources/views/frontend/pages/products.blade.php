@extends('frontend.layout.app')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{route('home')}}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">Ürünler</h2></div>
                            <div class="d-flex">
                                <div class="dropdown mr-1 ml-md-auto">

                                </div>
                                <div class="btn-group">

                                        <select class="form-control" id="orderList">
                                            <option class="dropdown-item" value="" >Sırala</option>
                                            <option class="dropdown-item" value="id-asc" >A dan Z ye Sırala</option>
                                            <option class="dropdown-item"  value="id-desc" >Z den A ya Sırala</option>
                                            <option class="dropdown-item"  value="price-asc" >Düşük Fiyata Göre Sırala</option>
                                            <option class="dropdown-item"  value="price-desc" >Yüksek Fiyata Göre Sırala</option>
                                        </select>
                                    </div>


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @if(session()->get('success'))
                                <div class="alert alert-success">
                                    {{session()->get('success')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-5">


                        @if(!empty($products) && $products->count() > 0 )
                            @foreach($products as $product)
                                <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                    <div class="block-4 text-center border">
                                        <figure class="block-4-image">
                                            <a href="{{route('productDetail', $product->slug)}}"><img src="{{asset($product->image)}}" alt="Image placeholder" class="img-fluid"></a>
                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a href="{{route('productDetail', $product->slug)}}">{{$product->name}}</a></h3>
                                            <p class="mb-0">{{$product->short_text}}</p>
                                            <p class="text-primary font-weight-bold">{{number_format($product->price,2)}}</p>
                                            <form action="{{route('cart_add')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <input type="hidden" name="size" value="{{$product->size}}">
                                                <button type="submit" class="buy-now btn btn-sm btn-primary">Sepete Ekle</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                    </div>
                    <div class="row" data-aos="fade-up">
                        {{$products->withQueryString()->links('vendor.pagination.custom')}}
                      {{--   <div class="col-md-12 text-center">
                            <div class="site-block-27">
                                <ul>
                                    <li><a href="#">&lt;</a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&gt;</a></li>
                                </ul>
                            </div>
                        </div>--}}
                    </div>
                </div>

                <div class="col-md-3 order-1 mb-5 mb-md-0">
                    <div class="border p-4 rounded mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Kategoriler</h3>
                        <ul class="list-unstyled mb-0">
                            @if(!empty($categories) && $categories->count() > 0 )
                                @foreach($categories->where('cat_ust',null) as $category)
                                    <li class="mb-1"><a href="{{route($category->slug.'urunler')}}" class="d-flex"><span>{{$category->name}}</span> <span class="text-black ml-auto">({{$category->getTotalProductCount()}})</span></a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="border p-4 rounded mb-4">
                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Fiyat Filtresi</h3>
                            <div id="slider-range" class="border-primary"></div>
                            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
                            <input type="text" name="priceBetween" id="priceBetween" class="form-control" />
                        </div>

                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Beden</h3>
                            @if(!empty($sizelists))
                                @foreach($sizelists as $key => $size)
                                    <label for="size{{$key}}" class="d-flex">
                                        <input type="checkbox" id="size{{$key}}" value="{{$size}}" {{isset(request()->size) && in_array($size,explode(',',request()->size)) ? 'checked' : ''}} class="mr-2 mt-1 sizeList"> <span class="text-black">{{$size}}</span>
                                    </label>
                                @endforeach
                            @endif
                        </div>

                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Renk</h3>
                            @if(!empty($colors))
                                @foreach($colors as $key => $color)
                                    <label for="color{{$key}}" class="d-flex">
                                        <input type="checkbox" id="color{{$key}}"  value="{{$color}}" {{isset(request()->color) && in_array($color,explode(',',request()->color)) ? 'checked' : ''}} class="mr-2 mt-1 colorList"> <span class="text-black">{{$color}}</span>
                                    </label>
                                @endforeach
                            @endif
                        </div>

                        <div class="mb-4">
                            <button class="btn btn-block btn-primary filterBtn">Filtrele</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="site-section site-blocks-2">
                        <div class="row justify-content-center text-center mb-5">
                            <div class="col-md-7 site-section-heading pt-4">
                                <h2>Kategoriler</h2>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($categories) && $categories->count() > 0 )
                                @foreach($categories->where('cat_ust',null) as $category)
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                                        <a class="block-2-item" href="{{route($category->slug.'urunler')}}">
                                            <figure class="image">
                                                <img src="{{$category->image}}" alt="" class="img-fluid">
                                            </figure>
                                            <div class="text">
                                                <span class="text-uppercase">Collections</span>
                                                <h3>{{$category->name}}</h3>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('customjs')
    <script>

        var maxprice = "{{$maxprice}}";
        var defaultminprice = "{{request()->min ?? 0}}";
        var defaultmaxprice = "{{request()->max ?? $maxprice}}";

        var url = new URL(window.location.href);

        $(document).on('click' ,'.filterBtn', function (e){
           filtrele();
        });
        function filtrele() {
            let colorList = $(".colorList:checked").map((_,chk) => chk.value).get();
            let sizeList = $(".sizeList:checked").map((_,chk) => chk.value).get();
            if(colorList.length >0){
                url.searchParams.set("color" , colorList.join(","))
            }else{
                url.searchParams.delete('color');
            }
            if(sizeList.length >0){
                url.searchParams.set("size" , sizeList.join(","))
            }else{
                url.searchParams.delete('size');
            }

            var price = $('#priceBetween').val().split('-');
            url.searchParams.set("min" , price[0])
            url.searchParams.set("max" , price[1])

            newUrl = url.href;
            window.history.pushState({} , '' , newUrl);
            location.reload();
        }

        $(document).on('change' ,'#orderList', function (e) {

            var order = $(this).val();

            if(order != ''){
                orderby = order.split('-');

                url.searchParams.set("order" , orderby[0])
                url.searchParams.set("sort" , orderby[1])
            }else{
                url.searchParams.delete('order');
                url.searchParams.delete('sort');
            }
            filtrele();
        });
    </script>

@endsection
