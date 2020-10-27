@extends('layout.student.master')
@section('content')

    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <div class="col-12 mb-3 text-center">
              <h4 class="title" style="border-color: #8B7277">الإختبارات المقررة</h4>
            </div>
            @forelse($exams as $exam)
            <?php
            $info = json_decode($exam->info, false);
            ?>
    <div class="col-md-6 col-lg-4 mb-3">
              <div class="card" style="width: 100%;">
                <img src="imgs/background.png" class="card-img-top" alt="Banner">
                <div class="card-body">
                  <h5 class="card-title">{{$info->name}}</h5>
                <p class="card-text">الدرجة: {{$info->grade}}</p>
                  <a href="{{$exam->url()}}" class="btn btn-primary text-white float-right">بدأ الإختبار</a>
                </div>
              </div>
            </div>
            @empty
            <p> لا يوجد إختبارات حالياً </p>
            @endforelse


            @foreach($results as $result)
            <?php
            $info = json_decode($result->exam->info, false);
            ?>
    <div class="col-md-6 col-lg-4 mb-3">
              <div class="card" style="width: 100%;">
                <img src="imgs/background.png" class="card-img-top" alt="Banner">
                <div class="card-body">
                  <h5 class="card-title">{{$info->name}}</h5>
                <p class="card-text">الدرجة: {{ $result->mark ?: "لم يتم التقييم بعد" }} من {{$info->grade}}</p>
                  <button class="btn btn-success text-white float-right" disabled>تم الإختبار</a>
                </div>
              </div>
            </div>
            @endforeach



          </div>
        </div>
      </section>

@endsection

