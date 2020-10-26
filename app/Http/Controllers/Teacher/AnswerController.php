<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
  public function __construct()
    {
        $this->middleware('assign.guard:teacher');
    }


  public function index(){
        $exams = Exam::has('answers')->where('level',Auth::user()->level)->get();
      return view('teacher.examsresult',compact('exams'));
    }



 public function show($exam){
      $examR = Exam::with(['answers' => function($q){
        $q->select('info','user_id','exam_id');
        }])->where(['level' => Auth::user()->level , 'id' => $exam])->first();
    if($examR)
    return view('teacher.result',compact('examR'));
    else
    abort(404);

    }

public function userAnswer(Request $request, Exam $exam){
return '
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
';
}

}
