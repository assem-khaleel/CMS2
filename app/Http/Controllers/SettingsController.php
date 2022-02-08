<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.settings.settings')->with('settings', Setting::first());
    }

    public function update()
    {
        $this->validate(\request(), [
            'site_name' => 'required',
            'address' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required'
        ]);
        $settings = Setting::first();
        $settings->site_name = \request()->site_name;
        $settings->contact_number = \request()->contact_number;
        $settings->address = \request()->address;
        $settings->contact_email = \request()->contact_email;

        $settings->save();

        Session::flash('success', 'Settings updated Successfully');

        return redirect()->route('settings');

    }
}
