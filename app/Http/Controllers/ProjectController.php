<?php

namespace App\Http\Controllers;


use App\Issue;
use App\IssueStatus;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{


    /**
     * ProjectController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::all();

        return view('project.index', ['projects' => $projects]);
    }

    public function show($projectId)
    {
        $issues = Issue::all()->where('project_id', '=', $projectId);

        return view('issue.index', ['issues' => $issues]);
    }

    public function create()
    {

        return view('project.create');
    }

    public function store(Request $request)
    {

        $request->input('name');

        $this->validate($request, ['name' => 'required|unique:projects']);

        Project::create([
            'name' => $request->input('name'),
            'created_by' => Auth::user()->id,
        ]);

        return back();
    }

}