<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/old', function () {
//     return view('welcome');
// });

Auth::routes();

// Admin Routes
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect(route('admin.dashboard'));
    });
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('/posts', App\Http\Controllers\Admin\PostController::class);
    Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/tags', App\Http\Controllers\Admin\TagController::class);
    Route::get('/comments', [App\Http\Controllers\Admin\CommentController::class, 'index'])->name('comments.index');
    Route::get('/comments/{commentID}/edit', [App\Http\Controllers\Admin\CommentController::class, 'edit'])->name('comments.edit');
    Route::match(['put', 'patch'], '/comments/{commentID}', [App\Http\Controllers\Admin\CommentController::class, 'update'])->name('comments.update');
    Route::post('/comments/reply/{commentID}', [App\Http\Controllers\Admin\CommentController::class, 'reply'])->name('comments.reply');
    Route::post('/comments/approve/{commentID}', [App\Http\Controllers\Admin\CommentController::class, 'approve'])->name('comments.approve');
    Route::post('/comments/unapprove/{commentID}', [App\Http\Controllers\Admin\CommentController::class, 'unapprove'])->name('comments.unapprove');
    Route::delete('/comments/{commentID}', [App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('comments.destroy');
    Route::resource('/pages', App\Http\Controllers\Admin\PageController::class);
    Route::resource('/menus', App\Http\Controllers\Admin\MenuController::class);
    Route::resource('/banner', App\Http\Controllers\Admin\BannerController::class);
    Route::post('/order/menu', [App\Http\Controllers\Admin\MenuController::class, 'order'])->name('menus.order');
    Route::resource('/users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('/administrators', App\Http\Controllers\Admin\AdministratorController::class);
    Route::resource('/roles', App\Http\Controllers\Admin\RoleController::class);
    Route::resource('/permissions', App\Http\Controllers\Admin\PermissionController::class);
    Route::post('/profile/edit', [App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('settings.profile');
    Route::post('/change/password', [App\Http\Controllers\Admin\AdminController::class, 'change'])->name('settings.change');
    Route::get('/settings', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('settings.update');
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Site Routes
Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('homepage');
Route::post('/search', [App\Http\Controllers\SiteController::class, 'search'])->name('search');
Route::get('/contact', [App\Http\Controllers\SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\SiteController::class, 'postContact'])->name('postContact');
Route::get('/tag/{tag}', [App\Http\Controllers\SiteController::class, 'tag'])->name('tag');
Route::get('/pages/{page}', [App\Http\Controllers\SiteController::class, 'page'])->name('page');
Route::post('/post/comment', [App\Http\Controllers\SiteController::class, 'postComment'])->name('postComment');
Route::get('/post/{post}', [App\Http\Controllers\SiteController::class, 'singlePost'])->name('singlePost');
Route::get('/author/{author}', [App\Http\Controllers\SiteController::class, 'author'])->name('author');
Route::get('/cr/{carousel}', [App\Http\Controllers\SiteController::class, 'carousel'])->name('carousel');
Route::get('/{category}', [App\Http\Controllers\SiteController::class, 'category'])->name('category');
