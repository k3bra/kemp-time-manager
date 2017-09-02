<?php
/**
 * Created by PhpStorm.
 * User: Gonçalo Cunha
 * Date: 10/08/2017
 * Time: 09:24
 */

namespace App\Http\Controllers;

use App\Issue;
use App\IssueComment;
use App\IssueFollower;
use App\IssueStatus;
use App\IssueTimeLogger;
use App\Project;
use App\User;
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


    public function showAllIssues(Request $request)
    {
        $select = Issue::with(['createdBy', 'assignedTo', 'project', 'statusDesc']);

        if ($request->input('id') && $request->input('id') != -1) {
            $select->where('status', '=', $request->input('id'));
        }

        return $select->get();
    }

    public function show($id)
    {

        $issue = Issue::with(['createdBy', 'assignedTo', 'project', 'statusDesc'])->where('id', '=', $id)->first();
        $users = User::all();

        $followers = IssueFollower::with(['followedBy'])->where('issue_id', '=', $id)->limit(8)->get();

        $isFollowing = IssueFollower::where('issue_id', '=', $id)->where('user_id', '=', Auth::user()->id)->first();

        $url = !$isFollowing ? '/issue/follow/' . $id : '/issue/un-follow/' . $id;

        return view('issue.show', [
            'issue' => $issue,
            'users' => $users,
            'followers' => $followers,
            'isFollowing' => $isFollowing,
            'followUrl' => $url
        ]);
    }

    public function follow($id)
    {
        IssueFollower::create(['issue_id' => $id, 'user_id' => Auth::user()->id]);

        return back();
    }

    public function unFollow($id)
    {
        IssueFollower::where('issue_id', '=', $id)->where('user_id', '=', Auth::user()->id)->delete();

        return back();
    }

    public function assign(Request $request)
    {

        $this->validate($request, ['issueId' => 'required', 'userId' => 'required']);

        $userId = $request->input('userId');
        $issueId = $request->input('issueId');

        $issue = Issue::find($issueId);

        $issue->assigned_to = $userId;

        $issue->save();


    }

    public function index()
    {
        $issues = Issue::all();

        return view('issue.index', ['issues' => $issues, 'issuesStatus' => IssueStatus::all()]);
    }

    public function create()
    {

        $projects = Project::all();

        return view('issue.create', ['projects' => $projects, 'issuesStatus' => IssueStatus::all()]);
    }

    public function showAllStatus()
    {

        return IssueStatus::all();
    }

    public function store(Request $request)
    {

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

    public function getLoggedHours(Request $request)
    {

        $issueLogger = new IssueTimeLogger();

        return $issueLogger->getTotalHoursById($request->input('id'));
    }

    public function logHour(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'hours' => 'required|integer',
            'date' => 'date'
        ]);

        $currentNrHours = (new IssueTimeLogger())->logHour(
            Auth::user()->id,
            $request->input('id'),
            $request->input('hours'),
            $request->input('date')
        );

        return $currentNrHours;
    }

    public function comment(Request $request)
    {

        $this->validate($request, [
                'body' => 'required',
                'id' => 'required'
            ]
        );

        IssueComment::create([
            'body' => $request->input('body'),
            'issue_id' => $request->input('id'),
            'user_id' => Auth::user()->id,
        ]);

        return back();
    }
}