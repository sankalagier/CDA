<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubjectFormRequest;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // SQL : "select * from `subjects` order by `created_at` desc limit 25 offset 0"
        return view('admin.subjects.index', [
            'subjects' => Subject::orderBy('created_at','desc')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subjects.form', [
            'subject' => new Subject()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectFormRequest $request)
    {
        // SQL :  "insert into `subjects` (`name`, `updated_at`, `created_at`) values (?, ?, ?)"
        $subject = Subject::create($request->validated());
        return to_route('admin.subject.index')->with('success','La matière à bien été créee');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('admin.subjects.form',[
            'subject' => $subject
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectFormRequest $request, Subject $subject)
    {
        // SQL : "update `subjects` set `name` = ?, `subjects`.`updated_at` = ? where `id` = ?"
        $subject->update($request->validated());
        return to_route('admin.subject.index')->with('success','La matière à bien été modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return to_route('admin.subject.index')->with('success','La matière à bien été supprimée');
    }
}
