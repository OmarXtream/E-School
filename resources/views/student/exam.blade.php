@extends('layout.student.master')
@section('content')

    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <?php
            $info = json_decode($exam->info, false);
            ?>
            <div class="col-12 mb-3 text-center">
              <h4 class="title" style="border-color: #8B7277">{{$info->name}}</h4>
            </div>

            <div class="col-12 mb-5">
              <p>{{$info->des}}</p>
            </div>

            <div class="col-md-6 mb-3 mx-auto">
              <form id="EForm" method="POST" action="">
                  @csrf
              <input type="hidden" name="examid" value="{{$exam->id}}">
                <div class="form-row">
                    <?php

                    foreach ($info as $key => $value) {
                        if (Str::startsWith($key, 'text')) {
                            ?>
                            <div class="col-12 mb-4">
                                <label for="text-{{$key}}">
                                    {{$value}}
                                </label>
                                <textarea name="{{$key}}" id="{{$key}}" class="form-control" placeholder="الإجابة" required></textarea>
                              </div>
                            <?php
                        } else if (Str::startsWith($key, 'radio')) {
                            ?>
                            <div class="col-12 mb-4">
                                <p class="mb-2">{{$value[0]}}</p>
                                <input type="radio" id="{{$key}}-1" name="{{$key}}" value="{{$value[1]}}" required>
                                <label for="{{$key}}-1">{{$value[1]}}</label>
                                <br>
                                <input type="radio" id="{{$key}}-2" name="{{$key}}" value="{{$value[2]}}" required>
                                <label for="{{$key}}-2">{{$value[2]}}</label>
                                <br>
                                <input type="radio" id="{{$key}}-3" name="{{$key}}" value="{{$value[3]}}" required>
                                <label for="{{$key}}-3">{{$value[3]}}</label>
                                <br>
                                <input type="radio" id="{{$key}}-4" name="{{$key}}" value="{{$value[4]}}" required>
                                <label for="{{$key}}-4">{{$value[4]}}</label>
                            </div>
                        <?php
                        } else if (Str::startsWith($key, 'input')) {
                           ?>

                            <div class="col-12 mb-4">
                                <label for="{{$key}}">
                                    {{$value}}
                                </label>
                                <input type="text" class="form-control" name="{{$key}}" id="{{$key}}" placeholder="الإجابة.." required>
                            </div>
                           <?php

                        }
                    }
                    ?>




                  <div class="col-12 mb-2 text-right">
                    <button class="btn btn-primary" id="Createbtn">إرسال وتأكيد</button>
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
$(document).on('click', '#Createbtn', function (e) {
    e.preventDefault();
    var formData = new FormData($('#EForm')[0]);
    $.ajax({
        type: 'post',
        url: "{{route('student.exam.store')}}",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            if (data.status == true) {
                $('#createUsingModal').modal('hide');
                $('#EForm')[0].reset();
                new toast({
                icon: 'success',
                title: 'تم إرسال الإجابات بنجاح'
                 });


            }else{
                 new toast({
                icon: 'warning',
                title: data.msg
                 });


            }
        }, error: function (reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                new toast({
                icon: 'info',
                title: val[0]
                 });

             });
        }
    });
});
</script>
@endsection
