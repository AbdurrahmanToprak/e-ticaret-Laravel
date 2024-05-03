@extends('backend.layout.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">pageseo</h4>
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

                    @if(!empty($pageseo->id))
                        @php
                            $routeLink = route('panel.pageseo.update' , $pageseo->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.pageseo.store');
                        @endphp
                    @endif
                    <form class="forms-sample" action="{{$routeLink}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($pageseo->id))
                            @method('PUT')
                        @endif
                        <div class="form-group">


                            <div>
                                <a href="{{ asset('img/pageseo/' . ($pageseo->image ?? 'resimyok.webp')) }}" target="_blank">
                                    <img src="{{ asset('img/pageseo/' . ($pageseo->image ?? 'resimyok.webp')) }}" alt="" style="max-width: 300px; max-height: 200px;">
                                </a>
                            </div>


                        </div>

                        <div class="form-group">
                            <label for="dil">Dil</label>
                            <input type="text" class="form-control" id="dil" name="dil"  value="{{$pageseo->dil ?? ''}}" placeholder="pageseo dil">
                        </div>
                        <div class="form-group">
                            <label for="page">Sayfa</label>
                            <input class="form-control" id="page" name="page" placeholder="Sayfa" value= "{{$pageseo->page ?? ''}}">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input class="form-control" id="title" name="title" placeholder="title" value="{{$pageseo->title ?? ''}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input class="form-control" id="description" name="description" placeholder="description" value="{{$pageseo->description ?? ''}}">
                        </div>
                        <div class="form-group">
                            <label for="keywords">Keywords</label>
                            <input type="text" class="form-control" id="keywords" name="keywords" value="{{$pageseo->keywords ?? ''}}" placeholder="keywords">
                        </div>
                        <div class="form-group">
                            <label for="contents">İçerik</label>
                            <textarea class="form-control" id="contents" name="contents" rows="4" placeholder="İçerik">{{$pageseo->content ?? ''}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Kaydet</button>
                        <a href="{{route('panel.pageseo')}}" class="btn btn-light">Geri Dön</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
