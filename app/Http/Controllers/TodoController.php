<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::join('asign', 'asign.project_id', 'project.id')
            ->join('users', 'users.id', 'asign.asign_to_id')
            ->where('asign.asign_to_id', Auth()->user()->id)
            ->select('project.id', 'project.project_name', 'project.remark', 'users.profile', 'users.name', 'asign.asign_to_id')
            ->get();
        return view('page.todo.index', compact('project'));
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
            $todo = new Todo();
            $todo->project_id = $request->id;
            $todo->title = $request->todo_title;
            $todo->status = $request->todo_status;
            $todo->save();
            $listmytodo = Todo::join('asign', 'asign.project_id', 'todo.project_id')
            ->where('todo.project_id', $request->id)
                ->where('asign.asign_to_id', Auth()->user()->id)
                ->count();
            return response()->json(['count' => $listmytodo, 'status' => true]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => false]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
