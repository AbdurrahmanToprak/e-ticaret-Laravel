@extends('backend.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">pageseos</h4>
                    <p class="card-description">
                        <a href="{{route('panel.pageseo.create')}}" class="btn btn-primary">Yeni</a>
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
                                <th>Dil</th>
                                <th>Page</th>
                                <th>Page_ust</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Keywords</th>
                                <th>Contents</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($pageseos) && $pageseos->count() > 0)
                                @foreach($pageseos as $pageseo)
                                    <tr class="item" item-id="{{$pageseo->id}}">

                                        <td>{{$pageseo->dil}}</td>
                                        <td>{{$pageseo->page ?? ''}}</td>
                                        <td>{{$pageseo->pageinfo->page ?? ''}}</td>
                                        <td>{{$pageseo->title}}</td>
                                        <td>{{$pageseo->description}}</td>
                                        <td>{{$pageseo->keywords}}</td>
                                        <td>{{$pageseo->contents}}</td>
                                        <td class="d-flex">
                                            <a href="{{route('panel.pageseo.edit' , $pageseo->id)}}" class="btn btn-primary mr-2">Düzenle</a>
                                            {{--  <form action="{{route('panel.pageseo.destroy' , $pageseo->id)}}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                              </form>--}}

                                            <button type="button" class="deleteBtn btn btn-danger">Sil</button>
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
       $(document).on('click','.deleteBtn',function (e){
            e.preventDefault();

           var item = $(this).closest('.item');
           id = item.attr('item-id');


           alertify.confirm("Uyarı","Silmek istediğinize emin misiniz?." ,
               function(){
                   $.ajax({
                       headers:{
                           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                       },
                       type: 'DELETE',
                       url:'{{route('panel.pageseo.destroy')}}',
                       data:{
                           id:id,
                       },
                       success: function (response){
                           if(response.error == false){
                               item.remove();
                               alertify.success(response.message);
                           }else{
                               alertify.error("Bir hata oluştu.");
                           }
                       }
                   });
               },
               function(){
                   alertify.error('Silme işlemi iptal edildi');
               });

       });
    </script>
@endsection
