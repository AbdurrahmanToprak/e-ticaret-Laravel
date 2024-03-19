@extends('backend.layout.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Slider</h4>
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

                    @if(!empty($slider->id))
                        @php
                            $routeLink = route('panel.slider.update' , $slider->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.slider.store');
                        @endphp
                    @endif
                    <form class="forms-sample" action="{{$routeLink}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($slider->id))
                            @method('PUT')
                        @endif
                        <div class="form-group">


                            <div>
                                <a href="{{ asset('img/slider/' . ($slider->image ?? 'resimyok.webp')) }}" target="_blank">
                                    <img src="{{ asset('img/slider/' . ($slider->image ?? 'resimyok.webp')) }}" alt="" style="max-width: 300px; max-height: 200px;">
                                </a>
                            </div>


                        </div>
                        <div class="form-group">
                            <label for="image">Resim</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" value="{{$slider->image ?? ''}}" disabled placeholder="Resim Yükle">
                                <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Yükle</button>
                        </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Slider Başlığı</label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{$slider->name ?? ''}}" placeholder="Slider Başlığı">
                        </div>
                        <div class="form-group">
                            <label for="content">Slider İçeriği</label>
                            <textarea class="form-control" id="content" name="content" rows="4" placeholder="Slider İçeriği">{{$slider->content ?? ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link" value="{{$slider->link ?? ''}}" placeholder="Slider Link">
                        </div>
                        <div class="form-group">
                            <label for="status">Durum</label>
                            @php
                            $status = $slider->status ?? '1';
                            @endphp
                            <select type="text" class="form-control" id="status" name="status">
                                <option value="0" {{$status == '0' ? 'selected' : ''}}>Pasif</option>
                                <option value="1" {{$status == '1' ? 'selected' : ''}}>Aktif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Kaydet</button>
                        <a href="{{route('panel.slider')}}" class="btn btn-light">Geri Dön</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
