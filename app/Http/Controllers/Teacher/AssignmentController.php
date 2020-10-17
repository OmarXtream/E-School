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

class AssignmentController extends Controller
{
    use MyFunctions;
    public function __construct()
    {
        $this->middleware('assign.guard:teacher');
    }
    public function index(){
        $Assignments = Assignment::where('level',Auth::user()->level)->get();
        return view('teacher.assignment',compact('Assignments'));
    }

    public function store(CreateAssi $request)
    {

        if($request->hasfile('files'))
        {
           foreach($request->file('files') as $file)
           {
            $rules = array('file' => 'required|mimes:docx,pdf,doc,zip|max:2048');


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
            $fileName = null;
            }

            $files = json_encode($data);

        $level = Auth::user()->level;
        $assignment = Assignment::create([
            'name' => $request['name'],
            'content' => $request['content'],
            'type' => $request['type'],
            'level' => $level,
            'files' => $files
            ]);
            if ($assignment)
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
        $headers = [
            'Content-Type' => 'application/pdf',
         ];
                         //PDF file is stored under pdfs
    // $file = Storage::disk('local')->get('pdfs/'.$file);
        $name = 'Assignment';
    return Storage::download('pdfs/'.$file, $name, $headers);


    }


}
