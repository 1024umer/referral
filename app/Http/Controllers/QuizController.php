<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Survey, SurveyQuestion, SurveyQuestionAnswer};

class QuizController extends Controller
{
    public function index()
    {
        $surveys = Survey::where('is_active', 1)->with('questions.answers')->get();
        return view('dashboard.quiz', compact('surveys'));
    }
    public function submit(Request $request)
    {
        $userAnswers = $request->input('answers', []);
        $quizResults = [];
        $correctAnswers = 0;
        $totalQuestions = 0;

        foreach ($userAnswers as $questionId => $selectedAnswerId) {
            $selectedAnswer = SurveyQuestionAnswer::find($selectedAnswerId);
            if ($selectedAnswer) {
                if ($selectedAnswer->is_correct) {
                    $correctAnswers++;
                    $quizResults[$questionId] = true;
                } else {
                    $quizResults[$questionId] = false;
                }
            }
            $totalQuestions++;
        }
        return response()->json([
            'correctAnswers' => $correctAnswers,
            'totalQuestions' => $totalQuestions,
            'results' => $quizResults,
        ]);
    }




}