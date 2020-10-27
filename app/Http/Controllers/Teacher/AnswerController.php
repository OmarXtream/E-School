<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ShowAnswer;
use App\Traits\MyFunctions;
class AnswerController extends Controller
{
    use MyFunctions;
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

public function userAnswer(ShowAnswer $request, Exam $exam){
    $examId = $exam->id;
    $result = Answer::where(['user_id' => $request->stdId,'exam_id' => $examId])->first();
    if($result){
    $info = json_decode($exam->info, true);
    $answers = json_decode($result->info,true);
    $form = '';
    foreach ($info as $key => $value) {
        if (array_key_exists($key, $answers)) {
            $form .= '
            <div class="col-12 mb-3">
            <h6 class="mb-2"> '.htmlspecialchars($value).' ؟</h6>
            <p>'.htmlspecialchars($answers[$key]).'</p>
            </div>
            ';
        }
            }

$form .= '<div class="col-md-5 mb-3 mx-auto">
<form id="UForm" onsubmit="return false;">
  <div class="row">
    <div class="col-12 mb-1">
      <input type="number" name="mark" id="mark" class="form-control mb-2"  max="'.(int)$info['grade'].'" placeholder=" الدرجة الكاملة: '.(int)$info['grade'].'" value="'.(int)$result->mark.'" required>
    </div>
    <div class="col-12 text-center">
      <button class="btn btn-primary mx-auto" onclick="grade('.(int)$result->user_id.')">تعيين الدرجة</button>
    </div>
  </div>
</form>
</div>
';
return response($form);
        }else{
            return response('لم يتم العثور على البيانات');
        }

    }

    public function mark(ShowAnswer $request){
        $mark = $request->mark;
        $result = Answer::with(['exam' => function($q){
            $q->select('info','id');
            }])->where(['user_id' => $request->stdId,'exam_id' => $request->exam])->first();
            $info = json_decode($result->exam->info, true);

        if($result and $mark <= $info['grade']){
        $result->update([
            'mark' => $request->mark
            ]);
        if(!$result->save()){
            $response = $this->RespError(['Error' => ['فشلت عملية التحديث']]);
            return response()->json($response);
        }else{
        $response = $this->RespSuccess('تم التنفيذ بنجاح');
        return response()->json($response);
        }

      }
    }

}
