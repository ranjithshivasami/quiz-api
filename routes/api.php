<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('v1')->group(function(){
    Route::get('/quiz-question', 'Api\v1\QuizController@index')->name('questions')->middleware('log.route');
    Route::get('/participants-answers', 'Api\v1\QuizController@getParticipantsAnswers')->name('participants-answers')->middleware('log.route');
    Route::post('/create-participant', 'Api\v1\QuizController@createParticipant')->name('create-participant')->middleware('log.route');
    Route::post('/store-participants-answer', 'Api\v1\QuizController@storeParticipantAnswer')->name('store-participants-answer')->middleware('log.route');
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Not found'
    ]);
});