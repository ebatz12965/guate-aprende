<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Api\PermissionController;
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
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\LevelController as AdminLevelController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Instructor\AnalyticsController;
use App\Http\Controllers\Instructor\StudentController as InstructorStudentController;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

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

#Route::get('/', function () {
 #   return Inertia::render('Welcome', [
  #      'canLogin' => Route::has('login'),
   #     'canRegister' => Route::has('register'),
    #    'laravelVersion' => Application::VERSION,
     #   'phpVersion' => PHP_VERSION,
    #]);
#})->name('home');

// Rutas públicas
Route::get('/cursos', [SearchController::class, 'courses'])->name('public.courses');
Route::get('/curso/{course:slug}', [SearchController::class, 'courseDetail'])->name('public.course.detail');
Route::get('/categorias', [SearchController::class, 'categories'])->name('public.categories');
Route::get('/categoria/{category:slug}', [SearchController::class, 'categoryDetail'])->name('public.category.detail');
Route::get('/instructores', [SearchController::class, 'instructors'])->name('public.instructors');
Route::get('/instructor/{user}', [SearchController::class, 'instructorProfile'])->name('public.instructor.profile');

Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

Route::get('/roles', [AdminRoleController::class, 'index'])->name('admin.roles.index');
Route::delete('/roles/{role}', [AdminRoleController::class, 'destroy'])->name('admin.roles.destroy');

Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses.index');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');

Route::get('/modules', [ModuleController::class, 'index'])->name('admin.modules.index');
Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('admin.modules.destroy');

Route::get('/classes', [ClassController::class, 'index'])->name('admin.classes.index');
Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('admin.classes.destroy');

Route::get('/permissions', [PermissionController::class, 'permissions'])->name('admin.permissions.index');
Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');

Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
