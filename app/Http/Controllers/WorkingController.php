<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;

class WorkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myproject = Project::join('asign', 'asign.project_id', 'project.id')
            ->where('asign.asign_to_id', Auth()->user()->id)
            ->select('project.*')
            ->get();
        return view('page.working.index', compact('myproject'));
    }

    public function view($project_id)
    {
        try {
            $mytodo = Project::join('asign', 'asign.project_id', 'project.id')
                ->join('users', 'users.id', 'asign.asign_to_id')
                ->where('asign.asign_to_id', auth()->user()->id)
                ->where('project.id', $project_id)
                ->select('project.id', 'project.project_name', 'project.remark', 'users.profile', 'asign.asign_to_id')
                ->groupBy('asign.asign_to_id', 'asign.project_id')
                ->first();
            if (!empty($mytodo->id)) {
                return view('page.working.view', compact('mytodo'));
            } else {
                return back()->with(['message' => 'your don not have doto']);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => false]);
        }
    }
}
