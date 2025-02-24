<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function __construct()
    {
        // Only allow authenticated users to perform actions
        $this->middleware('auth:api');
    }

    // Create a new project
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create the project and associate it with the authenticated user
        $project = Project::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'user_id' => auth()->user()->id,
        ]);

        return response()->json($project, 201);
    }

    // Get a list of projects for the authenticated user
    public function index()
    {
        $projects = auth()->user()->projects;
        return response()->json($projects);
    }

    // Update a project
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = Project::findOrFail($id);

        // Ensure the user owns the project before updating
        if ($project->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $project->update($validatedData);
        return response()->json($project);
    }

    // Delete a project
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // Ensure the user owns the project before deleting
        if ($project->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $project->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
