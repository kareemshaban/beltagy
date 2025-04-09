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

        Route::get('/settings_hr', [App\Http\Controllers\SettingsController::class, 'index2'])->name('settings_hr');
        Route::post('/settings_hr-store', [App\Http\Controllers\SettingsController::class, 'store2'])->name('settings_hr-store');


        Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
        Route::post('/settings-store', [App\Http\Controllers\SettingsController::class, 'store'])->name('settings-store');


        Route::get('/monthClose', [App\Http\Controllers\MonthClosingController::class, 'index'])->name('monthClose');
        Route::post('/monthClose-store', [App\Http\Controllers\MonthClosingController::class, 'store'])->name('monthClose-store');
        Route::get('/monthClose-get/{id}', [App\Http\Controllers\MonthClosingController::class, 'show'])->name('monthClose-get');
        Route::get('/monthClose-destroy/{id}', [App\Http\Controllers\MonthClosingController::class, 'destroy'])->name('monthClose-destroy');
        Route::post('/importFile', [App\Http\Controllers\ExcelController::class, 'import'])->name('importFile');



        Route::get('/attend', [App\Http\Controllers\AttendController::class, 'index'])->name('attend');
        Route::post('/attend-store', [App\Http\Controllers\AttendController::class, 'store'])->name('attend-store');
        Route::get('/attend-get/{id}', [App\Http\Controllers\AttendController::class, 'show'])->name('attend-get');
        Route::get('/attend-destroy/{id}', [App\Http\Controllers\AttendController::class, 'destroy'])->name('attend-destroy');
        Route::get('/getAttendAjax/{month}/{year}/{user_id}', [App\Http\Controllers\AttendController::class, 'getAttendAjax'])->name('getAttendAjax');




        Route::get('/departments', [App\Http\Controllers\DepartmentController::class, 'index'])->name('departments');
        Route::post('/department-store', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department-store');
        Route::get('/department-get/{id}', [App\Http\Controllers\DepartmentController::class, 'show'])->name('department-get');
        Route::get('/department-destroy/{id}', [App\Http\Controllers\DepartmentController::class, 'destroy'])->name('department-destroy');

        Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs');
        Route::post('/job-store', [App\Http\Controllers\JobController::class, 'store'])->name('job-store');
        Route::get('/job-get/{id}', [App\Http\Controllers\JobController::class, 'show'])->name('job-get');
        Route::get('/job-destroy/{id}', [App\Http\Controllers\JobController::class, 'destroy'])->name('job-destroy');

        Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients');
        Route::post('/client-store', [App\Http\Controllers\ClientController::class, 'store'])->name('client-store');
        Route::get('/client-get/{id}', [App\Http\Controllers\ClientController::class, 'show'])->name('client-get');
        Route::get('/client-destroy/{id}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('client-destroy');

        Route::get('/items', [App\Http\Controllers\ItemController::class, 'index'])->name('items');
        Route::post('/item-store', [App\Http\Controllers\ItemController::class, 'store'])->name('item-store');
        Route::get('/item-get/{id}', [App\Http\Controllers\ItemController::class, 'show'])->name('item-get');
        Route::get('/item-destroy/{id}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('item-destroy');
        Route::get('/invoiceItems/{invoice}/{type}', [App\Http\Controllers\ItemController::class, 'invoiceItems'])->name('invoiceItems');



        Route::get('/meals_enter', [App\Http\Controllers\MealsEnterController::class, 'index'])->name('meals_enter');
        Route::post('/meals_enter-store', [App\Http\Controllers\MealsEnterController::class, 'store'])->name('meals_enter-store');
        Route::get('/meals_enter-get/{id}', [App\Http\Controllers\MealsEnterController::class, 'show'])->name('meals_enter-get');
        Route::get('/meals_enter-destroy/{id}', [App\Http\Controllers\MealsEnterController::class, 'destroy'])->name('meals_enter-destroy');

        Route::get('/meals_exit', [App\Http\Controllers\MealsExitController::class, 'index'])->name('meals_exit');
        Route::post('/meals_exit-store', [App\Http\Controllers\MealsExitController::class, 'store'])->name('meals_exit-store');
        Route::get('/meals_exit-get/{id}', [App\Http\Controllers\MealsExitController::class, 'show'])->name('meals_exit-get');
        Route::get('/meals_exit-destroy/{id}', [App\Http\Controllers\MealsExitController::class, 'destroy'])->name('meals_exit-destroy');
        Route::get('/item_meals_exit/{id}', [App\Http\Controllers\MealsExitController::class, 'item_meals_exit'])->name('item_meals_exit');
        Route::get('/get_exit_meal_count/{id}', [App\Http\Controllers\MealsExitController::class, 'get_exit_meal_count'])->name('get_exit_meal_count');
        Route::get('/get_exit_meal_item/{id}', [App\Http\Controllers\MealsExitController::class, 'get_exit_meal_item'])->name('get_exit_meal_item');

        Route::get('/meals_report', [App\Http\Controllers\MealsExitController::class, 'meals_report'])->name('meals_report');
        Route::get('/item_meals/{id}', [App\Http\Controllers\ItemController::class, 'meals'])->name('meals');
        Route::get('/settings_get', [App\Http\Controllers\SettingsController::class, 'show'])->name('settings_get');
        Route::post('/payment_store', [App\Http\Controllers\PaymentController::class, 'store']) ->name('payment_store');
        Route::get('/operation_get/{id}/{type}', [App\Http\Controllers\MealsExitController::class, 'operation_get']) ->name('operation_get');


        Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
        Route::post('/user-store', [App\Http\Controllers\HomeController::class, 'store_user'])->name('user-store');
        Route::get('/user-get/{id}', [App\Http\Controllers\HomeController::class, 'get_user'])->name('user-get');
        Route::get('/user-destroy/{id}', [App\Http\Controllers\HomeController::class, 'destroy_user'])->name('user-destroy');

        Route::get('/client_Account_print/{id}', [App\Http\Controllers\MealsExitController::class, 'client_Account_print'])->name('client_Account_print');
        Route::get('/meals_report_print/{client_id}/{item_id}', [App\Http\Controllers\MealsExitController::class, 'meals_report_print'])->name('meals_report_print');
        Route::get('/meals_report_excel/{client_id}/{item_id}', [App\Http\Controllers\MealsExitController::class, 'meals_report_excel'])->name('meals_report_excel');




        Route::get('/salting_enter', [App\Http\Controllers\SaltingEnterController::class, 'index'])->name('salting_enter');
        Route::post('/salting_enter-store', [App\Http\Controllers\SaltingEnterController::class, 'store'])->name('salting_enter-store');
        Route::get('/salting_enter-get/{id}', [App\Http\Controllers\SaltingEnterController::class, 'show'])->name('salting_enter-get');
        Route::get('/salting_enter-destroy/{id}', [App\Http\Controllers\SaltingEnterController::class, 'destroy'])->name('salting_enter-destroy');

        Route::get('/salting_exit', [App\Http\Controllers\SaltingExitController::class, 'index'])->name('salting_exit');
        Route::post('/salting_exit-store', [App\Http\Controllers\SaltingExitController::class, 'store'])->name('salting_exit-store');
        Route::get('/salting_exit-get/{id}', [App\Http\Controllers\SaltingExitController::class, 'show'])->name('salting_exit-get');
        Route::get('/salting_exit-destroy/{id}', [App\Http\Controllers\SaltingExitController::class, 'destroy'])->name('salting_exit-destroy');


        Route::get('/item_salting_enters/{id}', [App\Http\Controllers\ItemController::class, 'saltings'])->name('saltings');
        Route::get('/salting_exits_enter/{id}', [App\Http\Controllers\SaltingExitController::class, 'salting_exits_enter'])->name('salting_exits_enter');
        Route::get('/get_exit_salting_count/{id}', [App\Http\Controllers\SaltingExitController::class, 'get_exit_salting_count'])->name('get_exit_salting_count');
        Route::get('/get_exit_salting_item/{id}', [App\Http\Controllers\SaltingExitController::class, 'get_exit_salting_item'])->name('get_exit_salting_item');




        Route::get('/salting_report', [App\Http\Controllers\SaltingExitController::class, 'salting_report'])->name('salting_report');
        Route::get('/salting_report_print/{client_id}/{item_id}', [App\Http\Controllers\SaltingExitController::class, 'salting_report_print'])->name('salting_report_print');
        Route::get('/salting_report_excel/{client_id}/{item_id}', [App\Http\Controllers\SaltingExitController::class, 'salting_report_excel'])->name('salting_report_excel');


        Route::get('/purchases', [App\Http\Controllers\PurchaseController::class, 'index'])->name('purchases');
        Route::post('/purchase-store', [App\Http\Controllers\PurchaseController::class, 'store'])->name('purchase-store');
        Route::get('/purchase-get', [App\Http\Controllers\PurchaseController::class, 'show'])->name('purchase-get');
        Route::get('/purchase-destroy/{id}', [App\Http\Controllers\PurchaseController::class, 'destroy'])->name('purchase-destroy');
        Route::get('/purchases-create', [App\Http\Controllers\PurchaseController::class, 'create'])->name('purchases-create');
        Route::get('/purchases-view/{id}', [App\Http\Controllers\PurchaseController::class, 'view'])->name('purchases-view');

        Route::get('/sales', [App\Http\Controllers\SalesController::class, 'index'])->name('sales');
        Route::post('/sales-store', [App\Http\Controllers\SalesController::class, 'store'])->name('sales-store');
        Route::get('/sales-get', [App\Http\Controllers\SalesController::class, 'show'])->name('sales-get');
        Route::get('/sales-destroy/{id}', [App\Http\Controllers\SalesController::class, 'destroy'])->name('sales-destroy');
        Route::get('/sales-create', [App\Http\Controllers\SalesController::class, 'create'])->name('sales-create');
        Route::get('/sales-view/{id}', [App\Http\Controllers\SalesController::class, 'view'])->name('sales-view');

        Route::get('/returnSales', [App\Http\Controllers\ReturnSalesController::class, 'index'])->name('returnSales');
        Route::post('/returnSales-store', [App\Http\Controllers\ReturnSalesController::class, 'store'])->name('returnSales-store');
        Route::get('/returnSales-get', [App\Http\Controllers\ReturnSalesController::class, 'show'])->name('returnSales-get');
        Route::get('/returnSales-destroy/{id}', [App\Http\Controllers\ReturnSalesController::class, 'destroy'])->name('returnSales-destroy');
        Route::get('/returnSales-create', [App\Http\Controllers\ReturnSalesController::class, 'create'])->name('returnSales-create');
        Route::get('/returnSales-view/{id}', [App\Http\Controllers\ReturnSalesController::class, 'view'])->name('returnSales-view');

        Route::get('/returnPurchase', [App\Http\Controllers\ReturnPurchaseController::class, 'index'])->name('returnPurchase');
        Route::post('/returnPurchase-store', [App\Http\Controllers\ReturnPurchaseController::class, 'store'])->name('returnPurchase-store');
        Route::get('/returnPurchase-get', [App\Http\Controllers\ReturnPurchaseController::class, 'show'])->name('returnPurchase-get');
        Route::get('/returnPurchase-destroy/{id}', [App\Http\Controllers\ReturnPurchaseController::class, 'destroy'])->name('returnPurchase-destroy');
        Route::get('/returnPurchase-create', [App\Http\Controllers\ReturnPurchaseController::class, 'create'])->name('returnPurchase-create');
        Route::get('/returnPurchase-view/{id}', [App\Http\Controllers\ReturnPurchaseController::class, 'view'])->name('returnPurchase-view');


        Route::get('/recipits', [App\Http\Controllers\RecipitController::class, 'index'])->name('recipits');
        Route::post('/recipits-store', [App\Http\Controllers\RecipitController::class, 'store'])->name('recipits-store');
        Route::get('/recipits-get/{id}', [App\Http\Controllers\RecipitController::class, 'show'])->name('recipits-get');
        Route::get('/recipits-destroy/{id}', [App\Http\Controllers\RecipitController::class, 'destroy'])->name('recipits-destroy');
        Route::get('/doc-get', [App\Http\Controllers\RecipitController::class, 'getDoc'])->name('doc-get');
        Route::get('/doc-view/{id}', [App\Http\Controllers\RecipitController::class, 'view'])->name('doc-view');

        Route::get('/client_account_get/{id}', [App\Http\Controllers\ClientAccountController::class, 'client_account_get'])->name('client_account_get');



        Route::get('/cathes', [App\Http\Controllers\CatchRecipitController::class, 'index'])->name('cathes');
        Route::post('/cathes-store', [App\Http\Controllers\CatchRecipitController::class, 'store'])->name('cathes-store');
        Route::get('/cathes-get/{id}', [App\Http\Controllers\CatchRecipitController::class, 'show'])->name('cathes-get');
        Route::get('/cathes-destroy/{id}', [App\Http\Controllers\CatchRecipitController::class, 'destroy'])->name('cathes-destroy');
        Route::get('/catch-get', [App\Http\Controllers\CatchRecipitController::class, 'getCatch'])->name('catch-get');
        Route::get('/catch-view/{id}', [App\Http\Controllers\CatchRecipitController::class, 'view'])->name('catch-view');





        Route::get('/paymentTypes', [App\Http\Controllers\PaymentTypeController::class, 'index'])->name('paymentTypes');
        Route::post('/paymentTypes-store', [App\Http\Controllers\PaymentTypeController::class, 'store'])->name('paymentTypes-store');
        Route::get('/paymentTypes-get/{id}', [App\Http\Controllers\PaymentTypeController::class, 'show'])->name('paymentTypes-get');
        Route::get('/paymentTypes-destroy/{id}', [App\Http\Controllers\PaymentTypeController::class, 'destroy'])->name('paymentTypes-destroy');

        Route::get('/boxRecipits', [App\Http\Controllers\BoxRecipitController::class, 'index'])->name('boxRecipits');
        Route::post('/boxRecipits-store', [App\Http\Controllers\BoxRecipitController::class, 'store'])->name('boxRecipits-store');
        Route::get('/boxRecipits-get/{id}', [App\Http\Controllers\BoxRecipitController::class, 'show'])->name('boxRecipits-get');
        Route::get('/boxRecipits-destroy/{id}', [App\Http\Controllers\BoxRecipitController::class, 'destroy'])->name('boxRecipits-destroy');
        Route::get('/BoxDoc-get', [App\Http\Controllers\BoxRecipitController::class, 'getBoxDoc'])->name('BoxDoc-get');
        Route::get('/boxDoc-view/{id}', [App\Http\Controllers\BoxRecipitController::class, 'view'])->name('boxDoc-view');


        Route::get('/safeReport', [App\Http\Controllers\ReportController::class, 'safeReport'])->name('safeReport');
        Route::post('/safeReportSearch', [App\Http\Controllers\ReportController::class, 'safeReportSearch'])->name('safeReportSearch');

        Route::get('/stockReport', [App\Http\Controllers\ReportController::class, 'stockReport'])->name('stockReport');
        Route::post('/stockReportSearch', [App\Http\Controllers\ReportController::class, 'stockReportSearch'])->name('stockReportSearch');


        Route::get('/client_Account', [App\Http\Controllers\ReportController::class, 'client_Account'])->name('client_Account');
        Route::post('/client_AccountSearch', [App\Http\Controllers\ReportController::class, 'client_AccountSearch'])->name('client_AccountSearch');



        Route::get('/safes', [App\Http\Controllers\SafeController::class, 'index'])->name('safes');
        Route::post('/safe-store', [App\Http\Controllers\SafeController::class, 'store'])->name('safe-store');
        Route::get('/safe-get/{id}', [App\Http\Controllers\SafeController::class, 'show'])->name('safe-get');
        Route::get('/safe-destroy/{id}', [App\Http\Controllers\SafeController::class, 'destroy'])->name('safe-destroy');





        Auth::routes();
    }
);



