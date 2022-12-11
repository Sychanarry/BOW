<?php

namespace App\Http\Controllers;

use App\Models\Listtodo;
use App\Models\Project;
use App\Models\Todo;
use Exception;
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
            ->where('project.id', $project_id)
            ->select('todo.*')
            ->get();
        return view('page.listtodo.listmytodobyproject', compact('listtodo', 'project_id'));
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
        try {
            $listtodo = new Listtodo();
            $listtodo->todo_title = $request->todo_title;
            $listtodo->status_todo = $request->status_todo;
            $listtodo->priority = $request->priority;
            $listtodo->todo_id = $request->todoid;
            $listtodo->save();
            $listtododetail = Listtodo::where('todo_id',  $request->todoid)->get();
            $table = view('page.listtodo.table', compact('listtododetail'))->render();
            return response()->json(['table' => $table, 'message' => "add todo detail success", 'status' => true]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => false]);
        }
    }

    public function updatetododetail(Request $request)
    {
        try {
            $listtodo = Listtodo::where('id', $request->id)->first();
            $listtodo->todo_title = $request->todo_title;
            $listtodo->status_todo = $request->status_todo;
            $listtodo->priority = $request->priority;
            $listtodo->save();
            return response()->json(['message' => "update todo detail success", 'status' => true]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => false]);
        }
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
