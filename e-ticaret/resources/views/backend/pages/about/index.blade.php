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
                    <h4 class="card-title">Hakkımızda</h4>
                    <div class="col-lg-12">
                        @if(count($errors))
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{$error}}</div>
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

                    <form class="forms-sample" action="{{route('panel.about.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">

                            @if(!empty($about->image))
                            <div>
                                <a href="{{ asset('img/about/' . ($about->image ?? 'resimyok.webp')) }}" target="_blank">
                                    <img src="{{ asset('img/about/' . ($about->image ?? 'resimyok.webp')) }}" alt="" style="max-width: 300px; max-height: 200px;">
                                </a>
                            </div>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="image">Resim</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" value="{{$about->image ?? ''}}" disabled placeholder="Resim Yükle">
                                <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Yükle</button>
                        </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Slider Başlığı</label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{$about->name ?? ''}}" placeholder="Hakkımızda Başlığı">
                        </div>
                        <div class="form-group">
                            <label for="editor">Slider İçeriği</label>
                            <textarea class="form-control" id="editor" name="content" rows="4" placeholder="Hakkımızda İçeriği">{{$about->content ?? ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="text_1_icon">Resim 1</label>
                            <input type="text" class="form-control" id="text_1_icon" name="text_1_icon" value="{{$about->text_icon_1 ?? ''}}" placeholder="Icon 1">
                        </div>

                        <div class="form-group">
                            <label for="text_1">Metin 1</label>
                            <input type="text" class="form-control" id="text_1" name="text_icon_1" value="{{$about->text_1 ?? ''}}" placeholder="Text 1">
                        </div>

                        <div class="form-group">
                            <label for="text_1_content">Metin 1 İçerik</label>
                            <textarea class="form-control" id="text_1_content" name="text_1_content" rows="4" placeholder="Text 1 Content">{{$about->text_1_content ?? ''}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="text_2_icon">Resim 2</label>
                            <input type="text" class="form-control" id="text_2_icon" name="text_2_icon" value="{{$about->text_2_icon ?? ''}}" placeholder="Icon 2">
                        </div>

                        <div class="form-group">
                            <label for="text_2">Metin 2</label>
                            <input type="text" class="form-control" id="text_2" name="text_icon_2" value="{{$about->text_2 ?? ''}}" placeholder="Text 2">
                        </div>

                        <div class="form-group">
                            <label for="text_2_content">Metin 2 İçerik</label>
                            <textarea class="form-control" id="text_2_content" name="text_2_content" rows="4" placeholder="Text 2 Content">{{$about->text_2_content ?? ''}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="text_3_icon">Resim 3</label>
                            <input type="text" class="form-control" id="text_3_icon" name="text_3_icon" value="{{$about->text_3_icon ?? ''}}" placeholder="Icon 3">
                        </div>

                        <div class="form-group">
                            <label for="text_3">Metin 3</label>
                            <input type="text" class="form-control" id="text_3" name="text_3" value="{{$about->text_3 ?? ''}}" placeholder="Text 3">
                        </div>

                        <div class="form-group">
                            <label for="text_3_content">Metin 3 İçerik</label>
                            <textarea class="form-control" id="text_3_content" name="text_3_content" rows="4" placeholder="Text 3 Content">{{$about->text_3_content ?? ''}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="status">Durum</label>
                            @php
                                $status = $about->status ?? '1';
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
