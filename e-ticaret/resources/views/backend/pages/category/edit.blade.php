@extends('backend.layout.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kategori</h4>
                    <div class="col-lg-12">
                        @if(count($errors))
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{$error}}</div>
                            @endforeach
                        @endif
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{session()->get('success')}}
                            </div>
                        @endif
                    </div>

                    @if(!empty($category->id))
                        @php
                            $routeLink = route('panel.category.update' , $category->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.category.store');
                        @endphp
                    @endif
                    <form class="forms-sample" action="{{$routeLink}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($category->id))
                            @method('PUT')
                        @endif
                        <div class="form-group">


                            <div>
                                <a href="{{ asset('img/category/' . ($category->image ?? 'resimyok.webp')) }}" target="_blank">
                                    <img src="{{ asset('img/category/' . ($category->image ?? 'resimyok.webp')) }}" alt="" style="max-width: 300px; max-height: 200px;">
                                </a>
                            </div>


                        </div>
                        <div class="form-group">
                            <label for="image">Resim</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" value="{{$category->image ?? ''}}" disabled placeholder="Resim Yükle">
                                <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Yükle</button>
                        </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Kategori Başlığı</label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{$category->name ?? ''}}" placeholder="Kategori Başlığı">
                        </div>
                        <div class="form-group">
                            <label for="content">Kategori İçerik</label>
                            <textarea class="form-control" id="content" name="content" placeholder="Kategori İçeriği" rows="3">{{$category->content ?? ''}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="cat_ust">Kategoriler</label>
                           <select name="cat_ust" id="" class="form-control">
                               <option value="">Kategori Seç</option>
                                @if($categories)
                                    @foreach($categories as $alt)
                                        <option value="{{$alt->id}}" {{isset($category) && $category->cat_ust == $alt->id ? 'selected' : ''}}>
                                            {{$alt->name}}
                                        </option>
                                    @endforeach
                                @endif
                           </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Durum</label>
                            @php
                            $status = $category->status ?? '1';
                            @endphp
                            <select type="text" class="form-control" id="status" name="status">
                                <option value="0" {{$status == '0' ? 'selected' : ''}}>Pasif</option>
                                <option value="1" {{$status == '1' ? 'selected' : ''}}>Aktif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Kaydet</button>
                        <a href="{{route('panel.category.index')}}" class="btn btn-light">Geri Dön</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
