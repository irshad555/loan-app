<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{UserController,LoanController,RepaymentController,LoginController};



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




# login with generate Api tokens
Route::post('login',[LoginController::class,'signin'])->name('login');


Route::middleware(['auth:sanctum'])->group(function(){

   # User end points
   Route::apiResource('users',UserController::class)
   ->only(['index','show', 'update', 'destroy']);

   # Loan end points

   Route::get('users/{user}/loans',[LoanController::class,'showByUser'])
   ->name('loans.showByUser');
   Route::post('users/{user}/loans',[LoanController::class,'store'])
   ->name('loans.store');
   Route::get('loans/{loan}',[LoanController::class,'show'])
   ->name('loans.show');
   # admin 
   Route::group(['middleware' => ['admin']], function () {
   Route::get('loans',[LoanController::class,'index'])
   ->name('loans.index');
   Route::post('status/{loans}',[LoanController::class,'loanStatus'])
   ->name('loans.status');
   });
   # Repayment end points

   Route::get('repayments',[RepaymentController::class,'index'])
   ->name('repayments.index');
   Route::get('repayments/{repayment}',[RepaymentController::class,'show'])
   ->name('repayments.show');
   Route::post('loans/{loan}/repayments',[RepaymentController::class,'store'] )
   ->name('repayments.store');
   Route::delete('repayments/{repayment}',[RepaymentController::class,'destroy'])
   ->name('repayments.destroy');
});