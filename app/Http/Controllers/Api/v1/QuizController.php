<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\v1\Questionresource as Question;
use App\Participant;
use App\ParticipantAnswer;
use App\QuizQuestion;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Validator;


class QuizController extends Controller
{
    /**
     * Get Quiz Question first record
     *
     * @param QuizQuestion $quizQuestion
     * @return void
     */
    function index(QuizQuestion $quizQuestion)
    {
        return new Question($quizQuestion->first());
    }

    /**
     * Create Participant
     *
     * @param Request $request
     * @return void
     */
    function createParticipant(Request $request){
        
        $validator = Validator::make($request->json()->all(), [
            'name' => 'required',            
        ]);

        if($validator->fails()){
            return response(['status' =>'error',$validator->errors()], 422);
        }
        $participant = New Participant();
        $participant->name = $request->name;
        $participant->save();
        return response(['status' => 'success', 'participant_id' => $participant->id], 201);
    }

    /**
     * Get all the participant answers and claulate the answered percentage
     *
     * @return void
     */
    function getParticipantsAnswers()
    {
        $participantsAnswers =  DB::table('quiz_answers')
            ->joinSub('SELECT quiz_answer_id, COUNT(id) AS answer_count  FROM participant_answers GROUP BY quiz_answer_id', 'PA', 'quiz_answers.id', '=', 'PA.quiz_answer_id', 'left')
            ->select('quiz_answers.id', 'PA.answer_count', 'quiz_answers.answer')
            ->get()->toArray();

        foreach ($participantsAnswers as $key => $asnwers) {
            $answerCount =  $asnwers->answer_count ?? 0;
            $participantsAnswers[$key]->answer_count = $answerCount;
            $participantsAnswers[$key]->percentage = $this->calulateAnswerdPercentage($answerCount);
        }
        return response($participantsAnswers, 200);
    }

   
    /**
     * Store Participant Answer
     *
     * @param Request $request
     * @return void
     */
    function storeParticipantAnswer(Request $request){
        $validator = Validator::make($request->json()->all(), [
            'participant_id' => 'required',      
            'quiz_answer_id' => 'required'      
        ]);

        if($validator->fails()){
            return response(['status' =>'error',$validator->errors()], 422);
        }
        $participantAnswer = New ParticipantAnswer();
        $participantAnswer->participant_id = $request->participant_id;
        $participantAnswer->quiz_answer_id = $request->quiz_answer_id;
        $participantAnswer->save();
        return response(['status' => 'success', 'participan-answer_id' => $participantAnswer->id], 201);
    }

    /**
     * Calulate answerd percentage
     *
     * @param [type] $asnwers
     * @return void
     */
    private function calulateAnswerdPercentage($asnwers)
    {
        $totalAnsweredCount =  DB::table('participant_answers')->count();
        $percentage = $asnwers / $totalAnsweredCount * 100;
        return $percentage;
    }
}
