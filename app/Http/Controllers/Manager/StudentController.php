<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use App\Traits\MyFunctions;

class StudentController extends Controller
{
    use MyFunctions;
    public function __construct()
    {
        $this->middleware('assign.guard:manager');
    }


    public function index(){
        $students = User::with('answers')->get();
        return view('manager.students',compact('students'));
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

                $student = User::find($request->id);
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
                    $student->answers()->delete();
                $response = $this->RespSuccess('تم التنفيذ بنجاح');
                return response()->json($response);
                }


    }

}
