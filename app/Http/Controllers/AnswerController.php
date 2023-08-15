<?php

namespace App\Http\Controllers;

use App\Models\Defendant;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        return view('defendant.index');
    }

    public function show(string $id)
    {
        $answers = Defendant::query()
            ->leftJoin('surveys', 'defendants.surveys_id', '=',
                'surveys.id')
            ->leftJoin('questions', 'surveys.id', '=',
                'questions.surveys_id')
            ->leftJoin('options', 'questions.id', '=',
                'options.questions_id')
            ->leftJoin('answers', function (JoinClause $join) {
                $join->on('answers.defendants_id', '=',
                    'defendants.id');
                $join->on('answers.questions_id', '=',
                    'questions.id');
            })
            ->leftJoin('option_answers', function (JoinClause $join) {
                $join->on('options.id', '=', 'option_answers.options_id');
                $join->on('answers.id', '=', 'option_answers.answers_id');
            })
            ->select('questions.id', 'options.option', 'answers.text',
                'questions.type', 'questions.question', 'answers_id')
            ->orderBy('questions.id')
            ->where('defendants_id', $id)
            ->get();
        return view('answer.show',
            compact('answers', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

    }
}
