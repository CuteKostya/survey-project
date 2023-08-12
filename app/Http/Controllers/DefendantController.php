<?php

namespace App\Http\Controllers;

use App\Models\Defendant;
use App\Models\Survey;
use Illuminate\Http\Request;

class DefendantController extends Controller
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


        return view('defendant.index', compact('surveys'));
    }

    public function show(string $id)
    {
        $limit = 10;

        $query = Defendant::query()
            ->Join('users', 'users.id', '=', 'defendants.users_id')
            ->Join('surveys', 'surveys.id', '=', 'defendants.surveys_id')
            ->Select('defendants.id', 'defendants.users_id', 'users.name')
            ->where('surveys_id', 'like', $id);


        $defendants = $query->paginate($limit);


        return view('defendant.show',
            compact('defendants', 'id'));
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
