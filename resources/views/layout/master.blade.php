<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <!-- meta-tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">

    <!-- other -->
    <link rel="icon" href="imgs/icon.png">
    <title>E-School | Private School System</title>
  </head>
  <body>

    <!-- header (title) -->
    <header class="py-2 text-white">
      <div class="container">
        <!-- title -->
        <section class="text-center my-5">
          <img src="imgs/logo.png" alt="Logo" class="mb-2">
          <h2 class="mb-4">عنوان رئيسي</h2>
          <p>بعض النصائح للطلاب وزوار الموقع</p>
        </section>
      </div>
    </header>
    @if(Auth::guard()->check())

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

            <li class="nav-item">
              <a class="nav-link" href="#">الدروس</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">الواجبات</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">الإختبارات</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">تواصل مع المعلم</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    @else
    <nav></nav>
    @endif
    @yield('content')


        <!-- footer -->
        <footer class="text-center text-white py-3">
            Developed with <span class="text-danger"><i class="fas fa-heart"></i></span> By <a href="https://masafat.co">masafat.co <img src="imgs/mlogo.png" alt=""></a>
          </footer>

          <!-- JavaScript -->
          <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
          <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js" integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous"></script>
          <script src="{{URL::asset('js/scripts.js')}}"></script>
        </body>
      </html>
