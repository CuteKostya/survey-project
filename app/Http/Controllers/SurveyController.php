<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Defendant;
use App\Models\Option;
use App\Models\Option_answer;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'category_id' => ['nullable', 'string', 'max:50'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $limit = $validated['limit'] ?? 10;

        $query = Survey::query();
        if ($category_id = $validated['category_id'] ?? null) {
            if ($category_id == 1) {
                $query->where('path', 'like', "%");
            }
            if ($category_id == 2) {
                $query->where('path', '=', null);
            }
        }

        $surveys = $query->paginate($limit);


        return view('survey.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $survey_id = $request->id;
        $questions
            = DB::table('questions')
            ->leftjoin('options', 'options.questions_id', '=', 'questions.id')
            ->selectRaw(' questions.id, questions.question, questions.type, count(questions.id) as count_questions')
            ->where('surveys_id', $survey_id)
            ->groupBy('questions.id')
            ->get();

        $valid_array = [];

        for ($i = 0; $i < count($questions); $i++) {
            if ($questions[$i]->type == 'text') {
                $valid_array['q.'.$questions[$i]->id.'.0'] = [
                    'required', 'string', 'max:50',
                ];
            } else {
                $valid_array['q.'.$questions[$i]->id.'.0'] = 'required';
            }
            if ($questions[$i]->count_questions > 1) {
                for ($j = 1; $j <= $questions[$i]->count_questions; $j++) {
                    $valid_array['q.'.$questions[$i]->id.'.'.$j] = 'nullable';
                }
            }
        }


        $validated = $request->validate($valid_array);
        $validated = $validated['q'];
        // defendants
        $defendant = Defendant::query()->create([
            'users_id' => Auth::id(),
            'surveys_id' => $survey_id,
        ]);

        //answers 
        $i = -1;
        foreach ($validated as $id => $item) {
            $i++;
            if ($questions[$i]->type == 'text') {
                Answer::query()->create([
                    'defendants_id' => $defendant->id,
                    'questions_id' => $id,
                    'text' => $item[0],

                ]);
            } else {
                $answer = Answer::query()->create([
                    'defendants_id' => $defendant->id,
                    'questions_id' => $id,
                ]);

                foreach ($item as $it) {
                    Option_answer::query()->create([
                        'answers_id' => $answer->id,
                        'options_id' => $it,

                    ]);
                }
            }
        }

        return redirect()->route('surveys');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $questions = Question::all()
            ->where('surveys_id', $id);

        $query = Option::all();
        foreach ($questions as $question) {
            $query->where('questions_id', $question->id);
        }

        $options = $query;
        return view('survey.show',
            compact('questions', 'options', 'id'));
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
