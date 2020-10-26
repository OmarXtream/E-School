<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Exam;
use Auth;
use App\Traits\MyFunctions;
use Illuminate\Support\Facades\Gate;

class ExamController extends Controller
{
    use MyFunctions;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function exams(){
        $userId = Auth::user()->id;
         $exams = Exam::select('id','info')->where(['level' => Auth::user()->level])->whereDoesntHave("answers", function($subQuery) use($userId){
          $subQuery->where("user_id", "=", $userId);
        })->get();



           return view('student.exams',compact('exams'));
       }

       public function show(Exam $exam){
        Gate::authorize('already:exam',$exam);

        return view('student.exam',compact('exam'));

     }
     public function store(Request $request){
        $Nreq = $request->except(['_token','examid']);

         $examForm = Exam::findOrFail($request->examid);

         Gate::authorize('already:exam',$examForm);

         $searchIn =  json_decode($examForm->info,true);



        foreach ($Nreq as $key => $value) {
            // $key = inputs = check for these bitches in the orginal exam
            if (!array_key_exists($key, $searchIn)) {
                $response = $this->RespError(['Error' => ['خطأ لم يتم العثور على الإختبار']]);
                return response()->json($response);
                }

        }
       $answer = Answer::Create([
            'exam_id' => $request->examid,
            'info' => json_encode($Nreq),
            'user_id' => Auth::user()->id,
        ]);

            if ($answer)
            return response()->json([
                'status' => true,
                'msg' => 'تم إرسال الإجابات بنجاح',
            ]);

             else
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
            ]);




    }




}
