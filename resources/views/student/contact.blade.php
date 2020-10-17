@extends('layout.student.master')
@section('content')

    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row text-center">
            <div class="col-12 mb-5">
              <h4 class="title" style="border-color: #8B7277"><i class="far fa-comments"></i> التواصل مع المعلم</h4>
            </div>
            @forelse($teachers as $teacher)
            <div class="col-md-5 mb-5 mb-md-2">
              <a href="https://wa.me/{{$teacher->whatsapp}}" target="_blank"><i class="fab fa-whatsapp fa-9x text-success"></i></a>
            </div>
            <div class="col-md-2">
                <h5> <i class="fal fa-user-graduate"></i> {{$teacher->name}}</h5>
            </div>
            <div class="col-md-5">
              <a href="https://instagram.com/{{$teacher->instagram}}"  target="_blank"><i class="fab fa-instagram fa-9x text-danger"></i></a>
            </div>
            <hr>

            @empty
            <h1> لا يوجد مُعلمين حالياً </h1>
            @endforelse
          </div>
        </div>
      </section>

@endsection

