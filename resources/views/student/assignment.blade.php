@extends('layout.student.master')
@section('content')

    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <div class="col-12 mb-3 text-center">
            <h4 class="title" style="border-color: #8B7277">{{$assignment->name}}</h4>
            </div>

            <div class="col-12 mb-2">
              <p>{{$assignment->content}}</p>
              <hr>
              <?php $count = 1; ?>
              @if ($assignment->files != "null")
              <br><h5> الملفات المرفقة : </h5>
              @foreach (json_decode($assignment->files) as $file)
              <a href="{{route('student.download.assignment',$file)}}" class="d-inline-block text-underline" target="_blank"><i class="far fa-file-alt"></i> {{$assignment->name}} - {{$count++}} </a>
              <br>
              @endforeach
              @endif

            </div>

          </div>
        </div>
      </section>

@endsection

