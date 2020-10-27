
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
                <select name="search" onchange="searchF(this.value)" class="form-control" id="search">
                    <option value="" >  إسم الطالب</option>
                @forelse($examR->answers as $answer)
                <option value="{{$answer->user->id}}">{{$answer->user->name}}</option>

                @empty
                <option value="" disabled>لا يوجد إجابات</option>

                @endforelse
                </select>
              </form>
            </div>
<div class="col-12"><div class="row" id="txtHint"> </div></div>

          </div>
        </div>
      </section>

@endsection

@section('scripts')

<script>

function searchF(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","{{route('teacher.student.result',$examR->id)}}?stdId=" + str + "&_token=" + document.getElementsByName('csrf-token')[0].getAttribute('content'),true);
        xmlhttp.send();
    }
}

function grade(id){

var mark = $('#mark').val();
console.log(mark);
sendData(' {{route('teacher.exam.mark.update')}}' ,'mark='+mark+'&stdId='+id+'&exam={{$examR->id}}')
    .then(function(response) {
        $.each(response.m,function(key,val) {
            swal.fire({
            title: response.t,
            text: val[0],
            icon: response.tp,
            showConfirmButton: true,
            confirmButtonText: 'حسناً'
        });

            });


    });

    }

</script>

@endsection
