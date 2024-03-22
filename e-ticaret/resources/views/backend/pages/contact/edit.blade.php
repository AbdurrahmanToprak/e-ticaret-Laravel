@extends('backend.layout.app')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">İletişim</h4>
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

                    <form class="forms-sample" action="{{route('panel.contact.update' , $contact->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf

                            @method('PUT')

                        <div class="form-group">


                        </div>

                        <div class="form-group">
                            <label for="name">Ad Soyad</label>
                            <input type="text" class="form-control" id="name"  readonly value="{{$contact->name ?? ''}}" placeholder="Ad Soyad">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" id="email"  readonly value="{{$contact->email ?? ''}}" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <label for="subject">Konu</label>
                            <input type="text" class="form-control" id="subject" readonly value="{{$contact->subject ?? ''}}" placeholder="Konu">
                        </div>
                        <div class="form-group">
                            <label for="message">Mesaj</label>
                            <textarea class="form-control" id="message"  rows="4" readonly placeholder="Mesaj">{{$contact->message ?? ''}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="status">Durum</label>
                            @php
                            $status = $contact->status ?? '1';
                            @endphp
                            <select type="text" class="form-control" id="status" name="status">
                                <option value="0" {{$status == '0' ? 'selected' : ''}}>Pasif</option>
                                <option value="1" {{$status == '1' ? 'selected' : ''}}>Aktif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Kaydet</button>
                        <a href="{{route('panel.contact')}}" class="btn btn-light">Geri Dön</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
