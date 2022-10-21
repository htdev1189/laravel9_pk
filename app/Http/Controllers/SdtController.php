<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TongDai;

class SdtController extends Controller
{
    protected $numbers;
    public function __construct()
    {
        $this->numbers = TongDai::all();
    }
    public function getAll()
    {
        return view('backend/tongdai/list', [
            'numbers' => $this->numbers
        ]);
    }

    public function send(Request $request)
    {
        $data = $request->input();
        $tongdai = new TongDai();
        $tongdai->number = $data['sodienthoai'];
        $tongdai->ip = $request->ip();
        $tongdai->save();

        echo "<script>";
        echo "alert('so dien thoai cua ban da duoc gui di');";
        echo "window.location.href = '". url()->previous() ."'";
        echo "</script>";
    }
}
