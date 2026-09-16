<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->tasks()->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = $request->user()->tasks()->create($validated);

        return response()->json($task, 201);
    }

    public function show(Request $request, Task $task)
    {
        $this->authorizeOwner($request, $task);

        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeOwner($request, $task);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_done' => 'sometimes|boolean',
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorizeOwner($request, $task);

        $task->delete();

        return response()->json(null, 204);
    }

    private function authorizeOwner(Request $request, Task $task): void
    {
        abort_if($task->user_id !== $request->user()->id, 403, 'No autorizado sobre este recurso.');
    }
}
