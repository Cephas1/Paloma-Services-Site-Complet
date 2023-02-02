<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

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
            'body' => ['string']
        ]);

        $mail = [
            'email' => $request->sender,
            'name' => $request->sender_name,
            'subject' => $request->subject,
            'body' => $request->body
        ];



        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
