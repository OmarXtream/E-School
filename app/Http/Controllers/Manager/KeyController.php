<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Key;
class KeyController extends Controller
{
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
        $request->validate([
            'key' => 'bail|required|string|unique:keys,key|max:30'
        ]);
        $key = $request->input('key');
        $create = Key::create([
        'key' => $key
        ]);
        if(!$create->exists()){
            App::abort(500, 'Error');
        }else{
            return redirect()->back()->with(['success' => 'تم تسجيل المفتاح بنجاح']);

        }

    }


    public function destroy($id)
    {
        $key = Key::where('id',$id)->first();

        if(!$key)
        return redirect()->back()->withErrors(['Error' => 'لم يتم العثور على المفتاح']);


        $key->delete();

        return redirect()->route('KeysCreate')->with(['success' => 'تم حذف المفتاح بنجاح']);
    }

}
