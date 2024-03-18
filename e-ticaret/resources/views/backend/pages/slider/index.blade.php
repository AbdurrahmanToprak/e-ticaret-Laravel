@extends('backend.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Table</h4>
                    <p class="card-description">
                        <a href="{{route('panel.slider.create')}}" class="btn btn-primary">Yeni</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Resim</th>
                                <th>Başlık</th>
                                <th>İçerik</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($sliders) && $sliders->count() > 0)
                                @foreach($sliders as $slider)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{asset($slider->image)}}" alt="image"/>
                                        </td>
                                        <td>{{$slider->name}}</td>
                                        <td>{{$slider->content}}</td>
                                        <td>{{$slider->link}}</td>
                                        <td><label class="badge badge-{{$slider->name == '1' ? 'success' : 'danger' }}">{{$slider->name == '1' ? 'Aktif' : 'Pasif' }}</label></td>
                                        <td class="d-flex">
                                            <a href="{{route('panel.slider.edit' , $slider->id)}}" class="btn btn-primary mr-2">Düzenle</a>
                                            <form action="{{route('panel.slider.destroy' , $slider->id)}}" method="POST">
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
