<footer class="site-footer border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-6">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="footer-heading mb-4">Menü</h3>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <ul class="list-unstyled">
                            <li><a href="{{route('home')}}">Ana Sayfa</a></li>
                            <li><a href="{{route('about')}}">Hakkımızda</a></li>
                            <li><a href="{{route('products')}}">Ürünler</a></li>
                            <li><a href="{{route('contact')}}">İletişim</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="block-5 mb-5">
                    <h3 class="footer-heading mb-4">İletişim</h3>
                    <ul class="list-unstyled">
                        <li class="address">{{$settings['adress']}}</li>
                        <li class="phone"><a href="tel://{{str_replace(' ', '',$settings['phone'])}}">{{$settings['phone']}}</a></li>
                        <li class="email">{{$settings['e-mail']}}</li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <p>
                    Copyright &copy; {{date('Y')}} Tüm Hakları Saklıdır.
                </p>
            </div>

        </div>
    </div>
</footer>
