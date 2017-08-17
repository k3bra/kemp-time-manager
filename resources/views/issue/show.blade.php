@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/easy-table-filter.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div id="issue" class="container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">


                        <div class="panel">
                            <div class="panel-heading">
                                <h1 > {{$issue->name}} <small>({{$issue->project->name}})</small> </h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class=" col-md-12">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Created By:</td>
                                                <td><a href="">{{$issue->createdBy->name}}</a></td>
                                            </tr>
                                            <tr>
                                                <td>Assigned to:</td>
                                                <td><a href="">{{$issue->assignedTo->name}}</a> </td>
                                            </tr>
                                            <tr>
                                                <td>Created at:</td>
                                                <td>{{$issue->created_at}}</td>
                                            </tr>
                                            <tr>
                                                <td>Updated at:</td>
                                                <td>{{$issue->updated_at}}</td>
                                            </tr>
                                            <tr>
                                                <td>Estimated time:</td>
                                                <td>{{$issue->estimated_time}} hours</td>
                                            </tr>
                                            <tr>

                                            <tr>
                                                <td>Description</td>
                                                <td>{{$issue->description}}</td>
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
            </div>
        </div>
    </div>
@endsection


@section('javascript')

    <script type="text/javascript">
        new Vue({
            el: '#issue',
            data: {
                issues: {},
                issuesStatus: {},
                url: '/issue/show/'
            }});
    </script>

@endsection
