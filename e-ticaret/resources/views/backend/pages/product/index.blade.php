@extends('backend.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ürünler</h4>
                    <p class="card-description">
                        <a href="{{route('panel.product.create')}}" class="btn btn-primary">Yeni</a>
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
                                <th>Kategori</th>
                                <th>İçerik</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($products) && $products->count() > 0)
                                @foreach($products as $item)
                                    <tr class="item" item-id="{{$item->id}}">
                                        <td class="py-1">
                                            <img src="{{asset('img/product/'.$item->image)}}" alt="image"/>
                                        </td>
                                        <td>{{$item->category->name ?? ''}}</td>
                                        <td>{{$item->name}}</td>

                                        <td>
                                            <div class="checkbox" >
                                                <label>
                                                    <input type="checkbox"  class="status" data-on="Aktif" data-off="Pasif" data-onstyle="success"  data-offstyle="danger" {{$item->status == '1' ? 'checked' : '' }} data-toggle="toggle">
                                                </label>
                                            </div>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{route('panel.product.edit' , $item->id)}}" class="btn btn-primary mr-2">Düzenle</a>
                                            <button type="button" class="deleteBtn btn btn-danger">Sil</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    {{$products->links('pagination::custom')}}
                </div>
            </div>
        </div>


    </div>
@endsection
@section('customjs')
    <script>
       $(document).on('change','.status',function (e){
        id = $(this).closest('.item').attr('item-id');
        status =  $(this).prop('checked');

        $.ajax({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url:'{{route('panel.product.status')}}',
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
                       url:'{{route('panel.product.destroy')}}',
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
