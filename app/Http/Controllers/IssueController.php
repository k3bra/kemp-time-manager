<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignUserIssueRequest;
use App\Http\Requests\CommentIssueRequest;
use App\Http\Requests\IssueStoreRequest;
use App\Http\Requests\LogIssueHourRequest;
use App\Http\Requests\UpdateIssueStatusRequest;
use App\Issue;
use App\IssueComment;
use App\IssueFollower;
use App\IssueStatus;
use App\IssueTimeLogger;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Assign;

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

    public function show($id, IssueFollower $issueFollower, Issue $issue)
    {

        $isFollowing = $issueFollower->hasUserFollowing($id, Auth::user()->id);

        return view('issue.show', [
            'issue' => $issue->issueInfo($id),
            'status' => IssueStatus::all(),
            'users' => User::all(),
            'followers' => $issueFollower->getFollowersById($id),
            'isFollowing' => $isFollowing,
            'followUrl' => $this->getFollowUrl($isFollowing, $id)
        ]);
    }

    private function getFollowUrl($isFollowing, $id)
    {
        return !$isFollowing ? '/issue/follow/' . $id : '/issue/un-follow/' . $id;

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

    public function assign(AssignUserIssueRequest $request)
    {
        $request->assignUser();
    }

    public function updateStatus(UpdateIssueStatusRequest $updateIssueStatusRequest)
    {
        $updateIssueStatusRequest->update();
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

    public function store(IssueStoreRequest $request)
    {

        $request->store();

        return back();
    }

    public function getLoggedHours(Request $request)
    {

        $issueLogger = new IssueTimeLogger();

        return $issueLogger->getTotalHoursById($request->input('id'));
    }

    public function logHour(LogIssueHourRequest $request)
    {
        return $request->logHour(Auth::id());
    }

    public function comment(CommentIssueRequest $request)
    {

        $request->comment();

        return back();
    }
}