<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{IndexController, ContactController, SearchController, MailController, QuizController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('about', [IndexController::class, 'about'])->name('about');

Route::get('blog-inner/{slug}', [IndexController::class, 'blogInner'])->name('blog-inner');
Route::get('blog', [IndexController::class, 'blog'])->name('blog');
Route::get('blog/category/{category_id}', [SearchController::class, 'blogCategory'])->name('blogs.categories');
Route::POST('blog/category/search', [SearchController::class, 'blogSearch'])->name('blogs.search');

Route::get('contact', [IndexController::class, 'contact'])->name('contact');
Route::post('contact-store', [ContactController::class, 'contactStore'])->name('contact-store');

Route::get('capability-statement', [IndexController::class, 'capabilityStatement'])->name('capability-statement');
Route::get('case-study', [IndexController::class, 'caseStudy'])->name('case-study');
Route::get('case-study/{slug}', [IndexController::class, 'caseInner'])->name('case.inner');
Route::get('event-page', [IndexController::class, 'eventPage'])->name('event-page');
Route::post('event-form', [MailController::class, 'eventForm'])->name('event-form');

Route::get('project-heimdall', [IndexController::class, 'projectHeimdall'])->name('project-heimdall');
Route::get('quiz', [QuizController::class, 'index'])->name('quiz');
Route::post('quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::post('quiz/mail', [MailController::class, 'quizMail'])->name('quiz.result.mail');

Route::get('service', [IndexController::class, 'service'])->name('service-main');
// Route::get('service-page/{slug}',[IndexController::class,'servicePage'])->name('service-page');
Route::get('/service/inner-page', [IndexController::class, 'servicePage'])->name('service-page');
Route::get('/service/inner-page1', [IndexController::class, 'servicePageOne'])->name('service-page-one');



Route::get('/backend/{any?}', function () {
    return view('backend');
})->where('any', '.*');