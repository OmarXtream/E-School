<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateAssi;
use Auth;
use Storage;
use App\Traits\MyFunctions;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class AssignmentController extends Controller
{
    use MyFunctions;
    public function __construct()
    {
        $this->middleware('assign.guard:teacher');
    }
    public function index(){
         $Assignments = Assignment::with(['teacher' => function($q){
            $q->select('id','name');
        }])->where('level',Auth::user()->level)->get();
        return view('teacher.assignment',compact('Assignments'));
    }

    public function store(CreateAssi $request)
    {

        if($request->hasfile('files'))
        {
           foreach($request->file('files') as $file)
           {
            $rules = array('file' => 'required|mimes:docx,pdf,doc|max:2048');


            $validator = Validator::make(array('file'=> $file), $rules);

            if(!$validator->passes()){
                return response()->json([
                    'status' => false,
                    'msg' => 'نوع الملف غير مسموح به ',
                ]);

            }

            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('pdfs', $fileName);
            $data[] = $fileName;
           }
        }else{
            $data = null;
            }

            $files = json_encode($data);

        $assignment = Assignment::create([
            'name' => $request['name'],
            'content' => $request['content'],
            'type' => $request['type'],
            'level' => Auth::user()->level,
            'files' => $files,
            'teacher_id' => Auth::user()->id
            ]);
            if ($assignment->save())
            return response()->json([
                'status' => true,
                'msg' => 'تم إنشاء المحتوى بنجاح',
            ]);

             else
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
            ]);



    }

    public function rules(){
        $rules = [
            'name' => ['bail','required', 'string', 'max:50'],
            'content' => ['bail','required', 'string'],
            'type' => ['bail','required', 'digits_between:1,2'],
            'file' => 'bail|mimes:docx,pdf|max:2048'
        ];
        return $rules;

    }

    public function downlaod($file){

         $check = Assignment::whereJsonContains('files',$file)->exists();
         $check2 =  Storage::exists('pdfs/'.$file);
        if($check and $check2){
        $headers = [
            'Content-Type' => 'application/pdf',
         ];
        $name = rand(1,100).'Assignment.pdf';
        return  Storage::download('pdfs/'.$file, $name, $headers);

        }else{
           return abort(404);

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

        $Assignment = Assignment::find($id);

        if(!$Assignment){
        $response = $this->RespError(['Error' => ['لم يتم العثور على المحتوى']]);
        return response()->json($response);
        }
        $files = $Assignment->files;
        if($files != "null"){
            foreach(json_decode($files) as $file)
            {
                if(Storage::exists('pdfs/'.$file))
                    Storage::delete('pdfs/'.$file);


            }
        }
        $Assignment->delete();
        $response = $this->RespSuccess('تم حذف المحتوى بنجاح');
        return response()->json($response);

    }


    public function Activity(){
        $assignments = Assignment::where('level',Auth::user()->level)->get();

        return view('teacher.activity',compact('assignments'));
       }

}
