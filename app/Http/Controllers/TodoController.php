<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return response()->json($todos);
    }

    public function store(Request $request)
    {
        $todo = Todo::create([
            'title' => $request->input('title'),
            'completed' => false
        ]);
        return response()->json($todo, 201);
    }

    public function update(Request $request, Todo $todo)
    {
        $todo->update([
            'title' => $request->input('title'),
            'completed' => $request->input('completed')
        ]);
        return response()->json($todo);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->noContent();
    }
}
