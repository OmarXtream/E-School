
@extends('layout.teacher.master')
@section('content')
    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <div class="col-12 mb-3 text-center">
              <h4 class="title" style="border-color: #8B7277">نماذج الإجابات</h4>
            </div>
            @forelse($exams as $exam)
            <?php
            $info = json_decode($exam->info, false);
            ?>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" style="width: 100%;">
                  <img src="../imgs/background.png" class="card-img-top" alt="Banner">
                  <div class="card-body">
                    <h5 class="card-title mb-5">{{$info->name}}</h5>
                   <a href="{{$exam->Resulturl()}}"> <button class="btn btn-primary float-right" data-toggle="modal" data-target="#showActivity">مشاهدة الإجابات</button></a>
                  </div>
                </div>
              </div>
              @empty
            <h5 class="m-auto"> لا يوجد حالياً</h5>
            @endforelse



          </div>
        </div>
      </section>

@endsection

