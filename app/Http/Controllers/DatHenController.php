<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DatHenController extends Controller
{

    public function index()
    {
        $all_bstv = DB::connection('mysqldh')->table('bstv')->where('status',1)->get();

        // group by idCK

        // SELECT chuyenkhoa.TenCK, COUNT(dathen.ID_DatHen) 
        // FROM chuyenkhoa
        // JOIN dathen on dathen.idCK = chuyenkhoa.idCK
        // WHERE dathen.DaDen = 1 and dathen.TinhTrang = 0 and year(dathen.NgayGioDenKham) = 2022
        // GROUP BY chuyenkhoa.idCK;

        // lấy thống kê theo năm 2022
        //tong den kham (tinh trang = 0, daden = 1)
        $tong_denkham_2022 = DB::connection('mysqldh')->table('chuyenkhoa')
        ->selectRaw('
        chuyenkhoa.idCK,
        chuyenkhoa.TenCK, 
        count(dathen.ID_DatHen) as tong
        ')
        ->leftJoin('dathen','chuyenkhoa.idCK','=','dathen.idCK')
        ->where([
            ['dathen.TinhTrang','=','0'],
            ['dathen.DaDen','=','1']
        ])
        ->whereYear('dathen.NgayGioDenKham','2022')
        ->groupBy('chuyenkhoa.idCK')
        ->get();
        // dd($tong_denkham_2022);

        return view('backend/thongke/all',[
            'all_bstv' => $all_bstv,
            'tong_denkham_2022' => $tong_denkham_2022
        ]);
    }
}
