<?php

namespace App\Http\Controllers;

use App\Models\Asign;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()->role == 'admin') {
            $project = Project::paginate(10);
        } else {
            $project = Project::join('asign', 'asign.project_id', 'project.id')
                ->where('asign.asign_to_id', Auth()->user()->id)->paginate(10);
        }
        return view('page.project.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::get();
        return view('page.project.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|unique:project',
            'asign_to_user' => 'required',
        ]);

        if (!is_array($request['asign_to_user'])) {
            return back()->withInput([
                'error' => 'Asign to user Should be Array'
            ]);
        }

        $project = new Project();
        $project->project_name = $request['project_name'];
        $project->asign_to_user = "no need";
        $project->remark = isset($request['remark']) ? $request['remark'] : '';
        $project->created_by = Auth()->user()->id;
        if ($project->save()) {
            foreach ($request['asign_to_user'] as $key => $val) {
                $Asign = new Asign();
                $Asign->project_id = $project->id;
                $Asign->asign_to_id = $val;
                $Asign->save();
            }

            return redirect()->route('project.index');
        } else {
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('page.project.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('page.project.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        return view('page.project.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        Asign::where('project_id', $project->id)->delete();
        $project->delete();
        return true;
    }
}
