<?php

use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\HomeworkController;
use App\Http\Controllers\Admin\MarkController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\UserController as StudentUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $user = Auth::user();
    if($user?->role == "student"){
        return to_route('student.index');
    };

    if($user?->role == "admin"){
        return to_route('admin.user.index');
    };

    return view('accueil');
})->name('index');

Route::get('/contact', function (){
    if(Auth::user()?->role === 'admin'){
        return to_route('admin.user.index');
    }

    return view('contact');
})->name('contact');

Route::get('/mentions-legales', function (){
    if(Auth::user()?->role === 'admin'){
        return to_route('admin.user.index');
    }

    return view('mentions');
})->name('mentions-legales');

Route::post('/contact/send', [ContactController::class, 'contact'])->name('contact.send');

Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function(){
    Route::get('user/deleted', [UserController::class, 'bin'])->name('user.bin');
    Route::get('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
    Route::delete('user/delete/{id}', [UserController::class, 'delete'])->name('user.forcedelete');
    Route::delete('user/delete', [UserController::class, 'deleteAll'])->name('user.deleteAll');
    Route::resource('user', UserController::class)->except(['create','store']);
    Route::resource('subject', SubjectController::class)->except(['show']);
    Route::resource('mark', MarkController::class)->except(['show','index']);
    Route::resource('homework', HomeworkController::class)->except(['show']);
    Route::resource('classroom', ClassroomController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/student', [StudentUserController::class, 'index'])->middleware('role:student')->name('student.index');
    Route::get('/student/details', [StudentUserController::class, 'show'])->middleware('role:student')->name('student.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
