
@extends('layout.teacher.master')
@section('content')
    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <?php
            $info = json_decode($examR->info,false);
            ?>
            <div class="col-12 mb-3 text-center">
            <h4 class="title" style="border-color: #8B7277">{{$info->name}}</h4>
            </div>

            <div class="col-md-5 mb-3 mx-auto">
              <form>
                <select name="search" class="form-control" id="search">

                @forelse($examR->answers as $answer)
                <option value="{{$answer->user->id}}">{{$answer->user->name}}</option>

                @empty
                <option value="" disabled>لا يوجد إجابات</option>

                @endforelse
                </select>
              </form>
            </div>

            <div class="col-12 mb-3">
              <h6 class="mb-2">السؤال الأول</h6>
              <p>الجواب</p>
            </div>

            <div class="col-12 mb-3">
              <h6 class="mb-2">السؤال الثاني</h6>
              <p>الجواب</p>
            </div>

            <div class="col-12 mb-3">
              <h6 class="mb-2">السؤال الثالث</h6>
              <p>الجواب</p>
            </div>

            <div class="col-md-5 mb-3 mx-auto">
              <form method="POST">
                <div class="row">
                  <div class="col-12 mb-1">
                    <input type="number" name="grade" id="grade" class="form-control mb-2" placeholder="الدرجة" required>
                  </div>
                  <div class="col-12 text-center">
                    <button class="btn btn-primary mx-auto">تعيين الدرجة</button>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </section>

@endsection

@section('scripts')

<script>


</script>

@endsection
