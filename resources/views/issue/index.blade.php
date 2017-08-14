@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/easy-table-filter.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
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
                                @if (count($issues))
                                    @foreach($issues as $issue)
                                        <tr data-status="pendiente">
                                            <td>
                                            </td>
                                            <td>
                                            {{$issue->assignedTo->name}}
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <a href="#" class="pull-left">
                                                        <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                    </a>
                                                    <div class="media-body">
                                                        <span class="media-meta pull-right">{{$issue->created_at}}</span>
                                                        <h4 class="title">
                                                            {{$issue->name}}
                                                            <span class="pull-right {{ getStatusClass($issue->status) }}">{{ $issue->statusDesc->name }}</span>
                                                        </h4>
                                                        <p class="summary">{{$issue->description}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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

@endsection
