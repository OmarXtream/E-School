
@extends('layout.teacher.master')
@section('content')
    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <div class="col-12 mb-3 text-center">
              <h4 class="title" style="border-color: #8B7277">الإختبارات</h4>
            </div>

            <div class="col-12 mb-2">
              <button class="text-white btn btn-primary d-inlin-block mb-3" data-toggle="modal" data-target="#createUsingModal">إنشاء</button>
              <div class="table-responive">
                <table class="table table-striped text-center table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">المُعلم</th>
                      <th scope="col">العنوان</th>
                      <th scope="col"> إجراءات </th>
                    </tr>
                  </thead>
                  <tbody>

                    @forelse($exams as $exam)
                    <?php
                    $info = json_decode($exam->info, false);
                    // foreach ($info as $key => $value) {
                    //     if (Str::startsWith($key, 'text') || Str::startsWith($key, 'radio')|| Str::startsWith($key, 'des')|| Str::startsWith($key, 'input')) {
                    //         if (!is_array($value)) {
                    //             print_r($key);
                    //             echo "<br>";
                    //             print_r($value);
                    //             echo "<br> <br> <br>";

                    //         } else {
                    //             print_r($key);
                    //             echo "<br>";
                    //             for ($i=0; $i <= $exam->count+1; $i++) {
                    //                 print_r( $value[$i] );
                    //                 echo  " <br> ";
                    //             }
                    //         }

                    //     }



                    // }
                    ?>
                    <tr id="e-{{$exam->id}}">
                        <th scope="row">{{$exam->id}} </th>
                       <td>{{$exam->teacher->name}}</td>
                        <td>{{$info->name}}</td>
                        <td> <button onclick="DeleteE({{$exam->id}})" class="btn btn-danger text-white"><i class="fa fa-times"></i> حذف </button></td>
                    </tr>
                    @empty
                    <p> لا يوجد إختبارات حالياً </p>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>


      <!-- Modal -->
      <div class="modal fade" id="createUsingModal" tabindex="-1" role="dialog" aria-labelledby="createUsingModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createUsingModalTitle">إنشاء إختبار</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="EForm" method="POST" action="">
                  @csrf
                <div class="form-row" id="testForm">
                  <div class="col-12 mb-3">
                    <label for="name">إسم الإختبار</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="إختبار رئيسي" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="des">شرح الإختبار</label>
                    <textarea  name="des" id="des" class="form-control" placeholder="شرح الإختبار هنا.." required></textarea>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="grade">درجة الإختبار</label>
                    <input type="number"  name="grade" id="grade" class="form-control" placeholder="درجة الإختبار" required>
                  </div>

                </div>
                <div class="form-row mt-5">
                  <div class="col-12">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addInputs('0')">إضافة نص صغير</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addInputs('1')">إضافة نص طويل</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addInputs('2')">إضافة إختياري</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
              <button type="button" class="btn btn-primary" id="Createbtn">إنشاء</button>
            </div>
          </div>
        </div>
      </div>

@endsection

@section('scripts')

<script>



$(document).on('click', '#Createbtn', function (e) {
    if(question < 1){
        new toast({
            icon: 'info',
            title: 'يجب تسجيل سؤال واحد على الأقل'
                });
        throw "No questions";
    }
        e.preventDefault();
        var formData = new FormData($('#EForm')[0]);
        formData.append('count', question);

        $.ajax({
            type: 'post',
            url: "{{route('teacher.exam.create')}}",
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
                    title: 'تم إنشاء الاختبار بنجاح'
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







var question = 0;

      function addInputs(kind) {
        question++;

        switch (kind) {
          case '0':
            $( "#testForm" ).append(
              '<div class="col-12 mb-3">'
                + '<label for="input'+ question + '">سؤال '+ question + '</label>'
                + '<input type="text" name="input'+ question + '" id="q'+ question + '" class="form-control" placeholder="السؤال" required>'
                + '</div>'
              );
            break;
          case '1':
            $( "#testForm" ).append(
                '<div class="col-12 mb-3">'
                  + '<label for="text'+ question + '">سؤال '+ question + '</label>'
                  + '<textarea name="text'+ question + '" id="text'+ question + '" class="form-control" placeholder="السؤال" required></textarea>'
                  + '</div>'
                );
            break;
          case '2':
           $( "#testForm" ).append(
                '<div class="col-12 mb-3">'
                  + '<label for="radio'+ question + '">سؤال '+ question + '</label>'
                  + '<input type="text" name="radio'+ question + '[]" id="q'+ question + '" class="form-control mb-2" placeholder="السؤال" required>'
                  + '<input type="text" name="radio'+ question + '[]" id="q'+ question + '-1" class="form-control mb-2" placeholder="إختياري 1" required>'
                  + '<input type="text" name="radio'+ question + '[]" id="q'+ question + '-2" class="form-control mb-2" placeholder="إختياري 2" required>'
                  + '<input type="text" name="radio'+ question + '[]" id="q'+ question + '-3" class="form-control mb-2" placeholder="إختياري 3" required>'
                  + '<input type="text" name="radio'+ question + '[]" id="q'+ question + '-4" class="form-control mb-2" placeholder="إختياري 4" required>'
                  + '</div>'
                );
             break;
          default:
            break;
        }
      }




      function DeleteE(id){
        swal.fire({
                title: 'هل انت متأكد؟',
                text: "سوف يتم حذف البيانات ولا يمكن إسترجاعها",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'تراجع',
                confirmButtonText: 'تأكيد'
            }).then((result) => {
                if (result.value) {
    sendData("{{route('Exam.delete')}}","id="+id)
    .then(function(response)
    {
        $.each(response.m,function(key,val) {

    new toast({
        icon: response.tp,
        title: val[0]
    });

     if(response.tp == 'success')
    {
        animateCSS('#e-'+id, 'fadeOutUp').then((message) => {
            $('#e-'+id).remove();
            });
        console.log('Assignment Removed Successfuly');

    }
    });

    });

            }
        });

}

</script>

@endsection
