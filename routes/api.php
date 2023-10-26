<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Api\{
    UserController,
    ProfileController,
    CategoryController,
    BlogController,
    FaqController,
    FeedbackController,
    ServiceController,
    ChooseUsController,
    AdditionalServiceController,
    ContactController,
    EventController,
    CaseCategoryController,
    CaseStudyController,
    SurveyController,
    SurveyQuestionAnswerController,
    SurveyQuestionController,
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['json.response']], function () {
    Route::post('/login', [ApiAuthController::class, 'login']);
});
Route::group(['middleware' => ['json.response', 'auth:sanctum']], function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::put('/updateprofile', [ApiAuthController::class, 'updateprofile']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('blogs', BlogController::class);
    Route::apiResource('faqs', FaqController::class);
    Route::apiResource('feedbacks', FeedbackController::class);
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('chooseus', ChooseUsController::class)->only('index', 'show', 'update');
    Route::apiResource('additional-services', AdditionalServiceController::class);
    Route::apiResource('events', EventController::class);
    Route::apiResource('case-categories', CaseCategoryController::class);
    Route::apiResource('case-studies', CaseStudyController::class);
    Route::apiResource('contacts', ContactController::class)->only('index', 'destroy');
    Route::apiResource('surveys', SurveyController::class);
    Route::apiResource('surveys-questions', SurveyQuestionController::class);
    Route::apiResource('surveys-answers', SurveyQuestionAnswerController::class);


});
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    User::where('id', $request->user()->id)
    ;
    return $request->user();
});