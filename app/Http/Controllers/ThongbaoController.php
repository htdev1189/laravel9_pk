<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// event
use App\Events\NoticeEvent;

class ThongbaoController extends Controller
{
    public function add()
    {
        return view('backend/thongbao/add');
    }

    public function store(Request $request)
    {
        event(new NoticeEvent('hello world'));
    }
}
