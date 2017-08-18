@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-warning">
                    <div class="panel-heading">
                        Projects
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Creator</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($projects))
                                @foreach($projects as $project)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/project/' . $project->id ) }}"> {{$project->id}} </a>
                                        </td>
                                        <td>{{$project->name}}</td>
                                        <td>{{$project->user->name}}</td>
                                    </tr>
                                    </a>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
