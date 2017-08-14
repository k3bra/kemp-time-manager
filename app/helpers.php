<?php

function getStatusClass($statusId) {
    if ($statusId == \App\IssueStatus::OPEN) {
        return 'btn-success';
    }
    if ($statusId == \App\IssueStatus::IN_PROGRESS) {
        return 'btn-info';
    }

    if($statusId == \App\IssueStatus::CLOSED) {
        return 'btn-danger';
    }

    if ($statusId ==  \App\IssueStatus::ON_HOLD) {
        return 'btn-warning';
    }
    

    return 'btn-default';
}