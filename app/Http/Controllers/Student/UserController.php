<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentTermRequest;
use App\Models\Homework;
use App\Models\Mark;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $homeworks = Homework::where('classroom_id',$request->user()->classroom_id)->orderBy('created_at','desc')->get();
        $marks = Mark::where('user_id',$request->user()->id)->orderBy('created_at','desc')->limit(4)->get();
        return view('student.user.index',[
            'user' => $request->user(),
            'subjects' => Subject::all(),
            'homeworks' => $homeworks,
            'marks' => $marks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, StudentTermRequest $termRequest)
    {
        // SQL : select * from `marks` where `user_id` = ? and `term` = '1'
        // SQL : select * from `subjects` where `subjects`.`id` in (1, 2, 3, 4)
        $query = Mark::query()->with('subject')->where('user_id',$request->user()->id)->where('term','1')->get();
        if($termRequest->has('term')){
            $query = Mark::query()->with('subject')->where('user_id',$request->user()->id)->where('term', $request->input('term'))->get();
        }

        return view('student.user.show',[
            'marks' => Mark::all(),
            'user_marks' => $query,
            'subjects' => Subject::all(),
            'user' => $request->user(),
            'input' => $termRequest->validated(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
