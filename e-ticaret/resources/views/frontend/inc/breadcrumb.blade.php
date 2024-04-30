<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0">
                <a href="{{route('home')}}">Ana Sayfa</a>
                @if(!empty($breadcrumb['sayfalar'] ))
                    @foreach($breadcrumb['sayfalar'] as $item)
                        <span class="mx-2 mb-0">/</span>
                        <a href="{{$item['link']}}">{{$item['name']}}</a>
                    @endforeach
                @endif

                <span class="mx-2 mb-0">/</span>
                <strong class="text-black">{{$breadcrumb['active']}}</strong>
            </div>
        </div>
    </div>
</div>
