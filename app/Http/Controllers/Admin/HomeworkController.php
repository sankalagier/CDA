<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeworkFormRequest;
use App\Models\Classroom;
use App\Models\Homework;
use App\Models\User;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // SQL : "select * from `homeworks` order by `created_at` desc limit 25 offset 0"
        return view('admin.homeworks.index', [
            'homeworks' => Homework::autosort()->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.homeworks.form', [
            'homework' => new Homework(),
            'classrooms' => Classroom::select('id','name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HomeworkFormRequest $request)
    {
        // SQL : "insert into `homework` (`classroom_id`, `title`, `content`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?)"
        $homework = Homework::create($request->validated());
        return to_route('admin.homework.index')->with('success','Le devoir à bien été crée');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Homework $homework)
    {
        return view('admin.homeworks.form',[
            'homework' => $homework,
            'classrooms' => Classroom::select('id','name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HomeworkFormRequest $request, Homework $homework)
    {
        // SQL : "update `homework` set `classroom_id` = ?, `title` = ?, `content` = ?, `updated_at` = ?"
        $homework->update($request->validated());
        return to_route('admin.homework.index')->with('success','Le devoir à bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Homework $homework)
    {
        // SQL : "delete from `homeworks` where `id` = ?"
        $homework->delete();
        return to_route('admin.homework.index')->with('success','Le devoir à bien été supprimé');
    }
}
