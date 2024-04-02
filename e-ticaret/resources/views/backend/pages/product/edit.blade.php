@extends('backend.layout.app')
@section('customcss')
    <style>
        .ck-content {
            height:300px !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                        <h4 class="card-title">ürün Ekle</h4>
                    <div class="col-lg-12">
                        @if(count($errors))
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{$error}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        @if(session()->get('success'))
                                <div class="alert alert-success">
                                    {{session()->get('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        @endif
                    </div>

                    @if(!empty($product->id))
                        @php
                            $routeLink = route('panel.product.update' , $product->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.product.store');
                        @endphp
                    @endif
                    <form class="forms-sample" action="{{$routeLink}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($product->id))
                            @method('PUT')
                        @endif
                        <div class="form-group">


                            <div>
                                <a href="{{ asset('img/product/' . ($product->image ?? 'resimyok.webp')) }}" target="_blank">
                                    <img src="{{ asset('img/product/' . ($product->image ?? 'resimyok.webp')) }}" alt="" style="max-width: 300px; max-height: 200px;">
                                </a>
                            </div>


                        </div>
                        <div class="form-group">
                            <label for="image">Resim</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" value="{{$product->image ?? ''}}" disabled placeholder="Resim Yükle">
                                <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Yükle</button>
                        </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Ürün Başlığı</label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{$product->name ?? ''}}" placeholder="Ürün Başlığı">
                        </div>
                        <div class="form-group">
                            <label for="content">Ürün İçerik</label>
                            <textarea class="form-control" id="editor" name="content" placeholder="Ürün İçeriği" rows="3">{{$product->content ?? ''}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Kategoriler</label>
                           <select name="category_id" id="category_id" class="form-control">
                               <option value="">Kategori Seç</option>
                                @if($categories)
                                    @foreach($categories as $alt)
                                        <option value="{{$alt->id}}" {{isset($product) && $product->category_id == $alt->id ? 'selected' : ''}}>
                                            {{$alt->name}}
                                        </option>
                                    @endforeach
                                @endif
                           </select>
                        </div>

                        <div class="form-group">
                            <label for="size">Beden</label>
                            <select name="size" class="form-control">
                                <option value="">Beden Seçiniz</option>
                                <option value="XS" {{isset($product->size) && $product->size=='XS' ? 'selected' : '' }}>XS</option>
                                <option value="S" {{isset($product->size) && $product->size=='S' ? 'selected' : '' }}>S</option>
                                <option value="M" {{isset($product->size) && $product->size=='M' ? 'selected' : '' }}>M</option>
                                <option value="L" {{isset($product->size) && $product->size=='L' ? 'selected' : '' }}>L</option>
                                <option value="XL" {{isset($product->size) && $product->size=='XL' ? 'selected' : '' }}>XL</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="color">Renk</label>
                            <input type="text" class="form-control" id="color" name="color"  value="{{$product->color ?? ''}}" placeholder="Renk">
                        </div>

                        <div class="form-group">
                            <label for="price">Fiyat</label>
                            <input type="text" class="form-control" id="price" name="price"  value="{{$product->price ?? ''}}" placeholder="Fiyat">
                        </div>

                        <div class="form-group">
                            <label for="short_text">Kısa Bilgi</label>
                            <input type="text" class="form-control" id="short_text" name="short_text"  value="{{$product->short_text ?? ''}}" placeholder="Kısa Bilgi">
                        </div>
                        <div class="form-group">
                            <label for="status">Durum</label>
                            @php
                            $status = $product->status ?? '1';
                            @endphp
                            <select type="text" class="form-control" id="status" name="status">
                                <option value="0" {{$status == '0' ? 'selected' : ''}}>Pasif</option>
                                <option value="1" {{$status == '1' ? 'selected' : ''}}>Aktif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Kaydet</button>
                        <a href="{{route('panel.product.index')}}" class="btn btn-light">Geri Dön</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('customjs')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/translations/tr.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) ,{
                language:'tr',
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
