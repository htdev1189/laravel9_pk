<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// event
use App\Events\NoticeEvent;

//model
use App\Models\Thongbao;
use App\Models\Admin;

// session 
// use Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ThongbaoController extends Controller
{

    public function push(Request $request)
    {
        $response = [];

        // lay so thong bao ma user hien tai chua doc
        $notice_not_seen = DB::table('thongbaos')
        ->where('to->'.Session::get('current_user')->id,'!=',1)
        ->get();

        $html = view('backend/thongbao/push',[
            'notice_not_seen' => $notice_not_seen
        ])->render();
        $response['noidung'] = $html;

        // tra ve ket qua hien thi modal
        return json_encode($response);
    }

    public function ajax(Request $request)
    {
        $data = $request->input();
        // danh dau trong phan seen la da doc r
        $notice = Thongbao::find($request->input('id'));
        //convert json to array
        $to_arr = json_decode($notice->to,true);
        foreach ($to_arr as $key => $value) {
            if ($key == Session::get('current_user')->id) {
                $to_arr[$key] = 1;
            }
        }

        $notice->to = json_encode($to_arr);
        $notice->save();

        $response = [];
        $html = view('backend/thongbao/modal',[
            'notice' => $notice
        ])->render();

        $response['noidung'] = $html;

        // tra ve ket qua hien thi modal
        return json_encode($response);
    }


    public function index(Request $request)
    {
        if (Session::get('current_user')->group == 1) {
            $allNotice =  Thongbao::all();
        } else {
            $allNotice =  DB::table('thongbaos')
            ->where('to->'.Session::get('current_user')->id,'!=',null)
            // ->whereJsonContains('to', strval(Session::get('current_user')->id))
            // ->whereJsonContains('to->4','!=',null)
            ->get();
        }

        return view('backend/thongbao/all', [
            'allNotice' => $allNotice
        ]);
    }
    public function add()
    {
        return view('backend/thongbao/add', [
            'allAdmin' => Admin::where('id', '<>', Session::get('current_user')->id)->get()
        ]);
    }

    public function store(Request $request)
    {

        $data = $request->input();

        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'content.required' => 'Nội dung không được để trống'
        ]);





        $notice = new Thongbao();

        $to = [];
        foreach ($data['to'] as $value) {
            $to[$value] = 0;
        }

        $notice->title = $data['title'];
        $notice->admin_id = $data['admin_id'];
        $notice->content = $data['content'];
        $notice->to = json_encode($to);
        $notice->save();

        event(new NoticeEvent('hello world'));

        return redirect('/admin/thongbao/all');
    }
}
