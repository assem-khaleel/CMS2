<?php

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Spatie\Newsletter\Newsletter;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::put('/subscribe',function () {
    $email = request('email');
    Newsletter::subscribe($email);
    Session::flash('subscribed','Successfully subscribed.');
    return redirect()->back();
});

Route::get('/',[\App\Http\Controllers\FrontEndController::class,'index'])->name('index');

Route::get('/test',function () {
    return \App\Models\Profile::find(1)->user;
});
Route::get('/results',function () {
    $posts = \App\Models\Post::where('title','like','%'.request('query').'%')->get();
    return view('results')->with('posts',$posts)
        ->with('title','Search results: ' . request('query'))
        ->with('settings',Setting::first())
        ->with('categories',Category::take(5)->get())
        ->with('query',request('query'));
});

Auth::routes();
Route::group(['prefix' => 'admin','middleware'=> 'auth'],function (){
Route::get('/posts',[\App\Http\Controllers\PostController::class,'index'])->name('posts');
Route::get('/posts/trashed',[\App\Http\Controllers\PostController::class,'trashed'])->name('posts.trashed');
Route::get('/post/kill/{id}',[\App\Http\Controllers\PostController::class,'kill'])->name('post.kill');
Route::get('/post/restore/{id}',[\App\Http\Controllers\PostController::class,'restore'])->name('post.restore');
Route::get('/post/create',[\App\Http\Controllers\PostController::class,'create'])->name('post.create');
Route::get('/post/edit/{id}',[\App\Http\Controllers\PostController::class,'edit'])->name('post.edit');
Route::post('/post/update/{id}',[\App\Http\Controllers\PostController::class,'update'])->name('post.update');
Route::post('/post/store',[\App\Http\Controllers\PostController::class,'store'])->name('post.store');
Route::get('/post/delete/{id}',[\App\Http\Controllers\PostController::class,'destroy'])->name('post.delete');
Route::get('/category/create',[\App\Http\Controllers\CategoriesController::class,'create'])->name('category.create');
Route::post('/category/store',[\App\Http\Controllers\CategoriesController::class,'store'])->name('category.store');
Route::get('/categories',[\App\Http\Controllers\CategoriesController::class,'index'])->name('categories');
Route::get('/category/edit/{id}',[\App\Http\Controllers\CategoriesController::class,'edit'])->name('category.edit');
Route::get('/category/delete/{id}',[\App\Http\Controllers\CategoriesController::class,'destroy'])->name('category.delete');
Route::post('/category/update/{id}',[\App\Http\Controllers\CategoriesController::class,'update'])->name('category.update');
Route::resource('/tag',\App\Http\Controllers\TagsController::class);
Route::get('/users',[\App\Http\Controllers\UsersController::class,'index'])->name('users');
Route::get('/user/create',[\App\Http\Controllers\UsersController::class,'create'])->name('user.create');
Route::post('/user/store',[\App\Http\Controllers\UsersController::class,'store'])->name('user.store');
Route::get('/user/admin/{id}',[\App\Http\Controllers\UsersController::class,'admin'])->name('user.admin')->middleware('admin');
Route::get('/user/normal/{id}',[\App\Http\Controllers\UsersController::class,'notAdmin'])->name('user.normal');
Route::get('/user/profile',[\App\Http\Controllers\ProfilesController::class,'index'])->name('user.profile');
Route::post('/user/profile/update',[\App\Http\Controllers\ProfilesController::class,'update'])->name('user.profile.update');
Route::get('/user/delete/{id}',[\App\Http\Controllers\UsersController::class,'destroy'])->name('user.delete');
Route::get('/settings',[\App\Http\Controllers\SettingsController::class,'index'])->name('settings')->middleware('admin');
Route::post('/settings/update',[\App\Http\Controllers\SettingsController::class,'update'])->name('settings.update')->middleware('admin');
Route::get('/post/{slug}',[\App\Http\Controllers\FrontEndController::class,'singlePost'])->name('post.single');
Route::get('/category/{id}',[\App\Http\Controllers\FrontEndController::class,'category'])->name('category.single');
Route::get('/tag/{id}',[\App\Http\Controllers\FrontEndController::class,'tag'])->name('tag.single');

});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


