<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('panel.index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Slider</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.slider')}}">Slider</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.slider.create')}}">Slider Ekle</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Kategoriler</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.category.index')}}">Kategori</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('panel.category.create')}}">Kategori Ekle</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('panel.about')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Hakkımızda</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('panel.contact')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Gelen Kutusu</span>
            </a>
        </li>
    </ul>
</nav>
