<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\{
    AuthController,
    CandidateController,
    CategoryController,
    EmployerController,
    HomeController,
    JobAlertController,
    JobController,
    LoginController,
    PortalController,
    ProfileController,
    ResumeController,
    UserController
};

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/about', 'portal_pages.about')->name('about');
Route::view('/contact', 'portal_pages.contact')->name('contact');
Route::view('/master', 'master')->name('master');

// Public portal home page
Route::view('/', 'portal_pages.home')->name('portal.home');

/*
|--------------------------------------------------------------------------
| Portal (Candidates + Employers) Pages
|--------------------------------------------------------------------------
*/
Route::prefix('portal_pages')->group(function () {
    Route::view('/add-resume', 'portal_pages.candidates.add_resume')->name('add-resume');
    Route::view('/browse-categories', 'portal_pages.candidates.browse_categories')->name('browse-categories');
    Route::view('/browse-jobs', 'portal_pages.candidates.browse_jobs')->name('browse-jobs');
    Route::view('/job-alert', 'portal_pages.candidates.job_alert')->name('job-alert');
    Route::view('/manage-resume', 'portal_pages.candidates.manage_resume')->name('manage-resume');

    Route::view('/add-job', 'portal_pages.employers.add_job')->name('add-job');
    Route::view('/browse-resume', 'portal_pages.employers.browse_resume')->name('browse-resume');
    Route::view('/manage-application', 'portal_pages.employers.manage_application')->name('manage-application');
    Route::view('/manage-job', 'portal_pages.employers.manage_job')->name('manage-job');
    Route::view('/post-job', 'portal_pages.post_job')->name('post-job');
});

/*
|--------------------------------------------------------------------------
| Authentication & Account
|--------------------------------------------------------------------------
*/
Route::view('/my-account', 'auth.my_account')->name('my-account');
Auth::routes();

/*
|--------------------------------------------------------------------------
| Dashboards
|--------------------------------------------------------------------------
*/

// 🧩 Admin Dashboard
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
});

// 🧩 Portal Dashboard (Candidates + Employers)
Route::middleware(['auth'])->group(function () {
    Route::get('/portal', [PortalController::class, 'index'])->name('portal.dashboard');
});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

/*
|--------------------------------------------------------------------------
| Categories CRUD
|--------------------------------------------------------------------------
*/
Route::resource('categories', CategoryController::class)->except(['show']);

/*
|--------------------------------------------------------------------------
| Users CRUD
|--------------------------------------------------------------------------
*/
Route::resource('users', UserController::class)->except(['show']);

/*
|--------------------------------------------------------------------------
| Resumes CRUD
|--------------------------------------------------------------------------
*/
Route::get('/resumes', [ResumeController::class, 'index'])->name('resumes.index');
Route::get('/resumes/create', [ResumeController::class, 'create'])->name('resumes.create');
Route::post('/resumes', [ResumeController::class, 'store'])->name('resumes.store');
Route::get('/resumes/{id}', [ResumeController::class, 'show'])->name('resumes.show');
Route::get('/resumes/{id}/edit', [ResumeController::class, 'edit'])->name('resumes.edit');
Route::put('/resumes/{id}', [ResumeController::class, 'update'])->name('resumes.update');
Route::delete('/resumes/{id}', [ResumeController::class, 'destroy'])->name('resumes.destroy');

/*
|--------------------------------------------------------------------------
| Jobs CRUD
|--------------------------------------------------------------------------
*/
Route::resource('jobs', JobController::class)->except(['show']);

/*
|--------------------------------------------------------------------------
| Candidates CRUD
|--------------------------------------------------------------------------
*/
Route::resource('candidates', CandidateController::class)->except(['show']);

/*
|--------------------------------------------------------------------------
| Employers CRUD
|--------------------------------------------------------------------------
*/
Route::resource('employers', EmployerController::class)->except(['show']);

/*
|--------------------------------------------------------------------------
| Job Alerts (Requires Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::resource('job_alerts', JobAlertController::class)->except(['show']);
});
