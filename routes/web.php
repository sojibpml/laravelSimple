<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth'])->group(function () {

//     Route::middleware(['role:admin'])->group(function () {
//         Route::get('/users', [UserController::class, 'index'])->name('users.index');
//         Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//         Route::post('users', [UserController::class, 'store'])->name('users.store');
//         Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//     });
//     Route::middleware(['role:admin|editor'])->group(function () {
//         Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
//         Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
//     });
// });




Route::get('/assign-admin', [AuthController::class, 'assignAdminRole']);
Route::get('/assign-roles/{id}', [AuthController::class, 'index'])->name('show.assign.roles');
Route::get("/show", [AuthController::class, "showAdmin"]);


//এলকোয়েন্ট //.  Eloquent problem N + 1;
use App\Models\User;
Route::get('/n1', function () {
    $users = User::all();
    foreach ($users as $user) {
        echo $user->name . "has" . $user->posts()->count() . "posts <br>";
    }
});


Route::get('/n1-optimized', function () {
    $users = User::with('posts')->get();

    foreach ($users as $user) {
        echo $user->name . "has" . $user->posts()->count() . "Posts <br>";
    }
});

use App\Models\Comment;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Post;


Route::get('/poly-add', function () {
    $post = Post::create(['title' => 'First Post', 'body' => 'Post content', 'user_id' => 1]);
    $video = Video::create(['title' => 'First video', 'url' => "http://example.com/video.mp4"]);
    $photo = Photo::create(['title' => 'First photo', 'path' => 'photo.jpg']);

    $post->comments()->create(['body' => 'nice post']);
    $video->comments()->create(['body' => 'Awesome video!']);
    $photo->comments()->create(['body' => 'Beautiful photo!']);
    return "✅ Demo data added.";
});

Route::get('/poly-show', function () {
    $comments = Comment::all();

    foreach ($comments as $comment) {
        echo "Comment : {$comment->body} <br>";
        echo "On: " . class_basename($comment->commentable_type) . " (ID: {$comment->commentable_id})<br><br>";
    }
});