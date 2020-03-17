<?php

use Illuminate\Database\Seeder;

const TOPIC = ['Addition', 'Subtraction', 'Multiplication', 'Division'];
const SIGN = ['+', '-', '×', '÷'];
const PATH = ['example_add.png', 'example_sub.png', 'example_mul.png', 'example_div.png'];

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Create 3 tutors
        factory(App\User::class, 3)->state('tutor')->create()->each(
            function ($tutor) {
                $this->createMathTopics($tutor);
            }
        );

        //Create 30 students
        factory(App\User::class, 30)->state('student')->create();
    }

    private function createMathTopics($tutor)
    {
        for ($i = 0; $i < 4; $i++) {
            $topic = factory(App\Topic::class)
                ->create([
                    'creator_user_id' => $tutor->id,
                    'name' => TOPIC[$i],
                    'sprite_path' => PATH[$i]
                ]);

            $this->createMathQuestions($topic, $i);
        }
    }

    private function createMathQuestions($topic, $type)
    {
        for ($i = 0; $i < 10; $i++) {
            $rhs = rand(1, 10);
            $lhs = rand(1, 5) * $rhs;
            $qns = $lhs . SIGN[$type] . $rhs;

            $question = factory(App\Question::class)
                ->create([
                    'topic_id' => $topic->id,
                    'question' => $qns
                ]);

            $this->createMathAnswers($question, $type, $lhs, $rhs);
        }
    }

    private function createMathAnswers($question, $type, $lhs, $rhs)
    {
        $ans = [$lhs + $rhs, $lhs - $rhs, $lhs * $rhs, $lhs / $rhs];

        for ($i = 0; $i < 4; $i++) {
            $correct = $i == $type;

            factory(App\Answer::class)
                ->create([
                    'question_id' => $question->id,
                    'answer' => $ans[$i],
                    'correct' => $correct
                ]);
        }
    }
}
