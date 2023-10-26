<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\{EventMail, QuizMail};
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function eventForm(Request $request)
    {
        try {
            Mail::to('1024umer@gmail.com')
                ->send(
                    new EventMail(
                        $request->name,
                        $request->email,
                        $request->number,
                        $request->people,
                        $request->event_title
                    )
                );
            return response()->json(['success' => true]);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'error' => $ex->getMessage()]);
        }
    }
    public function quizMail(Request $request)
    {
        try {
            Mail::to($request->email)
                ->send(
                    new QuizMail(
                        $score = $request->quizScore,
                    )
                );
            return response()->json(['success' => true]);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'error' => $ex->getMessage()]);
        }
    }

}