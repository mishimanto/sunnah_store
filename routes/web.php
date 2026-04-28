<?php

use App\Enums\UserRole;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\NewsletterController;
use App\Http\Controllers\Site\PageController;
use App\Http\Controllers\Site\PostController;
use App\Http\Controllers\Site\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', function () {
    $user = request()->user();

    if ($user && $user->hasRole(UserRole::SuperAdmin, UserRole::Admin, UserRole::Editor)) {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::redirect('/login', '/login')->name('login');

    Route::middleware('auth')->group(function (): void {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::middleware('role:'.UserRole::SuperAdmin->value.','.UserRole::Admin->value.','.UserRole::Editor->value)->group(function (): void {
            Route::resource('home-sections', HomeSectionController::class)->except(['show'])->parameters(['home-sections' => 'home_section']);
            Route::resource('categories', AdminCategoryController::class)->except(['show']);
            Route::resource('products', AdminProductController::class)->except(['show']);
            Route::resource('posts', AdminPostController::class)->except(['show']);
            Route::resource('pages', AdminPageController::class)->except(['show']);
        });

        Route::middleware('role:'.UserRole::SuperAdmin->value.','.UserRole::Admin->value)->group(function (): void {
            Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
            Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
            Route::get('/subscribers', [AdminSubscriberController::class, 'index'])->name('subscribers.index');
            Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        });

        Route::middleware('role:'.UserRole::SuperAdmin->value)->group(function (): void {
            Route::resource('users', AdminUserController::class)->except(['show']);
        });
    });
});

require __DIR__.'/auth.php';

Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');
