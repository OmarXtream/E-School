<nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <p> {{Auth::user()->name}} </p>
            </li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

          <li class="nav-item">
            <a class="nav-link" href="#">المدرسين</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">الطلبة</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{route('keys.index')}}">مفاتيح التسجيل</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
