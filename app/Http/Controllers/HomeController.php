<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Teacher;
use Storage;
use Illuminate\Support\Facades\Gate;

use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Assignments = Assignment::select('id','name','content')->where(['level' => Auth::user()->level,'type' => 2])->get();
        return view('home',compact('Assignments'));

    }
    public function homeworks()
    {
        $Assignments = Assignment::select('id','name','content')->where(['level' => Auth::user()->level,'type' => 1])->get();
        return view('student.homeworks',compact('Assignments'));

    }
    public function contact()
    {
        $teachers = Teacher::select('id','name','instagram','whatsapp')->where(['level' => Auth::user()->level])->get();
        return view('student.contact',compact('teachers'));

    }


    public function show(Assignment $assignment){
        Gate::authorize('same:assignmentLv',$assignment);


         return view('student.assignment',compact('assignment'));

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



}
