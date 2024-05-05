@extends('backend.layout.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Coupon</h4>
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

                            @if(session()->get('error'))
                                <div class="alert alert-danger">
                                    {{session()->get('error')}}
                                </div>
                            @endif
                    </div>

                    @if(!empty($coupon->id))
                        @php
                            $routeLink = route('panel.coupon.update' , $coupon->id);
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.coupon.store');
                        @endphp
                    @endif
                    <form class="forms-sample" action="{{$routeLink}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($coupon->id))
                            @method('PUT')
                        @endif
                        <div class="form-group">


                            <div>
                                <a href="{{ asset('img/coupon/' . ($coupon->image ?? 'resimyok.webp')) }}" target="_blank">
                                    <img src="{{ asset('img/coupon/' . ($coupon->image ?? 'resimyok.webp')) }}" alt="" style="max-width: 300px; max-height: 200px;">
                                </a>
                            </div>


                        </div>

                        <div class="form-group">
                            <label for="name">Kupon Başlığı</label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{$coupon->name ?? ''}}" placeholder="Kupon Başlığı">
                        </div>
                        <div class="form-group">
                            <label for="price">Kupon Ücreti</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{$coupon->price ?? ''}}" placeholder="Kupon Ücreti">
                        </div>
                        <div class="form-group">
                            <label for="discount_rate">Kupon İndirim Oranı</label>
                            <input type="text" class="form-control" id="discount_rate" name="discount_rate" value="{{$coupon->discount_rate ?? ''}}" placeholder="Kupon İndirim Oranı">
                        </div>
                        <div class="form-group">
                            <label for="status">Durum</label>
                            @php
                            $status = $coupon->status ?? '1';
                            @endphp
                            <select type="text" class="form-control" id="status" name="status">
                                <option value="0" {{$status == '0' ? 'selected' : ''}}>Pasif</option>
                                <option value="1" {{$status == '1' ? 'selected' : ''}}>Aktif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Kaydet</button>
                        <a href="{{route('panel.coupon')}}" class="btn btn-light">Geri Dön</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
