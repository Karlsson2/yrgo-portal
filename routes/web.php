<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GdprConsentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Middleware\OnboardingMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




Route::get('/', [IndexController::class, "index"])->middleware([OnboardingMiddleware::class]);


Route::get('register', [RegisterController::class, "index"])->middleware("guest")->name("register");
Route::post('register', [RegisterController::class, "register"])->middleware("guest")->name("register");


Route::get('gdpr-consent', [gdprConsentController::class, 'index'])->middleware("guest")->name('gdpr-consent');

Route::get("login", [LoginController::class, "index"])->middleware("guest")->name("login");
Route::post("login", [LoginController::class, "login"])->middleware("guest");


Route::get('logout', LogoutController::class)->name("logout");


Route::get("students", [StudentsController::class, "index"])->middleware(["auth", OnboardingMiddleware::class])->name("students");
Route::get("students/search", [StudentsController::class, "searchStudentsByTechnologies"])
    ->middleware(["auth", OnboardingMiddleware::class])
    ->name("students.searchByTechnologies");
Route::get('/students/{id?}', [StudentsController::class, "studentById"])->middleware(["auth", OnboardingMiddleware::class])->name("students");


Route::get("companies", [CompaniesController::class, "index"])->middleware(["auth", OnboardingMiddleware::class])->name("companies");
Route::get("companies/search", [CompaniesController::class, "searchCompaniesByTechnologies"])
    ->middleware(["auth", OnboardingMiddleware::class])
    ->name("companies.searchByTechnologies");
Route::get('/companies/{id?}', [CompaniesController::class, "companyById"])->middleware(["auth", OnboardingMiddleware::class])->name("companies");


Route::middleware(['auth'])->group(function () {
    Route::get('onboarding', [OnboardingController::class, "index"])->name('onboarding');
    Route::post('onboarding', [OnboardingController::class, "update"])->name('onboarding');
});



Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware(["auth", OnboardingMiddleware::class])->name('edit-profile');
Route::get('/profile/likes', [ProfileController::class, 'likes'])->middleware(["auth", OnboardingMiddleware::class])->name('likes');
Route::get('/profile/{id?}', [ProfileController::class, "profile"])->middleware(["auth", OnboardingMiddleware::class])->name("profile");

Route::put('/profile/{user}', [ProfileController::class, 'update'])->middleware(["auth", OnboardingMiddleware::class])->name('update-profile');
