<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassroomFormRequest;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // SQL : "select * from `classrooms` order by `created_at` desc limit 25 offset 0"
        return view('admin.classrooms.index', [
            'classrooms' => Classroom::orderBy('created_at','desc')->paginate(12)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.classrooms.form', [
            'classroom' => new Classroom()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomFormRequest $request)
    {
        // SQL : "insert into `classrooms` (`name`, `updated_at`, `created_at`) values (?, ?, ?)"
        $classroom = Classroom::create($request->validated());
        return to_route('admin.classroom.index')->with('success','La classe à bien été créee');
    }

    public function show(Classroom $classroom, Request $request)
    {
        // $marks = User::with('marks') ;
        return view('admin.classrooms.show',[
            // 'classrooms' => Classroom::select('*')->where('id','=',$request->input('classroom'))->get(),
            'classroom' => $classroom,
            'users' => User::with('classroom')->where('classroom_id',$classroom->id)->autosort()->paginate(35),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        return view('admin.classrooms.form',[
            'classroom' => $classroom
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomFormRequest $request, Classroom $classroom)
    {
        // SQL : "update `classrooms` set `name` = ?, `classrooms`.`updated_at` = ? where `id` = ?"
        $classroom->update($request->validated());
        return to_route('admin.classroom.index')->with('success','La classe à bien été modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        // SQL : "delete from `classrooms` where `id` = ?"
        $classroom->delete();
        return to_route('admin.classroom.index')->with('success','La classe à bien été supprimée');
    }
}
