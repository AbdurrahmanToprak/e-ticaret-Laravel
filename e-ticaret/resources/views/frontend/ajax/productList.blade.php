@if(!empty($products) && $products->count() > 0 )
    @foreach($products as $product)
        <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
            <div class="block-4 text-center border">
                <figure class="block-4-image">
                    <a href="{{route('productDetail', $product->slug)}}"><img src="{{asset('img/product/' .$product->image)}}" alt="Image placeholder" class="img-fluid"></a>
                </figure>
                <div class="block-4-text p-4">
                    <h3><a href="{{route('productDetail', $product->slug)}}">{{$product->name}}</a></h3>
                    <p class="mb-0">{{$product->short_text}}</p>
                    <p class="text-primary font-weight-bold">{{number_format($product->price,2)}} TL</p>
                    @php
                    $sifrele = sifrele($product->id);
                    @endphp
                    <form  method="POST" id="addForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$sifrele}}">
                        <input type="hidden" name="size" value="{{$product->size}}">
                        <input type="hidden" name="coupon_code" value="{{request()->segment(1) == 'tumurunler-indirim' ? 'tumurun' : ''}}">

                        <button type="submit" class="buy-now btn btn-sm btn-primary">Sepete Ekle</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif
