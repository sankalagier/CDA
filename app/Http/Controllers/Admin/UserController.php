<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SearchUserRequest;
use App\Http\Requests\Admin\UserFormRequest;
use App\Models\Classroom;
use App\Models\Mark;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SDamian\Larasort\Larasort;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchUserRequest $request)
    {
        $query = User::query();
        if($request->has('name')){
            $query = $query->where('name','like', "%{$request->input('name')}%");
        }

        return view('admin.users.index', [
            // SQL select * from `users` where `users`.`deleted_at` is null order by `users`.`created_at` desc limit 15 offset 0
            'users' => $query->with('classroom')->autosort()->paginate(15),
            'input' => $request->validated()
        ]);
    }


    // Affiche les utilisateurs supprimés
    public function bin(SearchUserRequest $request)
    {
        $query = User::query();
        if($request->has('name')){
            $query = $query->where('name','like', "%{$request->input('name')}%");
        }

        return view('admin.users.index', [
            // 'users' => User::with('classroom')->orderBy('created_at','desc')->paginate(15)
            'users' => $query->with('classroom')->onlyTrashed()->autosort()->paginate(15),
            'input' => $request->validated()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // $marks = User::with('marks') ;
        return view('admin.users.show',[
            'user' => $user,
            'marks' => Mark::with('subject')->where('user_id',$user->id)->autosort()->paginate(25),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.form', [
            'user' => $user,
            'classrooms' => Classroom::select('id','name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, User $user)
    {
        // SQL : "update `users` set `role` = ?, `users`.`updated_at` = ? where `id` = ?"
        $user->update($request->validated());
        return to_route('admin.user.index')->with('success',"L'utilisateur à bien été modifié");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // SQL : "delete from `users` where `id` = ?"
        $user->delete();
        return to_route('admin.user.index')->with('success', "L'utilisateur à bien été supprimé");
    }

    // Restaurer un utilisateur supprimé temporairement
    public function restore($id)
    {
        // SQL : "update `users` set `deleted_at` = ?, `users`.`updated_at` = ? where `id` = ?"
        User::withTrashed()->where('id',$id)->restore();
        return to_route('admin.user.bin')->with('success', "L'utilisateur à bien été restauré");
    }

    // Supprimer définitevement un utilisateur supprimé temporairement
    public function delete($id)
    {
        // SQL : "delete from `users` where `id` = ?"
        User::withTrashed()->where('id',$id)->forceDelete();

        return to_route('admin.user.bin')->with('success', "L'utilisateur à été supprimé définitivement");
    }

    // Supprimer définitevement tous les utilisateurs supprimés temporairement
    public function deleteAll(User $user)
    {
        // SQL : "delete from `users` where `users`.`deleted_at` is not null"
        User::onlyTrashed()->forceDelete();
        return to_route('admin.user.bin')->with('success', "Les utilisateurs ont été supprimés définitivement");
    }
}
