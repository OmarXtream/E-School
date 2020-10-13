
@extends('layout.manager.master')
@section('content')

    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <div class="col-12 mb-3 text-center">
              <h4 class="title" style="border-color: #8B7277">الطلبة</h4>
            </div>

            <div class="col-12 mb-2">
              <div class="table-responive">
                <table class="table table-striped text-center table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">الطالب</th>
                      <th scope="col">الإيميل </th>
                      <th scope="col">المستوى</th>
                      <th scope="col">مجموع الدرجات</th>
                      <th scope="col">-</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($students as $student)
                    <tr id="t-{{$student->id}}">
                    <th scope="row">{{$student->id}}</th>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->level}}</td>
                    <td> 0</td>

                    <td> <button onclick="downgrade({{$student -> id}})" class="btn btn-danger text-white">خفض </button> <button onclick="upgrade({{$student -> id}},)" class="btn btn-success text-white">ترقية </button> </td>
                    </tr>
                    @empty
                    <p>لا يوجد طلاب مسجلين</p>
                    @endforelse

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>

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
