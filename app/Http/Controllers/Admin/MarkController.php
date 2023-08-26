<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MarkFormRequest;
use App\Models\Classroom;
use App\Models\Mark;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class MarkController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user, Request $request)
    {
        return view('admin.marks.form', [
            'mark' => new Mark(),

            // SQL : "select `id`, `name` from `classrooms`"
            'classrooms' => Classroom::select('id','name')->get(),

            // SQL : "select `id`, `name` from `subjects`"
            'subjects' => Subject::select('id','name')->get(),

            // SQL : "select * from `users` where `id` = '?' limit 1"
            'users' => User::select('*')->where('id','=',$request->input('user'))->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarkFormRequest $request, User $user)
    {
        // SQL : "insert into `marks` (`user_id`, `classroom_id`, `subject_id`, `mark`, `term`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?, ?, ?)"
        $mark = Mark::create($request->validated());
        return to_route('admin.user.show', [
            'user' => $request->input('user')
        ])->with('success','La note à bien été crée');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mark $mark, Request $request)
    {
        return view('admin.marks.form',[
            'mark' => $mark,
            'classrooms' => Classroom::select('id','name')->get(),
            'subjects' => Subject::select('id','name')->get(),
            'users' => User::select('*')->where('id','=',$request->input('user'))->get(),
            'user' => $request->input('user')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarkFormRequest $request, Mark $mark)
    {
        // SQL : "update `marks` set `subject_id` = ?, `mark` = ?, `marks`.`updated_at` = ? where `id` = ?"
        $mark->update($request->validated());
        return to_route('admin.user.show',[
            'user' => $request->input('user')
        ])->with('success','La note à bien été modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mark $mark)
    {
        // SQL : "delete from `marks` where `id` = ?"
        $mark->delete();
        return to_route('admin.user.show',[
            'user' => $mark->user->id
        ])->with('success','La note à bien été supprimée');
    }
}
