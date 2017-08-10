<?php
/**
 * Created by PhpStorm.
 * User: Gonçalo Cunha
 * Date: 10/08/2017
 * Time: 09:24
 */
namespace App\Http\Controllers;

use App\Issue;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
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

        return view('issue.index', ['projects' => $projects]);
    }

    public function create() {

        $projects = Project::all();

        return view('issue.create', ['projects' => $projects]);
    }

    public function store(Request $request) {

        $request->input('name');

        $this->validate($request,
            [
                'name' => 'required|unique:issues',
                'estimated' => 'required|integer',
                'description' => 'required',
                'status' => 'required',
                'project' => 'required',
            ]);

        Issue::create([
            'name' => $request->input('name'),
            'created_by' => Auth::user()->id,
            'description' => $request->input('description'),
            'estimated_time' => $request->input('estimated'),
            'project_id' => $request->input('project'),
            'status' => $request->input('status'),
            'assigned_to' => Auth::user()->id,
        ]);

        return back();
    }
}