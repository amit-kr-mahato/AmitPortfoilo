<?php

use App\Http\Controllers\Inbox;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AboutmeController;
use App\Http\Controllers\Admin\QualificationController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🏠 FRONTEND HOME
Route::get('/', HomeController::class)->name('home');


// 📧 CONTACT FORM (IMPORTANT FIX: must be outside admin middleware)
Route::post('/contact', [Inbox::class, 'submit'])->name('contact');


// 🔐 ADMIN PANEL
Route::prefix('admin')
    ->middleware(['auth', 'isAdmin'])
    ->as('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', [AdminController::class, 'index'])->name('index');

        // Qualifications
        Route::get('/qualification/education', [QualificationController::class, 'showEducation'])->name('qualification.edu');
        Route::get('/qualification/experience', [QualificationController::class, 'showExperience'])->name('qualification.exp');
        Route::resource('/qualification', QualificationController::class);

        // Modules
        Route::resource('/skill', SkillController::class);
        Route::resource('/service', ServiceController::class);
        Route::resource('/review', ReviewController::class);
        Route::resource('/category', CategoryController::class);

        // Portfolio
        Route::get('/portfolio/search', [PortfolioController::class, 'search'])->name('portfolio.search');
        Route::resource('/portfolio', PortfolioController::class);

        // About Me
        Route::prefix('/aboutme')->controller(AboutmeController::class)->group(function () {
            Route::get('/', 'index')->name('aboutme.index');
            Route::put('/{user}', 'update')->name('aboutme.update');
        });

        // Settings
        Route::resource('/setting', SettingController::class);

        // 📧 EMAIL MANAGEMENT (FIXED + CLEAN)
        Route::controller(ContactController::class)->group(function () {
            Route::get('/email', 'index')->name('email.index');
            Route::get('/email/{id}', 'show')->name('email.show');
            Route::delete('/email/{id}', 'destroy')->name('email.destroy');
            Route::post('/email/reply/{id}', 'reply')->name('email.reply');
        });

    });


// 🔐 AUTH ROUTES
Auth::routes();