@extends('layout.student.master')
@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<section class="" id="page-content">
    <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">

      <div class="row">
        <div class="col-12 mb-3 text-center">
          <h4 class="title" style="border-color: #8B7277">الدروس المطلوبة</h4>
        </div>

        @forelse ($Assignments as $assignment)

        <div class="col-md-6 col-lg-4 mb-3">
          <div class="card" style="width: 100%;">
            <img src="imgs/background.png" class="card-img-top" alt="Banner">
            <div class="card-body">
            <h5 class="card-title">{{$assignment->name}}</h5>
              <p class="card-text">{{Str::words($assignment->content, $words = 10, $end = '...')}}</p>
            <a href="{{$assignment->url()}}" class="btn btn-primary text-white float-right">دخول الدرس</a>
            </div>
          </div>
        </div>
        @empty
        <h1> لا يوجد دروس حالياً </h1>
        @endforelse

      </div>
    </div>
  </section>

@endsection

