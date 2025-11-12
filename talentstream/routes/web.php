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
    ApplicationController,
    CandidateDashboardController,
    EmployerDashboardController,
    EmployerPackageController,
    JobBookmarkController,
    JobViewController,
    NotificationController,
    JobLocationController,
    MessageController,
    PackageController,
    PortalJobController,
    ResumePortalController,
    BrowseCategoryController,
    BrowseJobController,
    CompanyController,
    EmployerResumeController,
    PortalJobAlertsController,
    PortalResumeController,
    ManageApplicationController
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

// Approve user
Route::post('users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');

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
Route::resource('jobs', JobController::class);

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
|Company CRUD
|--------------------------------------------------------------------------
*/
Route::resource('companies', CompanyController::class);
Route::get('/companies/{company}/details', [CompanyController::class, 'getCompanyDetails'])
    ->name('companies.details');
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

/*
|--------------------------------------------------------------------------
| Job Views (Requires Auth)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::post('/jobs/{job}/view', [JobViewController::class, 'store'])->name('jobs.view');
    Route::get('/job-views', [JobViewController::class, 'index'])->name('job_views.index'); // admin
});

/*
|--------------------------------------------------------------------------
| Job Notification (Requires Auth)
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});


/*
|--------------------------------------------------------------------------
| Job location (Requires Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('job_locations', JobLocationController::class);
});
/*
|--------------------------------------------------------------------------
| Packages (Requires Auth)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('packages', PackageController::class);
});

/*
|--------------------------------------------------------------------------
| Employer Packages (Requires Auth)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('employer_packages', EmployerPackageController::class);
});


// Application 

Route::middleware('auth')->group(function () {
    Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/create/{jobId}', [ApplicationController::class, 'create'])->name('applications.create');
    Route::get('applications/{id}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');
     Route::get('/applications/manage', [ManageApplicationController::class, 'manageApplications'])
        ->name('applications.manage');

});


// message route

Route::middleware('auth')->group(function () {
    Route::get('/chat', [MessageController::class, 'index'])->name('chat.index');
    Route::get('/chat/contacts', [MessageController::class, 'getContacts']);
    Route::get('/chat/messages/{otherUserId}', [MessageController::class, 'getMessages']);
    Route::post('/chat/send', [MessageController::class, 'sendMessage']);
    Route::post('/chat/{conversation}/read', [MessageController::class, 'markAsRead']);

});

// job post route
Route::middleware(['auth', 'employer'])->group(function () {
    Route::get('/post-job', [PortalJobController::class, 'create'])->name('portal.job.create');
    Route::post('/post-job', [PortalJobController::class, 'store'])->name('portal.job.store');
     Route::get('/manage-jobs', [PortalJobController::class, 'index'])->name('manage.jobs');
});



// Resume

Route::middleware('auth')->group(function() {
    Route::get('/resume/create', [ResumePortalController::class, 'create'])->name('resume.create');
    Route::post('/resume/store', [ResumePortalController::class, 'store'])->name('resume.store');
});

// browse category
Route::middleware('auth')->group(function() {
Route::get('/browse-categories', [BrowseCategoryController::class, 'index'])->name('browse.categories');
});

Route::middleware('auth')->group(function() {

Route::get('/browse-jobs', [BrowseJobController::class, 'index'])->name('browse.jobs');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/job-alerts', [PortalJobAlertsController::class, 'index'])->name('job.alerts');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/manage-resumes', [PortalResumeController::class, 'index'])->name('manage.resumes');
});

// manage Resume

Route::middleware(['auth'])->group(function () {
    Route::get('/browse-resumes', [EmployerResumeController::class, 'index'])->name('browse.resumes');
    Route::get('/browse-resumes/{id}', [EmployerResumeController::class, 'show'])->name('browse.resumes.show');
});

