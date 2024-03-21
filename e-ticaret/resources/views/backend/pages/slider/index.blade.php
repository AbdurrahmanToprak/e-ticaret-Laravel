@extends('backend.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sliders</h4>
                    <p class="card-description">
                        <a href="{{route('panel.slider.create')}}" class="btn btn-primary">Yeni</a>
                    </p>
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
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
                                            <img src="{{asset('img/slider/'.$slider->image)}}" alt="image"/>
                                        </td>
                                        <td>{{$slider->name}}</td>
                                        <td>{{$slider->content}}</td>
                                        <td>{{$slider->link}}</td>
                                        <td>
                                            <div class="checkbox" item-id="{{$slider->id}}">
                                                <label>
                                                    <input type="checkbox"  class="status" data-on="Aktif" data-off="Pasif" data-onstyle="success"  data-offstyle="danger" {{$slider->status == '1' ? 'checked' : '' }} data-toggle="toggle">
                                                </label>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{route('panel.slider.edit' , $slider->id)}}" class="btn btn-primary mr-2">Düzenle</a>
                                            <form action="{{route('panel.slider.destroy' , $slider->id)}}" method="POST">
                                                @csrf
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
@section('customjs')
    <script>
       $(document).on('change','.status',function (e){
        id = $(this).closest('.checkbox').attr('item-id');
        status =  $(this).prop('checked');

        $.ajax({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url:'{{route('panel.slider.status')}}',
            data:{
                id:id,
                status:status
            },
            success: function (response){
                if(response.status == "true"){
                    alertify.success("Durum aktif edildi.");
                }
                else{
                    alertify.error("Durum pasif edildi.");
                }
            }
        });
       })
    </script>
@endsection
