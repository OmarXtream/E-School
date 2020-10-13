@extends('layout.manager.master')
@section('content')

    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <div class="col-12 mb-3 text-center">
              <h4 class="title" style="border-color: #8B7277">مفاتيح التسجيل</h4>
            </div>

            <div class="col-12 mb-2">
              <button class="text-white btn btn-primary d-inlin-block mb-3" data-toggle="modal" data-target="#createUsingModal">إنشاء مفتاح</button>
              <div class="table-responive">
                <table class="table table-striped text-center table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">المفتاح</th>
                      <th scope="col">تاريخ الإنشاء</th>
                      <th scope="col">عدد الطلاب</th>
                      <th scope="col">-</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($keys as $key)
                    <tr id="k-{{$key->id}}">
                    <th scope="row">{{$key->id}}</th>
                      <td>{{$key->key}}</td>
                      <td>{{$key->created_at}}</td>
                      <td>{{$key->students->count()}}</td>
                      <td> <button onclick="DeleteKey({{$key -> id}})" class="btn btn-danger text-white">حذف </button> </td>
                    </tr>
                    @empty
                    <p>لا يوجد مفاتيح حالياً</p>
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
              <h5 class="modal-title" id="createUsingModalTitle">إنشاء مفتاح</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="KeyForm" onsubmit="return false;">
                <label for="newKey">المفتاح المطلوب</label>
                <input type="text" name="key" id="key" class="form-control" placeholder="المفتاح المطلوب، مثال: U2kdmowe" required>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
              <button type="button" onclick="CreateKey()" class="btn btn-primary">إنشاء المفتاح</button>
            </div>
          </div>
        </div>
      </div>

@endsection

@section('scripts')
<script>

function CreateKey(){
    var form = $('#KeyForm');

sendData(' {{route('keys.create')}}' , form.serialize())
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
            $('#KeyForm')[0].reset();

            console.log('Key Created Successfuly');

        }


    });
    }


    function DeleteKey(id){

    sendData("{{route('keys.delete')}}","id="+id)
    .then(function(response)
    {
        $.each(response.m,function(key,val) {

    new toast({
        icon: response.tp,
        title: val[0]
    });

     if(response.tp == 'success')
    {
        $('#k-'+id).remove();
        console.log('Key Removed Successfuly');

    }
    });

    });
}


</script>
@endsection
