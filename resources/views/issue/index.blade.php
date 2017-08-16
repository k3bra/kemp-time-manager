@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/easy-table-filter.css') }}" rel="stylesheet">
@endsection

@section('content')

<div id="issues" class="container">
    <div class="row">
        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-right">
                            <div class="btn-group">
                                @foreach($issuesStatus as $issue)
                                <button type="button" class="btn {{ getStatusClass($issue->id) }} btn-filter" data-target="pagado">{{$issue->name}}</button>
                                @endforeach
                                <button type="button" class="btn btn-default btn-filter" data-target="all">All</button>
                            </div>

                        </div>
                        <div class="table-container">
                            <table class="table table-filter">
                                <tbody>

                                        <tr v-for="issue in issues">
                                            <td>
                                                @{{issue.project.name}}
                                            </td>
                                            <td>
                                                @{{issue.assigned_to.name}}
                                            </td>

                                            <td>
                                                <div class="media">
                                                    <a v-on:click="test(issue.assigned_to.name)" href="#" class="pull-left">
                                                        <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                    </a>
                                                    <div class="media-body">
                                                        <span class="media-meta pull-right">@{{issue.created_at}}</span>
                                                        <h4 class="title">
                                                            @{{issue.name}}
                                                        </h4>
                                                        <p class="summary">@{{issue.description}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span v-bind:class="getColour(issue.status)"> @{{ issue.status_desc.name }} </span>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection


@section('javascript')

    <script type="text/javascript">
         new Vue({
            el: '#issues',
            data: {
                issues: {}
            },
            created: function (){
                this.getIssues();
            },
            methods: {
                getIssues: function () {
                    var self = this;
                    axios.get('/issue/show-all').then(function (response) {
                        self.issues = response.data;
                    });
                },
                test: function(test) {
                    console.log(test);
                },
                getColour: function(id) {
                    if (id == 1){
                       return "open";
                    }
                    if (id == 2){
                       return "on-hold";
                    }
                    if (id == 3){
                       return "closed";
                    }
                    if (id == 4){
                       return "in-progress";
                    }
                    return "";
                }
            }
        });
    </script>

@endsection
