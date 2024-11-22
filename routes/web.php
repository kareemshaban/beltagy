<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

        Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
        Route::post('/employee-store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee-store');
        Route::get('/employee-get/{id}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employee-get');
        Route::get('/employee-destroy/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee-destroy');


        Route::get('/deductionAndBonse', [App\Http\Controllers\DeductionAndBonseController::class, 'index'])->name('deductionAndBonse');
        Route::post('/deductionAndBonse-store', [App\Http\Controllers\DeductionAndBonseController::class, 'store'])->name('deductionAndBonse-store');
        Route::get('/deductionAndBonse-get/{id}', [App\Http\Controllers\DeductionAndBonseController::class, 'show'])->name('deductionAndBonse-get');
        Route::get('/deductionAndBonse-destroy/{id}', [App\Http\Controllers\DeductionAndBonseController::class, 'destroy'])->name('deductionAndBonse-destroy');


        Route::get('/financialDeductionAndBonse', [App\Http\Controllers\RewardController::class, 'index'])->name('financialDeductionAndBonse');
        Route::post('/financialDeductionAndBonse-store', [App\Http\Controllers\RewardController::class, 'store'])->name('financialDeductionAndBonse-store');
        Route::get('/financialDeductionAndBonse-get/{id}', [App\Http\Controllers\RewardController::class, 'show'])->name('financialDeductionAndBonse-get');
        Route::get('/financialDeductionAndBonse-destroy/{id}', [App\Http\Controllers\RewardController::class, 'destroy'])->name('financialDeductionAndBonse-destroy');

        Route::get('/advances', [App\Http\Controllers\AdvanceController::class, 'index'])->name('advances');
        Route::post('/advances-store', [App\Http\Controllers\AdvanceController::class, 'store'])->name('advances-store');
        Route::get('/advances-get/{id}', [App\Http\Controllers\AdvanceController::class, 'show'])->name('advances-get');
        Route::get('/advances-destroy/{id}', [App\Http\Controllers\AdvanceController::class, 'destroy'])->name('advances-destroy');

        Auth::routes();
    }
);



