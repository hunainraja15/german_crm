<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewJobController;
use App\Http\Controllers\VisaController;



Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('user.logout');


    Route::get('/list-user', [App\Http\Controllers\UserController::class, 'index'])->name('list_user');
    Route::post('/save-user', [App\Http\Controllers\UserController::class, 'save'])->name('save.user');
    Route::post('/update-user', [App\Http\Controllers\UserController::class, 'update'])->name('update.user');
    Route::post('/user-status-update', [App\Http\Controllers\UserController::class, 'status_update'])->name('user.status.update');
    Route::get('/user-delete/{user}', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
    Route::post('/user/role/update', [App\Http\Controllers\UserController::class, 'role_update'])->name('user.role.update');
    
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/create', [ProfileController::class, 'create'])->name('profile.create');
        Route::get('/edit/{profile}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/update/{profile}', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/view/{profile?}', [ProfileController::class, 'view'])->name('profile.view');
        Route::post('/store', [ProfileController::class, 'store'])->name('profile.store');
        Route::get('/delete/{profile}', [ProfileController::class, 'delete'])->name('profile.delete');
        Route::post('/status/update', [ProfileController::class, 'status_update'])->name('profile.status.update');
        Route::get('/employee', [ProfileController::class, 'profile_employee'])->name('profile.employee');
    });
   
   
    Route::prefix('job')->group(function () {
        Route::get('/', [NewJobController::class, 'index'])->name('job.index');
        Route::get('/create', [NewJobController::class, 'create'])->name('job.create');
        Route::post('/store', [NewJobController::class, 'store'])->name('job.store');
        Route::get('/view/{job}', [NewJobController::class, 'show'])->name('job.view');
        Route::get('/edit/{job}', [NewJobController::class, 'edit'])->name('job.edit');
        Route::post('/update/{job}', [NewJobController::class, 'update'])->name('job.update');
        Route::get('/delete/{job}', [NewJobController::class, 'destroy'])->name('job.delete');

        
        Route::get('/apply/{job?}', [NewJobController::class, 'apply'])->name('job.apply');
        Route::get('/view', [NewJobController::class, 'view'])->name('job.view');

        Route::get('/application', [NewJobController::class, 'application'])->name('job.application');
        Route::post('/application/submit', [NewJobController::class, 'application_submit'])->name('job.application.submit');
        Route::post('/application/status/update', [NewJobController::class, 'updateStatus'])->name('application.status.update');
        Route::get('/active', [NewJobController::class, 'active'])->name('job.active');


        Route::post('/interview/store', [NewJobController::class, 'interview_store'])->name('job.interview.store');
        Route::get('/interview', [NewJobController::class, 'job_interview'])->name('job.interview');
        Route::post('/interview/status', [NewJobController::class, 'interview_status'])->name('job.interview.status');
        Route::get('/job/signature/update/{interview}', [NewJobController::class, 'signature_update'])->name('job.signature.update');
        Route::post('/signature/file/{interview}', [NewJobController::class, 'signature_file'])->name('job.signature.file');
        
        
        Route::get('/offer/creation', [NewJobController::class, 'offer_creation'])->name('job.offer.creation');
        Route::post('/offer/update', [NewJobController::class, 'offer_update'])->name('job.offer.update');
        Route::get('/interview/pdf/{interview}', [NewJobController::class, 'interview_pdf'])->name('interview.pdf');
        
    });
    
    
    Route::prefix('visa')->group(function () {
    
        Route::get('/', [VisaController::class, 'index'])->name('visa.index');
        Route::get('/apply', [VisaController::class, 'apply'])->name('visa.apply');
        Route::get('/submit/{id}', [VisaController::class, 'submit'])->name('visa.submit');
        Route::post('/applicastion', [VisaController::class, 'applicastion'])->name('visa.applicastion');
    
    });
});


















