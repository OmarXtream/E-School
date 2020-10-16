<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Auth;

use App\Traits\MyFunctions;

class StudentController extends Controller
{
    use MyFunctions;
    public function __construct()
    {
        $this->middleware('assign.guard:teacher');
    }

    public function index(){
        $students = User::where('level',Auth::user()->level)->get();
        return view('teacher.home',compact('students'));
    }

    public function level(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'bail|required|numeric',
            'level' => 'bail|required|digits_between:1,3'
        ]);

        if ($validator->fails()) {
            $response = $this->RespError($validator->errors());
            return response()->json($response);
                }

                $student = User::find($request->id)->where('level',Auth::user()->level)->first();
                if(!$student){
                    $response = $this->RespError(['Error' => ['لم يتم العثور على الطالب']]);
                    return response()->json($response);
                    }
                $student->update([
                    'level' => $request->level
                    ]);
                if(!$student->save()){
                    $response = $this->RespError(['Error' => ['فشلت عملية التحديث']]);
                    return response()->json($response);
                }else{

                $response = $this->RespSuccess('تم التنفيذ بنجاح');
                return response()->json($response);
                }


    }

}
