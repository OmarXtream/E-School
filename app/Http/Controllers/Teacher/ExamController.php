<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ExamStore;
class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('assign.guard:teacher');
    }
    public function index(){
        //  $Assignments = Assignment::with(['teacher' => function($q){
        //     $q->select('id','name');
        // }])->where('level',Auth::user()->level)->get();
        return view('teacher.exams');
    }

    public function store(ExamStore $request){
        return array_values($request->qa1);
        return $request;
    }

}
