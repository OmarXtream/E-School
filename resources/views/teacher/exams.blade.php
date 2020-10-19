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
                      <th scope="col">الإسم</th>
                      <th scope="col">-</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>إختبار 1</td>
                      <td>حذف</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>إختبار 2</td>
                      <td>حذف</td>
                    </tr>
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
        e.preventDefault();
        var formData = new FormData($('#EForm')[0]);
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

var questions = {};


console.log(dict);
      function addInputs(kind) {
        question++;
        switch (kind) {
          case '0':
            $( "#testForm" ).append(
              '<div class="col-12 mb-3">'
                + '<label for="q'+ question + '">سؤال '+ question + '</label>'
                + '<input type="text" name="q'+ question + '" id="q'+ question + '" class="form-control" placeholder="السؤال" required>'
                + '</div>'
              );
            break;
          case '1':
            $( "#testForm" ).append(
                '<div class="col-12 mb-3">'
                  + '<label for="q'+ question + '">سؤال '+ question + '</label>'
                  + '<textarea name="q'+ question + '" id="q'+ question + '" class="form-control" placeholder="السؤال" required></textarea>'
                  + '</div>'
                );
            break;
          case '2':
           $( "#testForm" ).append(
                '<div class="col-12 mb-3">'
                  + '<label for="q'+ question + '">سؤال '+ question + '</label>'
                  + '<input type="text" name="q'+ question + '" id="q'+ question + '" class="form-control mb-2" placeholder="السؤال" required>'
                  + '<input type="text" name="qa'+ question + '[]" id="q'+ question + '-1" class="form-control mb-2" placeholder="إختياري 1" required>'
                  + '<input type="text" name="qa'+ question + '[]" id="q'+ question + '-2" class="form-control mb-2" placeholder="إختياري 2" required>'
                  + '<input type="text" name="qa'+ question + '[]" id="q'+ question + '-3" class="form-control mb-2" placeholder="إختياري 3" required>'
                  + '<input type="text" name="qa'+ question + '[]" id="q'+ question + '-4" class="form-control mb-2" placeholder="إختياري 4" required>'
                  + '</div>'
                );
             break;
          default:
            break;
        }
      }

</script>

@endsection
