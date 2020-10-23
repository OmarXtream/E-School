<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ExamStore;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\MyFunctions;

class ExamController extends Controller
{
    use MyFunctions;

    public function __construct()
    {
        $this->middleware('assign.guard:teacher');
    }
    public function index(){
          $exams = Exam::with(['teacher' => function($q){
            $q->select('id','name');
        }])->where('level',Auth::user()->level)->get();
        return view('teacher.exams',compact('exams'));
    }

    public function store(ExamStore $request){
        $inputs = $request->except(['_token','count']);
        $allowed = array('name','des','grade','input','text','radio');
        foreach($inputs as $key => $value){
        if(!$this->in_array_strpos($key,$allowed))
            return response()->json([
                'status' => false,
                'msg' => 'خطأ يوجد حقل غير مسموح به',
            ]);
        elseif(empty($value))
        return response()->json([
            'status' => false,
            'msg' => 'فضلاً قم بملأ الحقول',
        ]);

            }
   $exam = Exam::Create([
            'count' => $request->count,
            'info' => json_encode($request->except(['_token','count'])),
            'teacher_id' => Auth::user()->id,
            'level' => Auth::user()->level
        ]);
        if($exam->save()){
            return response()->json([
                'status' => true,
                'msg' => 'تم إنشاء الإختبار بنجاح',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
            ]);
        }
    }
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'bail|required|numeric'
        ]);

        if ($validator->fails()) {
            $response = $this->RespError($validator->errors());
            return response()->json($response);
                }
        $id = $request->input('id');

        $Exam = Exam::find($id);

        if(!$Exam){
        $response = $this->RespError(['Error' => ['لم يتم العثور على الإختبار']]);
        return response()->json($response);
        }
        $Exam->delete();
        $response = $this->RespSuccess('تم حذف الإختبار بنجاح');
        return response()->json($response);

    }




}
