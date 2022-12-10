<?php

namespace App\Http\Controllers;

use App\Models\Listtodo;
use App\Models\Project;
use App\Models\Todo;
use Illuminate\Http\Request;

class ListtodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::join('asign', 'asign.project_id', 'project.id')
            ->where('asign.asign_to_id', Auth()->user()->id)
            ->get();
        return view('page.listtodo.index', compact('project'));
    }

    public function listtodobyproject($project_id)
    {
        $listtodo = Todo::join('project', 'project.id', 'todo.project_id')
            ->join('asign', 'asign.project_id', 'project.id')
            ->where('asign.asign_to_id', Auth()->user()->id)
            ->where('project.id', $project_id)->get();
        return view('page.listtodo.listmytodobyproject', compact('listtodo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listtodo  $listtodo
     * @return \Illuminate\Http\Response
     */
    public function show(Listtodo $listtodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listtodo  $listtodo
     * @return \Illuminate\Http\Response
     */
    public function edit(Listtodo $listtodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Listtodo  $listtodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listtodo $listtodo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listtodo  $listtodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listtodo $listtodo)
    {
        //
    }
}
