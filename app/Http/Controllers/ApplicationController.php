<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Auth;
use App\Http\Requests\SaveApplicationRequest;
use App\Utils\RequestUtil;

class ApplicationController extends Controller
{
    public function list(Request $r) {
        $applications = Auth::user()->applications()->get();

        return RequestUtil::isFromApi($r) ? $applications : view('applications.list', compact(['applications']));
    }

    public function new() {
        return view('applications.form');
    }

    public function create(SaveApplicationRequest $r) {
        $application = Application::create([
            'name' => $r['name'],
            'uses_web_push' => $r->has('uses_web_push'),
            'uses_email' => $r->has('uses_email'),
            'uses_sms' => $r->has('uses_sms'),
            'user_id' => Auth::user()->id
        ]);

        return RequestUtil::isFromApi($r) ? $application : redirect(route('applications-list'))->with('successMessage', 'Application saved successfully');
    }

    public function edit($id) {
        $application = Auth::user()->applications()->where('id', '=', $id)->first();
        return view('applications.form', compact(['application']));
    }

    public function update(SaveApplicationRequest $r, $id) {
        $application = Auth::user()->applications()->where('id', '=', $id)->first();

        if(empty($application)) return RequestUtil::isFromApi($r) ? response(['message' => 'Application not fount'], 404) : redirect(route('applications-list'))->with('errorMessage', 'Application not found');

        $application->name = $r->name;
        $application->uses_web_push = $r->has('uses_web_push');
        $application->uses_email = $r->has('uses_email');
        $application->uses_sms = $r->has('uses_sms');
        $application->save();

        return RequestUtil::isFromApi($r) ? $application : redirect(route('applications-list'))->with('successMessage', 'Application saved successfully');
    }

    public function detail(Request $r, $id) {
        $application = Auth::user()->applications()->where('id', '=', $id)->first();

        return RequestUtil::isFromApi($r) ? $application : view('applications.detail', compact(['application']));
    }
}
