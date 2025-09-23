<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\LevelController as AdminLevelController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Instructor\AnalyticsController;
use App\Http\Controllers\Instructor\StudentController as InstructorStudentController;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

#Route::get('/', function () {
 #   return view('welcome');
#});

//Ruta después del login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Rutas de ProfileController
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Rutas de Auth de SocialiteController
Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

// Rutas públicas
Route::get('/cursos', [SearchController::class, 'courses'])->name('public.courses');
Route::get('/curso/{course:slug}', [SearchController::class, 'courseDetail'])->name('public.course.detail');
Route::get('/categorias', [SearchController::class, 'categories'])->name('public.categories');
Route::get('/categoria/{category:slug}', [SearchController::class, 'categoryDetail'])->name('public.category.detail');
Route::get('/instructores', [SearchController::class, 'instructors'])->name('public.instructors');
Route::get('/instructor/{user}', [SearchController::class, 'instructorProfile'])->name('public.instructor.profile');
