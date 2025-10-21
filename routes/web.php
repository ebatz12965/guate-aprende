<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ModuleController as AdminModuleController;
use App\Http\Controllers\Admin\ClassController as AdminClassController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Admin\SubmissionController as AdminSubmissionController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\LevelController as AdminLevelController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\Api\PermissionController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/cursos', [SearchController::class, 'courses'])->name('public.courses');
Route::get('/curso/{course:slug}', [SearchController::class, 'courseDetail'])->name('public.course.detail');
Route::get('/instructores', [SearchController::class, 'instructors'])->name('public.instructors');
Route::get('/instructor/{user}', [SearchController::class, 'instructorProfile'])->name('public.instructor.profile');
Route::get('/certificado/{certificate:code}', [CertificateController::class, 'show'])->name('certificate.show');

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación y Perfil
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('Admin')) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('student.courses');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Rutas de Socialite
Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| Rutas de Estudiante
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mis-cursos', [StudentController::class, 'myCourses'])->name('student.courses');
    Route::get('/cursos/{course}/estudiar', [StudentController::class, 'studyCourse'])->name('student.course.study');
    Route::post('/curso/{course}/inscribir', [EnrollmentController::class, 'enroll'])->name('student.course.enroll');
    Route::get('/tarea/{task}', [StudentController::class, 'viewTask'])->name('student.task.view');
    Route::post('/tarea/{task}', [StudentController::class, 'submitTask'])->name('student.task.submit');
    Route::get('/mis-calificaciones', [StudentController::class, 'myGrades'])->name('student.grades');
    Route::post('/clase/{class}/completar', [ProgressController::class, 'markAsComplete'])->name('student.class.complete');
    Route::get('/cuestionario/{quiz}', [StudentController::class, 'takeQuiz'])->name('student.quiz.take');
    Route::post('/cuestionario/{quiz}', [StudentController::class, 'submitQuiz'])->name('student.quiz.submit');
    Route::get('/mis-certificados', [StudentController::class, 'myCertificates'])->name('student.certificates');
});

/*
|--------------------------------------------------------------------------
| Rutas de Administración
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:Admin']], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Rutas de Gestión
    Route::resource('users', AdminUserController::class);
    Route::resource('roles', AdminRoleController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('levels', AdminLevelController::class);
    Route::get('/permissions', [PermissionController::class, 'permissions'])->name('permissions.index');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // Rutas de Contenido del Curso
    Route::resource('courses', AdminCourseController::class);
    Route::post('courses/{course}/status', [AdminCourseController::class, 'toggleStatus'])->name('courses.toggleStatus');
    Route::resource('courses.modules', AdminModuleController::class)->shallow();
    Route::resource('modules.classes', AdminClassController::class)->shallow();
    Route::resource('classes.tasks', AdminTaskController::class)->shallow();
    Route::resource('classes.quizzes', AdminQuizController::class)->shallow();
    Route::get('quizzes/{quiz}/attempts', [AdminQuizController::class, 'viewAttempts'])->name('quizzes.attempts');
    Route::resource('quizzes.questions', AdminQuestionController::class)->shallow();
    Route::resource('submissions', AdminSubmissionController::class)->only(['edit', 'update'])->shallow();

    // Rutas para Inscripciones
    Route::post('courses/{course}/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('courses/{course}/enrollments/{user}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
});
