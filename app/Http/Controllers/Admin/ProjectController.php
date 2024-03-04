<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.project.store', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $project = new Project();
        $form_data = $request->all();
        
        if($request->hasFile('logo')){
            $path = Storage::disk('public')->put('logos_image', $form_data['logo']);
            $form_data['logo'] = $path;
        }
        $form_data['slug'] = Str::slug($form_data['name'], '-');
        $project->fill($form_data);

        $project->save();

        if($request->has('technologies')){
            $project->technologies()->attach($form_data['technologies']);
        }
        else{
            $project->technologies()->sync([]);
        }

        return redirect()->route('admin.project.show', compact('project'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        
        return view('admin.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Request $request)
    {
        $error_message = $request->error_message;
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.project.update', compact('project', 'types','technologies' , 'error_message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->all();
        // title control 
        $exist = Project::where('name', 'LIKE', $form_data['name'])
            ->where('id', '!=', $project->id)
            ->get();
        
        if(count($exist) > 0){
            $error_message = 'Hai inserito un nome già presente tra i tuoi progetti';
            return redirect()->route('admin.project.edit', compact('project', 'error_message'));
        }
        // logo control
        if($request->hasFile('logo')){
            if($project->logo != null){
                Storage::disk('public')->delete($project->logo);
            }
            $path = Storage::disk('public')->put('logos_image', $form_data['logo']);
            $form_data['logo'] = $path;
        }
        // create slug 
        $form_data['slug'] = Str::slug($form_data['name'], '-');
        $project->update($form_data);

        if($request->has('technologies')){
            $project->technologies()->sync($form_data['technologies']);
        }
        else{
            $project->technologies()->sync([]);
        }
        return redirect()->route('admin.project.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->logo != null){
            Storage::disk('public')->delete($project->logo);
        }
        $project->delete();
        return redirect()->route('admin.project.index');
    }
}
