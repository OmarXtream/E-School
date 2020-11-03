@extends('layout.teacher.master')
@section('content')



    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <div class="col-12 mb-3 text-center">
              <h4 class="title" style="border-color: #8B7277">الطلبة</h4>
            </div>

            <div class="col-12 mb-2">
             <div class="table-responsive">
                <table class="table table-striped text-center table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">الطالب</th>
                      <th scope="col">الإيميل</th>
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
                    <td id="level-{{$student->id}}">{{$student->level}}</td>
                    <td>{{$student->answers->sum('mark')}}</td>

                    <td id="levelbtn-{{$student->id}}">
                        @if($student->level > 1)
                        <button onclick="Level({{$student -> id}},{{$student -> level - 1}})" class="btn btn-danger text-white"> <i class="fa fa-arrow-down" aria-hidden="true"></i> خفض </button>
                        @endif
                        @if($student->level < 3)
                        <button onclick="Level({{$student -> id}},{{$student -> level + 1}})" class="btn btn-success text-white"><i class="fa fa-level-up" aria-hidden="true"></i> ترقية </button>
                        @endif

                    </td>
                    </tr>
                    @empty
                    <p class="text-muted">لا يوجد طلاب مسجلين</p>
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

function Level(id,level){
if(level > 3){
    new toast({
        icon: 'info',
        title: 'عذراً المستوى الأقصى 3'
            });

}else if(level < 1){
    new toast({
        icon: 'info',
        title: 'عذراً المستوى الأدنى 1'
            });

}

sendData(' {{route('Tstudent.level')}}' ,"id="+id+"&level="+level)
    .then(function(response) {
        $.each(response.m,function(key,val) {
            new toast({
                icon: response.tp,
                title: val[0]
            });

            });
        if (response.tp == 'success') {
            animateCSS('#t-'+id, 'rollOut').then((message) => {
                $("#t-"+id).remove();
            });

            console.log('Student Level changed Successfuly');

        }


    });
    }




</script>
@endsection
