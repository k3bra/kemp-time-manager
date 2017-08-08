<?php

namespace App\Http\Controllers;


class ProjectController extends Controller
{

    /**
     * ProjectController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('project.index');
    }

    public function showSubmit() {
        return view('project.create');
    }

    public function submit() {
        return view('project.create');
    }

}