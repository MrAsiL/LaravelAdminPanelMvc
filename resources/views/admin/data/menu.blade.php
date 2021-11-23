<!--**********************************
        Sidebar start
    ***********************************-->
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{route('moduller')}}" aria-expanded="false">
                    <i class="icon-grid  menu-icon"></i><span class="nav-text">Modul Yönetimi</span>
                </a>

            </li>
            <li class="nav-label">Sayfalar</li>
{{--            @php--}}
{{--            $menuler=\App\Models\Moduller::whereDurum(1)->get();--}}
{{--             SAĞLIKLI BI YONTEM DEGIL     asagıdada menuler donıcek--}}
{{--            @endphp--}}
            @isset($moduller)
                @foreach($moduller as $modul)

                    <li>
                        <a href="{{route('liste',$modul->seflink)}}" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">{{$modul->baslik}}</span>
                        </a>

                    </li>
                @endforeach
            @endisset
            <li class="mega-menu mega-menu-sm">
                <a href="{{route('ayarlar')}}" aria-expanded="false">
                    <i class="icon-settings menu-icon"></i><span class="nav-text">Ayarlar</span>
                </a>

            </li>

        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
