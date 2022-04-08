<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      //$this->call(UsersTableSeeder::class);
      $questionId = DB::table('quiz_questions')->insert([
        'question' => 'How do you find our service?',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      $answerGood = DB::table('quiz_answers')->insert([
        'answer' => 'Good',
        'quiz_question_id' => $questionId,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      $answerFair = DB::table('quiz_answers')->insert([
        'answer' => 'Fair',
        'quiz_question_id' => $questionId,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      $answerNeutral = DB::table('quiz_answers')->insert([
        'answer' => 'Neutral',
        'quiz_question_id' => $questionId,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

     $answerBad = DB::table('quiz_answers')->insert([
        'answer' => 'Bad',
        'quiz_question_id' => $questionId,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      $participantId1 = DB::table('participants')->insert([
        'name' => 'Ranjith',       
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      $participantId2 = DB::table('participants')->insert([
        'name' => 'John',       
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

       DB::table('participant_answers')->insert([
        'participant_id' => $participantId1,       
        'quiz_answer_id' => $answerGood,       
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('participant_answers')->insert([
        'participant_id' => $participantId2,       
        'quiz_answer_id' => $answerFair,       
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

    }
}
