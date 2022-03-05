<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $settings = settings()->getMany([
            'uploaded_logo', 'app_title',
            'company_name', 'company_address',
            'company_telephone', 'company_email', 'company_website', 'operating_year'
        ]);

        $form = $settings;

        return view('settings.index')->with(['form' =>$form]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'app_title' => 'nullable|max:255',
            'uploaded_logo' => 'nullable|image|max:2048',
            'company_name' => 'nullable|max:255',
            'company_address' => 'nullable|max:255',
            'company_telephone' => 'nullable|max:255',
            'company_email' => 'nullable|email',
            'company_website' => 'nullable|max:255',
            'operating_year'    => 'nullable'
        ]);

        // upload document if exists
        $this->uploadIfExist('uploaded_logo', 'uploaded_logo');

        settings()->setMany($request->only([
            'app_title', 'company_name', 'company_address', 'company_telephone',
            'company_email', 'company_website', 'operating_year',
        ]));

        return redirect()->route('settings.index');
    }

    protected function uploadIfExist($settings, $file)
    {
        if (request()->hasFile($file) && request()->file($file)->isValid()) {
            // store in public uploads folder by default
            if ($fileName = uploadFile(request()->file($file))) {
                // overwrite previous uploaded file
                deleteFile(settings()->get($settings));
                settings()->set($settings, $fileName);

                return $fileName;
            }
        }
    }
}
