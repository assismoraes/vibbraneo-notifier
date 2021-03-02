<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Utils\RequestUtil;
use App\Http\Requests\SaveEmailTemplateRequest;
use App\Models\EmailTemplate;

class EmailTemplateController extends Controller
{
    public function list(Request $r) {
        $templates = Auth::user()->emailTemplates()->get();

        return RequestUtil::isFromApi($r) ? $templates : view('email-templates.list', compact(['templates']));
    }

    public function new() {
        return view('email-templates.form');
    }

    public function save(SaveEmailTemplateRequest $r) {

        $file = $r->file('template');
        $content = file_get_contents($file);

        $template = EmailTemplate::create([
            'name' => $r['name'],
            'content' => $content,
            'user_id' => Auth::user()->id
        ]);

        return RequestUtil::isFromApi($r) ? $template : redirect(route('email-templates-list'))->with('successMessage', 'Email template saved successfully');
    }

    public function detail(Request $r, $id) {
        $template = Auth::user()->emailTemplates()->where('id', '=', $id)->first();

        return RequestUtil::isFromApi($r) ? $template : view('email-templates.detail', compact(['template']));
    }

    public function delete(Request $r, $id) {
        $template = Auth::user()->emailTemplates()->where('id', '=', $id)->first();

        if(!empty($template)) $template->delete();

        return RequestUtil::isFromApi($r) ? response(['message' => 'Email template deleted successfully']) : redirect(route('email-templates-list'))->with('successMessage', 'Email template deleted successfully');
    }
}
