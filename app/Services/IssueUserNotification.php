<?php

namespace App\Services;


use App\IssueFollower;
use App\UserNotification;

class IssueUserNotification
{


    const COMMENT_TYPE = 1;
    const ASSIGN_TYPE = 2;

    protected $type;

    protected $issueId;

    public function __construct(int $type, int $issueId)
    {
        $this->type = $type;
        $this->issueId = $issueId;
    }


    public function notify()
    {

        $issueFollowerModel = new IssueFollower();
        $followers = $issueFollowerModel->where('issue_id', '=', $this->issueId)
            ->where('user_id', '=', auth()->user()->id)->get();

        $userNotifications = new UserNotification();
        foreach ($followers as $follower) {
            $userNotifications->create([
                'user_id' => $follower->user_id,
                'type' => $this->type,
                'seen' => 0,
                'description' => $this->getMessage()
            ]);
        }
    }

    public function getMessage(): string
    {

        switch ($this->type) {
            case self::COMMENT_TYPE:
                return 'There is a new comment for issue number ' . $this->issueId;
                break;
            case self::ASSIGN_TYPE:
                return 'There is a new comment for issue number ' . $this->issueId;
                break;
            default:
                throw new \Exception("Notification type not found");
                break;
        }
    }

    public function getUrl()
    {
        return '/issue/show/' . $this->issueId;
    }

}