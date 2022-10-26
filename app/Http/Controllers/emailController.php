<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// email
use Illuminate\Support\Facades\Mail;
use App\Mail\hkt2Mail;

class emailController extends Controller
{
    public function write()
    {
        return view('backend/mail/write');
    }

    public function send(Request $request)
    {
        $request->validate([
            'to' => 'required|email',
            'content' => 'required',
            'title' => 'required',
        ], [
            'to.required' => 'Email không được để trống',
            'to.email' => 'Dinh dang mail sai',
            'content.required' => 'noi dung khong dc de trong',
            'title.required' => 'title khong dc de trong'
        ]);

        $data = $request->input();

        // mac dinh dung content mac dinh cua Mail
        // Mail::to($data['to'])->send(new hktMail());

        // thay doi content theo y minh
        Mail::to($data['to'])->send(new hkt2Mail($data['title'],$data['content']));

        $request->session()->flash('status', 'Send mail to '.$data['to']. ' success');
        return redirect('/admin/dashboard');
    }
}
