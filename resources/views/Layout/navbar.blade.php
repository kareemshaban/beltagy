<header id="header"
@if($slag == 1) class="fixed-top d-flex align-items-center header-transparent" @else 
class="fixed-top d-flex align-items-center" @endif

dir="{{__('main.dir')}}">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="{{route('index')}}"><span style="color:gold;">TAHON GOLD</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar" >
      <i class="bi bi-list mobile-nav-toggle"></i>
        <ul>
          <li><a @if($slag == 1) class="active main_nav_ele" @else class="main_nav_ele" @endif href="{{route('index')}}" >{{__('main.home')}}</a></li>
          <li><a @if($slag == 2) class="active main_nav_ele" @else class="main_nav_ele" @endif href="{{route('about')}}" >{{__('main.about')}}</a></li>
          <li><a @if($slag == 3) class="active main_nav_ele" @else class="main_nav_ele" @endif href="{{route('services')}}">{{__('main.services')}}</a></li>
          <li><a @if($slag == 4) class="active main_nav_ele" @else class="main_nav_ele" @endif href="{{route('portfolio')}}">{{__('main.profile')}}</a></li>
          <li><a @if($slag == 5) class="active main_nav_ele" @else class="main_nav_ele" @endif href="{{route('events')}}" >{{__('main.events')}}</a></li>
          <li><a @if($slag == 6) class="active main_nav_ele" @else class="main_nav_ele" @endif href="{{route('contact')}}" >{{__('main.contact')}}</a></li>
          @guest
          <li><a @if($slag == 7) class="active main_nav_ele" @else class="main_nav_ele" @endif   href="{{ route('login') }}" >{{__('main.signin')}}</a></li>
          @endguest
          @auth 
          <li><a @if($slag == 7) class="active main_nav_ele" @else class="main_nav_ele" @endif 
          onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
          >{{__('main.signout')}}</a></li>

          @endauth
          <li class="dropdown"><a href="#"><span class="main_nav_ele">{{__('main.lang')}}</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a rel="alternate" hreflang="ar" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">العربية</a></li>
              <li><a rel="alternate" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">English</a></li>
            
            </ul>
          </li>
        </ul>
    

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->