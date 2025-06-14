<?php

namespace App\Http\Controllers;

use App\Models\EmailSMSTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailTemplateController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $emailtemplates = EmailSMSTemplate::all()->sortBy("name");
        return view('backend.administration.email_template.list', compact('emailtemplates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        if (!$request->ajax()) {
            return view('backend.administration.email_template.create');
        } else {
            return view('backend.administration.email_template.modal.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'slug'         => 'required',
            'subject'      => 'required',
            'email_status' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('email_templates.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $emailtemplate               = new EmailSMSTemplate();
        $emailtemplate->name         = $request->input('name');
        $emailtemplate->slug         = $request->input('slug');
        $emailtemplate->subject      = $request->input('subject');
        $emailtemplate->email_body   = $request->input('email_body');
        $emailtemplate->email_status = $request->input('email_status');
        $emailtemplate->sms_status   = 0;
        $emailtemplate->shortcode    = $request->input('shortcode');

        $emailtemplate->save();

        if (!$request->ajax()) {
            return redirect()->route('email_templates.create')->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $emailtemplate]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $emailtemplate = EmailSMSTemplate::find($id);

        if (!$request->ajax()) {
            return view('backend.administration.email_template.view', compact('emailtemplate', 'id'));
        } else {
            return view('backend.administration.email_template.modal.view', compact('emailtemplate', 'id'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $emailtemplate = EmailSMSTemplate::find($id);

        if (!$request->ajax()) {
            return view('backend.administration.email_template.edit', compact('emailtemplate', 'id'));
        } else {
            return view('backend.administration.email_template.modal.edit', compact('emailtemplate', 'id'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'subject'      => 'required',
            'email_body'   => 'required',
            'email_status' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('email_templates.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $emailtemplate               = EmailSMSTemplate::find($id);
        $emailtemplate->name         = $request->input('name');
        $emailtemplate->subject      = $request->input('subject');
        $emailtemplate->email_body   = $request->input('email_body');
        $emailtemplate->email_status = $request->input('email_status');

        $emailtemplate->save();

        if (!$request->ajax()) {
            return redirect()->route('email_templates.index')->with('success', _lang('Updated successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully'), 'data' => $emailtemplate]);
        }
    }
}
