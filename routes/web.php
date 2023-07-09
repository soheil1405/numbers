<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingControler;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FielsOfStudiesController;
use App\Http\Controllers\HomeLandController;

use App\Http\Controllers\NamesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\user_searches;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\IsUser;
use App\Http\Middleware\notLogin;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;








Route::get('/', [HomeLandController::class, 'home'])->name('home');


Route::get('/test', function () {

    $url = url('public/main/fonts/ttf/');


    dd($url);
});
Route::prefix('/Auth')

    ->name('auth.')
    ->middleware(notLogin::class)
    ->group(function () {



        Route::get('EnterLoginCode', [LoginController::class, 'EnterLoginCodePage'])->name('EnterLoginCodePage');
        Route::get('/register', [RegisterController::class, 'gotoRegisterPage'])->name('RegisterPage');
        Route::get('/login', [LoginController::class, 'gotoLoginPage'])->name('LoginPage');
        Route::post('/register/save', [RegisterController::class, 'register'])->name('register');
        Route::post('/login/save', [LoginController::class, 'login'])->name('login');

        Route::post('/submitLoginCode', [LoginController::class, 'EnterLoginCode'])->name('EnterResetPassCode');
    });

Route::get('/logout', [LoginController::class, 'logout'])
    ->middleware(isLogin::class)
    ->name('logout');




Route::get('/sendverifyMobile', [\App\Http\Controllers\auth\AuthverifyEmailController::class, 'index'])->name('verifyMobile');



Route::post('/VerifyMobileCode', [\App\Http\Controllers\auth\AuthverifyEmailController::class, 'verifyMobile'])
    ->name('checkMobileVerify');



Route::get('verifyNumber', [\App\Http\Controllers\auth\AuthverifyEmailController::class, 'EnterVerifyCodePage'])->name('EnterVerifyCodePage');









Route::prefix('/admin-dashboard')
    ->name('adminn.')
    ->middleware([isLogin::class, isAdmin::class])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('panel');

        Route::resource('/users', UserController::class);
        Route::resource('/names', NamesController::class);
        Route::resource('/user_searches', user_searches::class);
        Route::resource('/orders', \App\Http\Controllers\Admin\OrdersController::class);
        Route::resource('/payments', PaymentsController::class);

        Route::prefix('setting')->name('setting.')->group(function () {

            Route::get('/', [SettingControler::class, 'index'])->name('index');

            Route::get('/s1', [SettingControler::class, 'searchPdfSettingPage'])->name('s1');

            Route::get('/s2', [SettingControler::class, 'searchPdfSettingPage'])->name('s2');

            Route::get('/s3', [SettingControler::class, 'searchPdfSettingPage'])->name('s3');

            Route::get('/s4', [SettingControler::class, 'searchPdfSettingPage'])->name('s4');

            Route::post('/EditPdfs', [SettingControler::class, 'EditPdfs'])->name('EditPdfs');
        });

        Route::post('/editPay', [SettingControler::class, 'edit'])->name('setting.editPay');

    });



Route::prefix('/user-dashboard')
    ->middleware([isLogin::class, IsUser::class])
    ->name('user.')
    ->group(function () {


        Route::get('/', [UserController::class, 'dashboard'])->name('panel');


        Route::prefix('/compony')->name('compony.')->group(function () {
            Route::get('/', [UserController::class, 'edtCompony'])->name('edit');
            Route::post('/update', [UserController::class, 'updateCompony'])->name('update');
            Route::post('/s1', [SearchController::class, 'searchByCompony'])->name('searchByCompony');
            Route::post('/s2', [SearchController::class, 'searchByCompony2'])->name('searchByCompony2');

        });

        Route::prefix('/search')->name('search.')->group(function () {

            Route::get('/s1', [SearchController::class, 's1'])->name('s1');
            Route::get('/s2', [SearchController::class, 's2'])->name('s2');
            Route::get('/s3', [SearchController::class, 's3'])->name('s3');
            Route::get('/s4', [SearchController::class, 's4'])->name('s4');

            Route::post('/searchName', [SearchController::class, 'searchName'])->name('searchName');

            Route::post('/submit', [SearchController::class, 'submit'])->name('submit');

            
            Route::prefix('/show/{id}')->group(function(){
                
                Route::get('/' , [SearchController::class , 'show'])->name('show');
                Route::get('/{index}' , [SearchController::class , 'showItem'])->name('showItem');
 
            });


        });

        Route::resource('/orders', OrdersController::class);

        Route::prefix('/payment')->name('payment.')->group(function () {
            Route::post('/pay', [Controller::class, 'payment'])->name('pay');
            Route::get('/PaymentVerify', [Controller::class, 'verifyy'])->name('verify');
        });
        Route::get('/history' , [SearchController::class , 'history'])->name('history');
    });











Route::post('/checkNumber', [UserController::class, 'checkNumber']);