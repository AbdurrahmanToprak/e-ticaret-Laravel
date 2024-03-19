@extends('backend.layout.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic form elements</h4>
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
                    <form class="forms-sample" action="{{route('panel.slider.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="image">Resim</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Resim Yükle">
                                <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Yükle</button>
                        </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Slider Başlığı</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Slider Başlığı">
                        </div>
                        <div class="form-group">
                            <label for="content">Slider İçeriği</label>
                            <textarea class="form-control" id="content" name="content" rows="4" placeholder="Slider İçeriği"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link" placeholder="Slider Link">
                        </div>
                        <div class="form-group">
                            <label for="status">Durum</label>
                            <select type="text" class="form-control" id="status" name="status">
                                <option value="0">Pasif</option>
                                <option value="1" selected>Aktif</option>
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
