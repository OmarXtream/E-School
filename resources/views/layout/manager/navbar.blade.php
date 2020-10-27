<nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link"> {{Auth::user()->name}} </a>
            </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('teacher.index')}}"><i class="fal fa-graduation-cap"></i> المدرسين </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('student.index')}}"><i class="fal fa-users-class"></i> الطلاب</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{route('keys.index')}}"><i class="fal fa-key"></i> مفاتيح التسجيل</a>
          </li>


          <li class="nav-item">

            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                تسجيل الخروج
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>

        </ul>
      </div>
    </div>
  </nav>
