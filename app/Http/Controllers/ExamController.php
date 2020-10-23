<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Exam;
use Auth;
use App\Traits\MyFunctions;

class ExamController extends Controller
{
    use MyFunctions;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function exams(){
        $exams = Exam::select('id','info')->where(['level' => Auth::user()->level])->get();


        // $exams = Exam::select('id','info')->whereNotExists(function($query)
        // {
        //     $query->select(Exam::raw(1))
        //           ->from('results')
        //           ->whereRaw('results.id = result.user_id');
        // })->where(['level' => Auth::user()->level])->get();


           return view('student.exams',compact('exams'));
       }

       public function show(Exam $exam){

        return view('student.exam',compact('exam'));

     }
     public function store(Request $request){
        $Nreq = $request->except(['_token','examid']);

         $examForm = Exam::findOrFail($request->examid)->info;
         $searchIn =  json_decode($examForm,true);



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
