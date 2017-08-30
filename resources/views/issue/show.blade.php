@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/easy-table-filter.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="issue" class="container">
        <add-time issue-id="{{$issue->id}}" v-show="showModal" @close="showModal = false"></add-time>
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">

                        <div class="panel">
                            <div class="panel-heading">

                                <h4 class="panel-title">{{$issue->name}}
                                    <small>({{$issue->project->name}})</small>
                                </h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class=" col-md-12">
                                        <table class="table ">
                                            <tbody>
                                            <tr>
                                                <td>Created By:</td>
                                                <td colspan="2"><a href="">{{$issue->createdBy->name}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Assigned to:</td>
                                                <td colspan="2">
                                                    <assign-user :user-id="{{$issue->assignedTo->id}}"
                                                                 :issueId="{{$issue->id}}"
                                                                 :users="{{json_encode($users)}}"></assign-user>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Created at:</td>
                                                <td colspan="2">{{$issue->created_at}}</td>
                                            </tr>
                                            <tr>
                                                <td>Updated at:</td>
                                                <td colspan="2">{{$issue->updated_at}}</td>
                                            </tr>
                                            <tr>
                                                <td>Estimated time:</td>
                                                <td colspan="2">{{$issue->estimated_time}} hours</td>
                                            </tr>
                                            <tr>
                                                <td>Time spent:</td>
                                                <td>
                                                    <issues-logged-time issue-id="{{$issue->id}}"
                                                                        estimated="{{$issue->estimated_time}}"></issues-logged-time>

                                                </td>
                                                <td>
                                                    <button type="submit" @click="showModal = true"
                                                            class="btn btn-warning">Add Time
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>

                                            <tr>
                                                <td>Description</td>
                                                <td colspan="2">{{$issue->description}}</td>
                                            </tr>
                                            </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        @foreach($issue->comments as $comment)
                            @include('issue.comment')
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        @if(auth()->check())
                            <form method="POST" action="{{ route('issue_comment') }}">
                                {{csrf_field()}}
                                <input name="id" type="hidden" value="{{$issue->id}}">
                                <div class="form-group">
                                    <textarea name="body" class="form-control"
                                              placeholder="Do you want to say something?" id="body" rows="5"></textarea>
                                </div>
                                <button type="submit" class="btn btn-default">Post</button>

                            </form>
                        @else
                            <p class="text-center">You need to <a href="/login">login</a> to participate </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
