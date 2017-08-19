@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/easy-table-filter.css') }}" rel="stylesheet">
@endsection

@section('content')
    <issues-list></issues-list>
@endsection

