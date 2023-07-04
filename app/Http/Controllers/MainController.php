<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Mail\ContactUsMail;
use App\Mail\PostResumeMail;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;


class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);

        $newsletter = Newsletter::where('email', $request->email)->first();
        //dd(count($newsletter));

        if ($newsletter) {
            $newsletter->count = $newsletter->count + 1;
            $newsletter->update();

        } else {
            $data = ['email' => $request->email];
            $newsletter = new Newsletter();
            $newsletter->create($data);
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function PostMail(Request $request)
    {
        $request->validate([
            'email' => ['string', 'max:59', 'email'],
            'name' => ['string'],
            'subject' => ['string', 'max:255'],
            'body' => ['string'],
            //'resume' => ['required', File::types(['pdf', 'doc', 'docx'])]
        ]);

        $mail = [
            'email' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
            'body' => $request->body,
            //'resume' => $request->resume
        ];

        Mail::to(env('MAIL_TO_CONTACT'))->send(new ContactUsMail($mail));

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postResume(Request $request)
    {
        $request->validate([
            'email' => ['string', 'max:59', 'email'],
            'name' => ['string', 'min:4'],
            'subject' => ['string', 'max:255'],
            'body' => ['string'],
            'resume' => ['required', File::types(['pdf']), 'max:2500']
        ]);

        $file = $request->resume;
        $path = $file->store('resumes');

        $mail = [
            'email' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
            'body' => $request->body,
            'resume' => $path
        ];

        //dd(env('MAIL_TO_NAME'));
        //$resume = $request->resume;

        Mail::to(env('MAIL_TO_NAME', 'recrutement@paloma-sces.com'))->send(new PostResumeMail($mail));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
