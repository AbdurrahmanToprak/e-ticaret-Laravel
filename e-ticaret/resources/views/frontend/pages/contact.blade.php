@extends('frontend.layout.app')
@section('content')
    @include('frontend.inc.breadcrumb')

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">İletişim</h2>
            </div>
            <div class="col-md-7">
                @if(session()->get('message'))
                    <div class="alert alert-success">
                        {{session()->get('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    @if(count($errors))
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                    @endif

                    <ul id="errors">

                    </ul>

                <form id="createForm" method="post">
                    @csrf
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="text-black">Ad Soyad<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="text-black">E-posta <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="subject" class="text-black">Konu </label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="message" class="text-black">Mesaj </label>
                                <textarea name="message" id="c_message" cols="30" rows="7" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Mesaj Gönder</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5 ml-auto">
                <div class="p-4 border mb-3">
                    <span class="d-block text-primary h6 text-uppercase">Adres</span>
                    <p class="mb-0">{{$settings['adress']}}</p>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('submit', '#createForm', function (e) {
            e.preventDefault();
            const formData = $(this).serialize();
            var item = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('contactStore') }}",
                data: formData,
                success: function (response) {

                    if(response.error == false){
                        Swal.fire({
                            title: "Başarılı!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: 'Tamam'
                        });
                    }else{
                        Swal.fire({
                            title: 'Hatalı!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'Tamam'
                        })
                    }


                    item.trigger('reset');
                    // Hataları temizleme
                    $('#errors').empty();
                },
                error: function (xhr, status, error) {
                    $('#errors').empty();
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        $("#errors").append("<li class='alert alert-danger'>" + item + "</li>");
                    });

                }
            });
        });
    </script>

@endsection
