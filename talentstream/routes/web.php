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
    UserController,
    AdminDashboardController,
    CandidateDashboardController,
    EmployerDashboardController,
    JobBookmarkController

};

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

// ✅ Public pages
Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/about', 'portal_pages.about')->name('about');
Route::view('/contact', 'portal_pages.contact')->name('contact');

// ✅ Portal homepage now handled by PortalController
Route::get('/', [PortalController::class, 'index'])->name('portal.home');
Route::view('/master', 'master')->name('master');

/*
|--------------------------------------------------------------------------
| Portal (Candidates + Employers) Pages
|--------------------------------------------------------------------------
*/
Route::prefix('portal_pages')->group(function () {
    // Candidate Views
    Route::view('/add-resume', 'portal_pages.candidates.add_resume')->name('add-resume');
    Route::view('/browse-categories', 'portal_pages.candidates.browse_categories')->name('browse-categories');
    Route::view('/browse-jobs', 'portal_pages.candidates.browse_jobs')->name('browse-jobs');
    Route::view('/job-alert', 'portal_pages.candidates.job_alert')->name('job-alert');
    Route::view('/manage-resume', 'portal_pages.candidates.manage_resume')->name('manage-resume');

    // Employer Views
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
| Dashboards (Role Protected)
|--------------------------------------------------------------------------
*/

//  Admin Dashboard 
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

// Candidate Dashboard 
Route::middleware(['auth', 'candidate'])->group(function () {
    Route::get('/candidate/dashboard', [CandidateDashboardController::class, 'index'])->name('candidate.dashboard');
});

//  Employer Dashboard 
Route::middleware(['auth', 'employer'])->group(function () {
    Route::get('/employer/dashboard', [EmployerDashboardController::class, 'index'])->name('employer.dashboard');
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
Route::resource('resumes', ResumeController::class);

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

/*
|--------------------------------------------------------------------------
| Job Bookmark (Requires Auth)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/bookmarks', [JobBookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{jobId}', [JobBookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/bookmarks/{id}', [JobBookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});