<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\AdminMiddleware;

// ─── Public Routes ────────────────────────────────────────────────────────────
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');

// ─── Articles (Public) ───────────────────────────────────────────────────────
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// ─── Auth Routes ─────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/login/google', [AuthController::class, 'loginGoogle'])->name('login.google');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::post('/register/google', [AuthController::class, 'registerGoogle'])->name('register.google');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ─── Authenticated Routes ─────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [UserController::class, 'profile'])->name('dashboard.profile');
    Route::put('/dashboard/profile', [UserController::class, 'update'])->name('dashboard.profile.update');
    Route::post('/dashboard/profile/photo', [UserController::class, 'uploadPhoto'])->name('dashboard.profile.photo');

    // ─── Admin Routes ─────────────────────────────────────────────────────────
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/dashboard/articles', [ArticleController::class, 'adminIndex'])->name('dashboard.articles');
        Route::get('/dashboard/articles/create', [ArticleController::class, 'create'])->name('dashboard.articles.create');
        Route::post('/dashboard/articles', [ArticleController::class, 'store'])->name('dashboard.articles.store');
        Route::get('/dashboard/articles/{id}/edit', [ArticleController::class, 'edit'])->name('dashboard.articles.edit');
        Route::put('/dashboard/articles/{id}', [ArticleController::class, 'update'])->name('dashboard.articles.update');
        Route::delete('/dashboard/articles/{id}', [ArticleController::class, 'destroy'])->name('dashboard.articles.destroy');

        // ─── Settings Routes ──────────────────────────────────────────────────
        Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
        Route::post('/dashboard/settings', [DashboardController::class, 'updateSettings'])->name('dashboard.settings.update');

        // ─── Board Members Routes ─────────────────────────────────────────────
        Route::get('/dashboard/board-members', [\App\Http\Controllers\BoardMemberController::class, 'index'])->name('dashboard.board-members');
        Route::get('/dashboard/board-members/create', [\App\Http\Controllers\BoardMemberController::class, 'create'])->name('dashboard.board-members.create');
        Route::post('/dashboard/board-members', [\App\Http\Controllers\BoardMemberController::class, 'store'])->name('dashboard.board-members.store');
        Route::get('/dashboard/board-members/{id}/edit', [\App\Http\Controllers\BoardMemberController::class, 'edit'])->name('dashboard.board-members.edit');
        Route::put('/dashboard/board-members/{id}', [\App\Http\Controllers\BoardMemberController::class, 'update'])->name('dashboard.board-members.update');
        Route::delete('/dashboard/board-members/{id}', [\App\Http\Controllers\BoardMemberController::class, 'destroy'])->name('dashboard.board-members.destroy');

        // ─── User Approval Routes ─────────────────────────────────────────────
        Route::get('/dashboard/approvals', [\App\Http\Controllers\DashboardController::class, 'approvals'])->name('dashboard.approvals');
        Route::post('/dashboard/approvals/{id}/approve', [\App\Http\Controllers\DashboardController::class, 'approveUser'])->name('dashboard.approvals.approve');
        Route::post('/dashboard/approvals/{id}/reject', [\App\Http\Controllers\DashboardController::class, 'rejectUser'])->name('dashboard.approvals.reject');

        // ─── Contact Message Routes ───────────────────────────────────────────
        Route::get('/dashboard/messages', [\App\Http\Controllers\DashboardController::class, 'messages'])->name('dashboard.messages');
        Route::post('/dashboard/messages/{id}/toggle-read', [\App\Http\Controllers\DashboardController::class, 'toggleReadMessage'])->name('dashboard.messages.toggle-read');
        Route::delete('/dashboard/messages/{id}', [\App\Http\Controllers\DashboardController::class, 'destroyMessage'])->name('dashboard.messages.destroy');
    });
});
