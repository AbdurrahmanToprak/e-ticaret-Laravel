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
                    <h4 class="card-title">Site Ayarı</h4>
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

                    @if(!empty($setting->id))
                        @php
                            $routeLink = route('panel.setting.update' , $setting->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.setting.store');
                        @endphp
                    @endif
                    <form class="forms-sample" action="{{$routeLink}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($setting->id))
                            @method('PUT')
                        @endif
                        <div class="form-group">


                            <div>


                                @if(isset($setting->set_type) && $setting->set_type == 'image')
                                    <a href="{{ asset('img/setting/' . ($setting->data ?? 'resimyok.webp')) }}" target="_blank">
                                        <img src="{{ asset('img/setting/' . ($setting->data ?? 'resimyok.webp')) }}" alt="" style="max-width: 300px; max-height: 200px;">
                                    </a>
                                @endif
                            </div>


                        </div>
                        <div class="form-group">

                            <select class="form-control " id="setTypeSelect" name="set_type">
                                <option value="">Tür Seçiniz </option>
                                <option value="ckeditor" {{isset($setting->set_type) && $setting->set_type == 'ckeditor' ? 'selected' : ''}}>Ckeditor</option>
                                <option value="textarea" {{isset($setting->set_type) && $setting->set_type == 'textarea' ? 'selected' : ''}}>Textarea</option>
                                <option value="file" {{isset($setting->set_type) && $setting->set_type == 'file' ? 'selected' : ''}}>Dosya</option>
                                <option value="image" {{isset($setting->set_type) && $setting->set_type == 'image' ? 'selected' : ''}}>Resim</option>
                                <option value="text" {{isset($setting->set_type) && $setting->set_type == 'text' ? 'selected' : ''}}>Text</option>
                                <option value="email" {{isset($setting->set_type) && $setting->set_type == 'email' ? 'selected' : ''}}>Email</option>

                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="image">Resim</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" value="{{$setting->image ?? ''}}" disabled placeholder="Resim Yükle">
                                <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Yükle</button>
                        </span>
                            </div>
                        </div>
                        --}}
                        <div class="form-group">
                            <label for="name">Key</label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{$setting->name ?? ''}}" placeholder="Key">
                        </div>
                        <div class="form-group">
                            <label for="data">Value</label>

                            <div class="inputContent">
                                @if(isset($setting->set_type) && $setting->set_type == 'ckeditor')
                                    <textarea class="form-control" id="editor" name="data" rows="4" placeholder="Data">{{$setting->data ?? ''}}</textarea>

                                @elseif(isset($setting->set_type) && $setting->set_type == 'textarea')
                                        <textarea class="form-control" name="data" rows="4" placeholder="Data">{{$setting->data ?? ''}}</textarea>

                                @elseif(isset($setting->set_type) && $setting->set_type == 'image' || isset($setting->set_type) && $setting->set_type == 'file')
                                    <input class="form-control" type="file" name="data" value="{{$setting->data ?? ''}}">

                                @elseif(isset($setting->set_type) && $setting->set_type == 'text')
                                    <input class="form-control" type="text" name="data" value="{{$setting->data ?? ''}}" placeholder="Yazınız" >

                                @elseif(isset($setting->set_type) && $setting->set_type == 'email')
                                    <input class="form-control" type="email" name="data" value="{{$setting->data ?? ''}}">
                                    @else

                                    @endif
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Kaydet</button>
                            <a href="{{route('panel.setting')}}" class="btn btn-light">Geri Dön</a>
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
        const option = {
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
            };

            function ckeditor(){
                ClassicEditor
                    .create( document.querySelector( '#editor' ) , option)
                    .then(editor => {
                        window.editor = editor;
                    })
                    .catch( error => {
                        console.error( error );
                    } );
            }


        $(document).on('change','#setTypeSelect',function (e){
                selectType = $(this).val();
                 createInput(selectType);
        });
            @if(isset($setting->data) && $setting->set_type == 'ckeditor')
                ckeditor();
            @endif
        function createInput(type){
            defaultText = "{!! isset($setting->data) ? $setting->data : ' ' !!}";

            if(type == 'text'){
                newInput = $('<input>').attr({
                    type:'text',
                    name:'data',
                    value : defaultText,
                    class:'form-control',
                    placeHolder: "Value Giriniz"
                });
            }else if(type == 'email') {
                newInput = $('<input>').attr({
                    type: 'email',
                    name: 'data',
                    value : defaultText,
                    class: 'form-control',
                    placeHolder: "e-posta Giriniz"
                });
            }else if(type == 'file' || type == 'image') {
                newInput = $('<input>').attr({
                    type: 'file',
                    name: 'data',
                });
            }else if(type == 'ckeditor') {
                newInput = $('<textarea>').attr({
                    name: 'data',
                    class: 'editor',
                    id:'editor',
                    placeHolder: "CKeditor"
                });newInput.val(defaultText);
            }else if(type == 'textarea') {
                newInput = $('<textarea>').attr({
                    name: 'data',
                    class: 'form-control',
                    placeHolder: "Textarea"
                });newInput.val(defaultText);
            }
            $('.inputContent').empty().append(newInput);
            if(type == 'ckeditor') {
                ckeditor();
            }
        }
    </script>
@endsection

