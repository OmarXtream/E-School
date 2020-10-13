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
        $students = User::get();
        return view('manager.students',compact('students'));
    }

}
