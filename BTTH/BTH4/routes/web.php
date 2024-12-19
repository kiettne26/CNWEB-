<?php

use App\Http\Controllers\IssueController;
use Illuminate\Support\Facades\Route;

//index
Route::get('/', [IssueController::class, 'index'])->name('issues.index');

//hiển thị form thêm mới
Route::get('/issues/create', [IssueController::class, 'create'])->name('issues.create');

// lưu dữ liệu
Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');

// hiển thị form chỉnh sửa
Route::get('/issues/{id}/edit',[IssueController::class, 'edit'])->name('issues.edit');

// chỉnh sửa
Route::put('/issues/{id}',[IssueController::class, 'update'])->name('issues.update');

// xóa
Route::delete('/issues/{id}',[IssueController::class, 'destroy'])->name('issues.destroy');