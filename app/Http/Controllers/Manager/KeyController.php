<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Key;
use Illuminate\Support\Facades\Validator;
use App\Traits\MyFunctions;
class KeyController extends Controller
{
    use MyFunctions;
    public function __construct()
    {
        $this->middleware('assign.guard:manager');
    }



    public function index(){
        $keys = Key::with('students')->get();
        return view('manager.keys',compact('keys'));
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'bail|required|string|unique:keys,key|max:30'
        ]);

        if ($validator->fails()) {
            $response = $this->RespError($validator->errors());
            return response()->json($response);
                }
        $key = $request->input('key');
        $create = Key::create([
        'key' => $key
        ]);
        if(!$create->exists){
            App::abort(500, 'Error');
        }else{
            $response = $this->RespSuccess('تم إنشاء المفتاح بنجاح');
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

        $key = Key::find($id);

        if(!$key){
        $response = $this->RespError(['Error' => ['لم يتم العثور على المفتاح']]);
        return response()->json($response);
        }

        $key->delete();
        $response = $this->RespSuccess('تم حذف المفتاح بنجاح');
        return response()->json($response);

    }

}
