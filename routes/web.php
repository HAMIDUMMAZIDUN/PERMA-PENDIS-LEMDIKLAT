<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FaqController;
use App\Http\Middleware\AdminMiddleware;

// ─── Public Routes ────────────────────────────────────────────────────────────
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');

// ─── Articles (Public) ───────────────────────────────────────────────────────
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// ─── Gallery (Public) ────────────────────────────────────────────────────────
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/gallery/{gallery}', [GalleryController::class, 'show'])->name('gallery.show');

// ─── Events / Agenda (Public) ────────────────────────────────────────────────
Route::get('/agenda', [EventController::class, 'index'])->name('events');
Route::get('/agenda/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/agenda/calendar/data', [EventController::class, 'calendarData'])->name('events.calendar');

// ─── Downloads (Public) ──────────────────────────────────────────────────────
Route::get('/downloads', [DownloadController::class, 'index'])->name('downloads');
Route::get('/downloads/{download}/file', [DownloadController::class, 'download'])->name('downloads.file');

// ─── FAQ (Public) ────────────────────────────────────────────────────────────
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

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

        // ─── Gallery Management ───────────────────────────────────────────────
        Route::get('/dashboard/gallery', [GalleryController::class, 'adminIndex'])->name('dashboard.gallery');
        Route::get('/dashboard/gallery/create', [GalleryController::class, 'create'])->name('dashboard.gallery.create');
        Route::post('/dashboard/gallery', [GalleryController::class, 'store'])->name('dashboard.gallery.store');
        Route::get('/dashboard/gallery/{gallery}/edit', [GalleryController::class, 'edit'])->name('dashboard.gallery.edit');
        Route::put('/dashboard/gallery/{gallery}', [GalleryController::class, 'update'])->name('dashboard.gallery.update');
        Route::delete('/dashboard/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('dashboard.gallery.destroy');
        Route::delete('/dashboard/gallery/item/{galleryItem}', [GalleryController::class, 'destroyItem'])->name('dashboard.gallery.item.destroy');

        // ─── Event / Agenda Management ────────────────────────────────────────
        Route::get('/dashboard/events', [EventController::class, 'adminIndex'])->name('dashboard.events');
        Route::get('/dashboard/events/create', [EventController::class, 'create'])->name('dashboard.events.create');
        Route::post('/dashboard/events', [EventController::class, 'store'])->name('dashboard.events.store');
        Route::get('/dashboard/events/{event}/edit', [EventController::class, 'edit'])->name('dashboard.events.edit');
        Route::put('/dashboard/events/{event}', [EventController::class, 'update'])->name('dashboard.events.update');
        Route::delete('/dashboard/events/{event}', [EventController::class, 'destroy'])->name('dashboard.events.destroy');

        // ─── Download Center Management ───────────────────────────────────────
        Route::get('/dashboard/downloads', [DownloadController::class, 'adminIndex'])->name('dashboard.downloads');
        Route::get('/dashboard/downloads/create', [DownloadController::class, 'create'])->name('dashboard.downloads.create');
        Route::post('/dashboard/downloads', [DownloadController::class, 'store'])->name('dashboard.downloads.store');
        Route::get('/dashboard/downloads/{download}/edit', [DownloadController::class, 'edit'])->name('dashboard.downloads.edit');
        Route::put('/dashboard/downloads/{download}', [DownloadController::class, 'update'])->name('dashboard.downloads.update');
        Route::delete('/dashboard/downloads/{download}', [DownloadController::class, 'destroy'])->name('dashboard.downloads.destroy');
        Route::get('/dashboard/downloads/categories', [DownloadController::class, 'categories'])->name('dashboard.downloads.categories');
        Route::post('/dashboard/downloads/categories', [DownloadController::class, 'storeCategory'])->name('dashboard.downloads.categories.store');
        Route::delete('/dashboard/downloads/categories/{downloadCategory}', [DownloadController::class, 'destroyCategory'])->name('dashboard.downloads.categories.destroy');

        // ─── FAQ Management ───────────────────────────────────────────────────
        Route::get('/dashboard/faqs', [FaqController::class, 'adminIndex'])->name('dashboard.faqs');
        Route::post('/dashboard/faqs', [FaqController::class, 'store'])->name('dashboard.faqs.store');
        Route::put('/dashboard/faqs/{faq}', [FaqController::class, 'update'])->name('dashboard.faqs.update');
        Route::delete('/dashboard/faqs/{faq}', [FaqController::class, 'destroy'])->name('dashboard.faqs.destroy');
    });
});
