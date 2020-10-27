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
            <a class="nav-link" href="{{route('teacher.students')}}"><i class="fal fa-users-class"></i> الطلاب</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('Activity')}}"><i class="fad fa-chart-line"></i> تفاعلات الطلبة</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{route('teacher.assignments')}}"><i class="fal fa-presentation"></i>  شروحات وواجبات</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('teacher.exams')}}"><i class="fal fa-ballot-check"></i> إختبارات</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('Exam.results')}}"><i class="far fa-pencil"></i> إجابات الطلاب</a>
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
