<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Traits\MyFunctions;

class TeacherController extends Controller
{
    use MyFunctions;
    public function __construct()
    {
        $this->middleware('assign.guard:manager');
    }


    public function index(){
        $teachers = Teacher::get();
        return view('manager.home',compact('teachers'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            $response = $this->RespError($validator->errors());
            return response()->json($response);
                }
        $teacher = Teacher::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'instagram' => $request['instagram'],
            'whatsapp' => $request['whatsapp'],
            'level' => $request['level'],
            ]);

            if(!$teacher->exists){
            App::abort(500, 'Error');
        }else{
            $response = $this->RespSuccess('تم إنشاء حساب المعلم بنجاح');
            return response()->json($response);

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

        $Teacher = Teacher::find($id);

        if(!$Teacher){
        $response = $this->RespError(['Error' => ['لم يتم العثور على المعلم']]);
        return response()->json($response);
        }

        $Teacher->delete();
        $response = $this->RespSuccess('تم حذف المعلم بنجاح');
        return response()->json($response);

    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(true));

        if ($validator->fails()) {
            $response = $this->RespError($validator->errors());
            return response()->json($response);
                }

        $Teacher = Teacher::find($request->id);
        if(!$Teacher){
            $response = $this->RespError(['Error' => ['لم يتم العثور على المعلم']]);
            return response()->json($response);
            }
        $Teacher->update([
            'name' => $request->name,
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
            'level' => $request->level

            ]);
        if(!$Teacher->save()){
            $response = $this->RespError(['Error' => ['فشلت عملية التحديث']]);
            return response()->json($response);
        }else{

        $response = $this->RespSuccess('تم التحديث بنجاح');
        return response()->json($response);
        }
    }


    public function rules($update = false){
        if(!$update){
        $rules = [
            'name' => ['bail','required', 'string', 'max:255'],
            'email' => ['bail','required', 'string', 'email', 'max:255', 'unique:teachers,email'],
            'password' => ['bail','required', 'string', 'min:8'],
            'instagram' => ['bail','required', 'string', 'max:30'],
            'whatsapp' => ['bail','required', 'string', 'max:30'],
            'level' => 'bail|required|digits_between:1,3'
        ];
         }else{
            $rules = [
                'id' => ['bail','required', 'numeric'],
                'name' => ['bail','required', 'string', 'max:255'],
                'instagram' => ['bail','required', 'string', 'max:30'],
                'whatsapp' => ['bail','required', 'string', 'max:30'],
                'level' => 'bail|required|digits_between:1,3'
            ];

         }
        return $rules;

    }

}
