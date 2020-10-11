<nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('welcome')}}">الصفحة الرئيسية</a>
                </li>

          <li class="nav-item">
          <a class="nav-link" href="{{route('login')}}">بوابة الطالب</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('TeacherLogin')}}">بوابة المعلم</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
