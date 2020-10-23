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

}
