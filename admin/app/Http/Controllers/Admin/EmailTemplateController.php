<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;

class EmailTemplateController extends Controller
{
    /**
     * Show the email template form.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $emailTemplate = EmailTemplate::where('code', 'signup-email')->first();

        return view('email_templates', compact('emailTemplate'));
    }

    /**
     * Update the email template.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

$name = $request->input('name');

$content = $request->input('content');
$facebook = $request->input('facebook');
$twitter = $request->input('twitter');
$instagram = $request->input('instagram');
$linkedin = $request->input('linkedin');
$pinterest = $request->input('pinterest');

        EmailTemplate::updateOrCreate(['code' => 'signup-email'], [
            'name' => $name,
            'content' => $content,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'instagram' => $instagram,
            'linkedin' => $linkedin,
            'pinterest' => $pinterest
        ]);


        
        return redirect()->route('emailTemplateShow')->with('success', 'Email template updated successfully!');
    }
}
