@extends('layout.teacher.master')
@section('content')
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <div class="col-12 mb-3 text-center">
              <h4 class="title" style="border-color: #8B7277">شروحات وواجبات </h4>
            </div>

            <div class="col-12 mb-2">
              <button class="text-white btn btn-primary d-inlin-block mb-3" data-toggle="modal" data-target="#createUsingModal"><i class="fas fa-book-open"></i> إنشاء</button>
              <div class="table-responive">
                <table class="table table-striped text-center table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">المُعلم</th>
                      <th scope="col">العنوان</th>
                      <th scope="col">النوع</th>
                      <th scope="col">المرفقات</th>
                      <th scope="col">-</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($Assignments as $assignment)
                    <tr id="a-{{$assignment->id}}">
                            <th scope="row">{{$assignment->id}}</th>
                            <td>{{$assignment->teacher->name}}</td>
                            <td>{{$assignment->name}}</td>
                            <td>{{$assignment->type == 1 ? 'واجب' : 'شرح'}}</td>
                            <td>
                                <?php $count = 1; ?>
                                @if ($assignment->files != "null")
                                @foreach (json_decode($assignment->files) as $file)
                                <a href="{{route('download.assignment',$file)}}" target="_blank">{{$assignment->name}} - {{$count++}} </a><br>
                                @endforeach

                                @else
                                <p>لا يوجد</p>
                                @endif
                            </td>
                            <td> <button onclick="DeleteA({{$assignment -> id}})" class="btn btn-danger text-white"><i class="fa fa-times"></i> حذف </button></td>
                     </tr>
                    @empty
                    <p>لا يوجد محتوى حالياً</p>
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
              <h5 class="modal-title" id="createUsingModalTitle"><i class="fas fa-book-open"></i> إنشاء واجب / درس</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="AForm" method="POST" action="" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                  <div class="col-12 mb-3">
                    <label for="name">إسم الشرح</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="شرح 1" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="des">شرح الدرس</label>
                    <textarea  name="content" id="content" class="form-control" placeholder="شرح الدرس هنا.."></textarea>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="level">التصنيف</label>
                    <select name="type" id="" class="form-control" required>
                      <option value="0" selected disabled >قم بإختيار التصنيف</option>
                      <option value="1">واجب</option>
                      <option value="2">شرح</option>
                    </select>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="files">الملف المُرفق</label>
                    <input type="file" name="files[]" id="files" multiple required>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
              <button id="Createbtn" ype="button" class="btn btn-primary">إنشاء</button>
            </div>
          </div>
        </div>
      </div>

@endsection

@section('scripts')

<script>
    $(document).on('click', '#Createbtn', function (e) {
        e.preventDefault();
        var formData = new FormData($('#AForm')[0]);
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{route('teacher.assignments.create')}}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data.status == true) {
                    $('#createUsingModal').modal('hide');
                    $('#AForm')[0].reset();
                    new toast({
                    icon: 'success',
                    title: 'تم إنشاء المحتوى بنجاح'
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






    function DeleteA(id){
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
    sendData("{{route('assignment.delete')}}","id="+id)
    .then(function(response)
    {
        $.each(response.m,function(key,val) {

    new toast({
        icon: response.tp,
        title: val[0]
    });

     if(response.tp == 'success')
    {
        animateCSS('#a-'+id, 'fadeOutUp').then((message) => {
            $('#a-'+id).remove();
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
