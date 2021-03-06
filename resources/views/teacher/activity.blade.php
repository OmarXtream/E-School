@extends('layout.teacher.master')
@section('content')


    <!-- page content -->
    <section class="" id="page-content">
      <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
        <div class="row">
          <div class="col-12 mb-3 text-center">
            <h4 class="title" style="border-color: #8B7277">تفاعلات الطلبة</h4>
          </div>
          @forelse($assignments as $assignment)
          <div class="col-md-6 col-lg-4 mb-3">
            <div class="card" style="width: 100%;">
              <img src="../imgs/background.png" class="card-img-top" alt="Banner">
              <div class="card-body">
              <h5 class="card-title mb-5">{{$assignment->name}}</h5>
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#showActivity-{{$assignment->id}}">مشاهدة التفاعل</button>
              </div>
            </div>
          </div>





    <!-- Modal -->
    <div class="modal fade" id="showActivity-{{$assignment->id}}" tabindex="-1" role="dialog" aria-labelledby="showActivityTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="showActivityTitle">مشاهدة التفاعلات - {{$assignment->name}} </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 mb-2">
                  <h6 class="text-success mb-3">الطلبة المتفاعلين</h6>
                  <ol>
                    @forelse($assignment->activities as $Activity)
                        <li>{{$Activity->student->name}}</li>
                    @empty
                        <h4> لا يوجد </h4>
                    @endforelse

                  </ol>
                </div>
                <div class="col-md-6 mb-2">
                  <h6 class="text-danger mb-3">الطلبة غير المتفاعلين</h6>
                  <ol>
                @forelse($assignment->InActiveStudents() as $InActive)
                    <li>{{$InActive->name}}</li>
                @empty
                    <h4> لا يوجد </h4>
                @endforelse

                  </ol>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
          </div>
        </div>
      </div>




          @empty
          <h2> لا يوجد دروس حالياً </h2>
          @endforelse

        </div>
      </div>
    </section>



    @endsection
