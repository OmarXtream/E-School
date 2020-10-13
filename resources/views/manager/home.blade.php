@extends('layout.manager.master')
@section('content')

    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <div class="col-12 mb-3 text-center">
              <h4 class="title" style="border-color: #8B7277">المدرسين</h4>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-12 mb-2">
              <button class="text-white btn btn-primary d-inlin-block mb-3" data-toggle="modal" data-target="#createUsingModal">مدرس جديد</button>
              <div class="table-responive">
                <table class="table table-striped text-center table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">المعلم</th>
                      <th scope="col">الإيميل</th>
                      <th scope="col">المستوى</th>
                      <th scope="col">-</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($teachers as $teacher)
                    <tr id="t-{{$teacher->id}}">
                    <th scope="row">{{$teacher->id}}</th>
                    <td>{{$teacher->name}}</td>
                    <td>{{$teacher->email}}</td>
                    <td>{{$teacher->level}}</td>
                    <td> <button onclick="DeleteKey({{$teacher -> id}})" class="btn btn-danger text-white">حذف </button> </td>
                    </tr>
                    @empty
                    <p>لا يوجد معلمين مسجلين</p>
                    @endforelse

                    <tr>
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
              <h5 class="modal-title" id="createUsingModalTitle">مدرس جديد</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="TForm" onsubmit="return false;">
                    <div class="form-row">
                  <div class="col-12 mb-3">
                    <label for="name">الإسم</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="حمد محمد" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="email@name.com" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="password">كلمة السر</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="*********" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="level">المستوى</label>
                    <select name="level" id="" class="form-control">
                      <option value="0" selected disabled>قم بإختيار المستوى</option>
                      <option value="1">المستوى 1</option>
                      <option value="2">المستوى 2</option>
                      <option value="3">المستوى 3</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
              <button type="button" class="btn btn-primary" onclick="CreateT()">إنشاء</button>
            </div>
          </div>
        </div>
      </div>

@endsection

@section('scripts')
<script>

function CreateT(){
    var form = $('#TForm');

sendData(' {{route('teacher.create')}}' , form.serialize())
    .then(function(response) {
        $.each(response.m,function(key,val) {
            swal.fire({
            title: response.t,
            text: val[0],
            icon: response.tp,
            showConfirmButton: response.b,
            confirmButtonText: 'حسناً'
        });

            });
        if (response.tp == 'success') {
            $('#createUsingModal').modal('hide');
            $('#TForm')[0].reset();

            console.log('Teacher Created Successfuly');

        }


    });
    }


    function DeleteKey(id){

    sendData("{{route('teacher.delete')}}","id="+id)
    .then(function(response)
    {
        $.each(response.m,function(key,val) {

    new toast({
        icon: response.tp,
        title: val[0]
    });

     if(response.tp == 'success')
    {
        $('#t-'+id).remove();
        console.log('teacher Removed Successfuly');

    }
    });

    });
}


</script>
@endsection
