@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created by</th>
                        <th>Assigned to</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($issues))
                        @foreach($issues as $issue)
                            <tr>
                                <td>{{$issue->id}}</td>
                                <td>{{$issue->name}}</td>
                                <td>{{$issue->description}}</td>
                                <td>{{$issue->createdBy->name}}</td>
                                <td>{{$issue->assignedTo->name}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
