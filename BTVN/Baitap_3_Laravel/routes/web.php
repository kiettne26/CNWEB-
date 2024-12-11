<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Hiển thị trang chủ với danh sách bài viết
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// Hiển thị biểu mẫu thêm bài viết
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// Thêm bài viết mới vào cơ sở dữ liệu
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Hiển thị chi tiết một bài viết
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Hiển thị biểu mẫu chỉnh sửa bài viết
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

// Cập nhật bài viết
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

// Xóa bài viết
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
