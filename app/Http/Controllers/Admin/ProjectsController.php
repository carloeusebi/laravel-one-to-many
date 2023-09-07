<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $projects = Project::where('name', 'like', "%$search%")->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        return view('admin.projects.create', compact('project'));
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();

        // storing the image
        if (array_key_exists('thumbnail', $data)) {
            $thumbnail = Storage::putFile('project_images', $data['thumbnail']);
            $data['thumbnail'] = $thumbnail;
        }

        $project = Project::create($data);

        return to_route('admin.projects.show', compact('project'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $title = "Update " . $project->name;
        return view('admin.projects.edit', compact('project', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->all();

        // storing the image
        if (array_key_exists('thumbnail', $data)) {
            // if there was already an image delete that image
            if ($project->thumbnail) {
                Storage::delete($project->thumbnail);
            }
            $thumbnail = Storage::putFile('project_images', $data['thumbnail']);
            $data['thumbnail'] = $thumbnail;
        }

        $project->update($data);

        return to_route('admin.projects.show', compact('project'))
            ->with('alert-type', 'success')
            ->with('alert-message', "$project->name successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // remember the project name to later send it in the message
        $project_name = $project->name;

        // delete the thumbnail if present
        if ($project->thumbnail) {
            Storage::delete($project->thumbnail);
        }

        $project->delete();

        return to_route('admin.projects.index')
            ->with('alert-type', 'success')
            ->with('alert-message', "$project_name successfully deleted");
    }
}
