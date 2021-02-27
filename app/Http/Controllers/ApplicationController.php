<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Auth;
use App\Http\Requests\SaveApplicationRequest;

class ApplicationController extends Controller
{
    public function list() {
        $applications = Auth::user()->applications()->get();

        return view('applications.list', compact(['applications']));
    }

    public function new() {
        return view('applications.form');
    }

    public function create(SaveApplicationRequest $r) {
        Application::create([
            'name' => $r['name'],
            'uses_web_push' => $r->has('uses_web_push'),
            'uses_email' => $r->has('uses_email'),
            'uses_sms' => $r->has('uses_sms'),
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('applications-list'))->with('successMessage', 'Application saved successfully');
    }

    public function edit($id) {
        $application = Auth::user()->applications()->where('id', '=', $id)->first();
        return view('applications.form', compact(['application']));
    }

    public function update(SaveApplicationRequest $r, $id) {
        $application = Auth::user()->applications()->where('id', '=', $id)->first();
        $application->name = $r->name;
        $application->uses_web_push = $r->has('uses_web_push');
        $application->uses_email = $r->has('uses_email');
        $application->uses_sms = $r->has('uses_sms');
        $application->save();

        return redirect(route('applications-list'))->with('successMessage', 'Application saved successfully');
    }

    public function detail($id) {
        $application = Auth::user()->applications()->where('id', '=', $id)->first();

        return view('applications.detail', compact(['application']));
    }
}
