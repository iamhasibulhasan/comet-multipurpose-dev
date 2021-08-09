<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Frontend Routes
Route::get('blog', [App\Http\Controllers\BlogPageController::class, 'showBlogPage']);
//Blog Post Search
Route::post('blog', [App\Http\Controllers\BlogPageController::class, 'blogSearch'])->name('post.search');
Route::get('blog/category/{slug}', [App\Http\Controllers\BlogPageController::class, 'blogSearchByCat'])->name('post.cat.search');
Route::get('blog/{slug}', [App\Http\Controllers\BlogPageController::class, 'blogSingle'])->name('post.single');
Route::get('blog/tag/{slug}', [App\Http\Controllers\BlogPageController::class, 'blogSearchByTag'])->name('post.tag.search');



//Backend Routes
/**
 * Admin Routes Here
 */
Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'showAdminLoginForm'])->name('admin.login');
Route::get('/admin/register', [App\Http\Controllers\AdminController::class, 'showAdminRegisterForm'])->name('admin.register');

Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('admin.logout');
Route::post('/admin/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('admin.register');



//Blog Post Comments Route
Route::post('blog-post-comments', [App\Http\Controllers\CommentController::class, 'postComment'])->name('blog.post.comment');
Route::post('blog-post-reply', [App\Http\Controllers\CommentController::class, 'blogCommentReply'])->name('blog.post.reply');
/**
 * Auth Route[Middleware]
 * when admin login then access these pages
 */

Route::group(['middleware' => 'auth'], function(){

    //    Admin Dashboard Access
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'showAdminDashboard'])->name('admin.dashboard');


    //Post Route
    Route::resource('post', 'App\Http\Controllers\PostController');
    Route::get('post/status/active/{id}', 'App\Http\Controllers\PostController@postStatusActive');
    Route::get('post/status/inactive/{id}', 'App\Http\Controllers\PostController@postStatusInactive');
    Route::get('post-trash', 'App\Http\Controllers\PostController@postTrash')->name('post.trash');
    Route::get('post-trash-update/{id}', 'App\Http\Controllers\PostController@postTrashUpdate')->name('post.trash.update');

    //Post Category Route
    Route::resource('category', 'App\Http\Controllers\CategoryController');
    Route::get('category/status/active/{id}', 'App\Http\Controllers\CategoryController@categoryStatusActive');
    Route::get('category/status/inactive/{id}', 'App\Http\Controllers\CategoryController@categoryStatusInactive');


    //Post Tag Route
    Route::resource('tag', 'App\Http\Controllers\TagController');
    Route::get('tag/status/active/{id}', 'App\Http\Controllers\TagController@tagStatusActive');
    Route::get('tag/status/inactive/{id}', 'App\Http\Controllers\TagController@tagStatusInactive');

});


