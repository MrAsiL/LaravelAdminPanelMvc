<!--**********************************
        Nav header start
    ***********************************-->
<div class="nav-header">
    <div class="brand-logo">
        <a href="{{asset('/yonetim/')}}">
            <b class="logo-abbr"><img src="{{ asset('admin') }}/images/logo.png" alt=""> </b>
            <span class="logo-compact"><img src="{{ asset('admin') }}/images/logo-compact.png" alt=""></span>
            <span class="brand-title">
                        <img src="{{ asset('admin') }}/images/logo-text.png" alt="">
                    </span>
        </a>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->
<!--**********************************
       Header start
   ***********************************-->
<div class="header">
    <div class="header-content clearfix">

        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        <div class="header-left">
            <div class="input-group icons">

            </div>
        </div>
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown d-none d-md-flex">
                    <a href="#" class="log-user" >
                        <span> {{ Auth::user()->name }}</span>
                    </a>

                </li>
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                        <span class="activity active"></span>
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        @else
                                        {{ Auth::user()->name }}
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                        @endif
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="{{route('profile.show')}}"><i class="icon-user"></i> <span>Profil</span></a>
                                </li>
                                <hr class="my-2">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button type="submit"
                                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            <i class="icon-key"></i>Çıkış yap
                                        </button>
                                    </form>
                                  </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->
