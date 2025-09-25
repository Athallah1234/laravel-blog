<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\EbookController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ContactMessageController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::post('/contact/send', [FrontController::class, 'sendContact'])->name('contact.send');
Route::get('/post/{slug}', [FrontController::class, 'show'])->name('post.show');
Route::get('/archives', [FrontController::class, 'archives'])->name('archives.index');
Route::get('/archive/{year}/{month}', [FrontController::class, 'archive'])->name('archive.show');
Route::get('/categories', [FrontController::class, 'categories'])->name('categories.index');
Route::get('/category/{slug}', [FrontController::class, 'category'])->name('category.show');
Route::get('/tags', [FrontController::class, 'tags'])->name('tags.index');
Route::get('/tag/{slug}', [FrontController::class, 'tag'])->name('tag.show');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:user,admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('dashboard');
        Route::get('/settings', [IndexController::class, 'settings'])->name('dashboard.settings');
        // Users
        Route::get('/users', [UserController::class, 'index'])->name('dashboard.users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('dashboard.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('dashboard.users.store');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('dashboard.users.show');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('dashboard.users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('dashboard.users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('dashboard.users.destroy');
        // Categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('dashboard.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('dashboard.categories.store');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('dashboard.categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('dashboard.categories.destroy');
        // Tags
        Route::get('/tags', [TagController::class, 'index'])->name('dashboard.tags.index');
        Route::get('/tags/create', [TagController::class, 'create'])->name('dashboard.tags.create');
        Route::post('/tags', [TagController::class, 'store'])->name('dashboard.tags.store');
        Route::get('/tags/{id}/edit', [TagController::class, 'edit'])->name('dashboard.tags.edit');
        Route::put('/tags/{id}', [TagController::class, 'update'])->name('dashboard.tags.update');
        Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('dashboard.tags.destroy');
        // Posts
        Route::get('/posts', [PostController::class, 'index'])->name('dashboard.posts.index');
        Route::get('/posts/create', [PostController::class, 'create'])->name('dashboard.posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('dashboard.posts.store');
        Route::get('/posts/{id}', [PostController::class, 'show'])->name('dashboard.posts.show');
        Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('dashboard.posts.edit');
        Route::put('/posts/{id}', [PostController::class, 'update'])->name('dashboard.posts.update');
        Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('dashboard.posts.destroy');
        // Ebook-Source Codes
        Route::get('/ebooks', [EbookController::class, 'index'])->name('dashboard.ebooks.index');
        Route::get('/ebooks/create', [EbookController::class, 'create'])->name('dashboard.ebooks.create');
        Route::post('/ebooks', [EbookController::class, 'store'])->name('dashboard.ebooks.store');
        Route::get('/ebooks/{id}', [EbookController::class, 'show'])->name('dashboard.ebooks.show');
        Route::get('/ebooks/{id}/edit', [EbookController::class, 'edit'])->name('dashboard.ebooks.edit');
        Route::put('/ebooks/{id}', [EbookController::class, 'update'])->name('dashboard.ebooks.update');
        Route::delete('/ebooks/{id}', [EbookController::class, 'destroy'])->name('dashboard.ebooks.destroy');
        // Logs
        Route::get('/logs', [IndexController::class, 'logs'])->name('dashboard.logs');
        // Contacts
        Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('dashboard.contact-messages.index');
        Route::get('/contact-messages/{id}', [ContactMessageController::class, 'show'])->name('dashboard.contact-messages.show');
        Route::patch('contact-messages/{id}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('dashboard.contact-messages.markAsRead');
    });
});

