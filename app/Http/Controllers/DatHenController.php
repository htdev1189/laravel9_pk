<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class DatHenController extends Controller
{

    public function index()
    {
        //Số người đặt hẹn trong tháng này
        $contact_current_month = DB::connection('mysqldh')->table('dathen')
        ->selectRaw('
        count(dathen.ID_DatHen) as total
        ')
        ->whereYear('dathen.NgayGioDatHen',2022)
        ->whereMonth('dathen.NgayGioDatHen',7)
        ->get();

        // so nguoi lien he va den kham ngay trong tháng đó
        $contactAndorder_current_month = DB::connection('mysqldh')->table('dathen')
        ->selectRaw('
        count(dathen.ID_DatHen) as total
        ')
        ->whereYear('dathen.NgayGioDatHen',2022)
        ->whereMonth('dathen.NgayGioDatHen',7)
        ->whereYear('dathen.NgayGioDenKham',2022)
        ->whereMonth('dathen.NgayGioDenKham',7)
        ->get();

        // so nguoi dat hen va khong den kham trong tháng đó
        $contactAndNotorder_current_month = DB::connection('mysqldh')->table('dathen')
        ->selectRaw('
        count(dathen.ID_DatHen) as total
        ')
        ->whereYear('dathen.NgayGioDatHen',2022)
        ->whereMonth('dathen.NgayGioDatHen',7)
        ->where('dathen.NgayGioDenKham','not like','2022-07%')
        ->get();

        // Đặt hẹn tới trong tháng
        $order_current_month = DB::connection('mysqldh')->table('dathen')
        ->selectRaw('
        count(dathen.ID_DatHen) as total
        ')
        ->whereYear('dathen.NgayGioDenKham',2022)
        ->whereMonth('dathen.NgayGioDenKham',7)
        ->get();


        // Đã tới khám trong tháng
        $came_current_month = DB::connection('mysqldh')->table('dathen')
        ->selectRaw('
        count(dathen.ID_DatHen) as total
        ')
        ->where([
            ['dathen.TinhTrang','=','0'],
            ['dathen.DaDen','=','1'],
        ])
        ->whereYear('dathen.NgayGioDenKham',2022)
        ->whereMonth('dathen.NgayGioDenKham',7)
        ->get();

        // Hủy tới khám
        $cancel_current_month = DB::connection('mysqldh')->table('dathen')
        ->selectRaw('
        count(dathen.ID_DatHen) as total
        ')
        ->where([
            ['dathen.TinhTrang','<>','0'],
        ])
        ->whereYear('dathen.NgayGioDenKham',2022)
        ->whereMonth('dathen.NgayGioDenKham',7)
        ->get();

        // Đang tới
        $comming_current_month = DB::connection('mysqldh')->table('dathen')
        ->selectRaw('
        count(dathen.ID_DatHen) as total
        ')
        ->where([
            ['dathen.TinhTrang','=','0'],
            ['dathen.DaDen','<>','1'],
        ])
        ->whereYear('dathen.NgayGioDenKham',2022)
        ->whereMonth('dathen.NgayGioDenKham',7)
        ->get();


        $all_bstv = DB::connection('mysqldh')->table('bstv')->where('status',1)->get();



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
            'tong_denkham_2022' => $tong_denkham_2022,
            'came_current_month' => $came_current_month[0]->total,
            'order_current_month' => $order_current_month[0]->total,
            'cancel_current_month' => $cancel_current_month[0]->total,
            'comming_current_month' => $comming_current_month[0]->total,
            'contact_current_month' => $contact_current_month[0]->total,
            'contactAndorder_current_month' => $contactAndorder_current_month[0]->total,
            'contactAndNotorder_current_month' => $contactAndNotorder_current_month[0]->total,
            
        ]);
    }


    // thong ke theo thang
    public function month_statistical()
    {
        $benhthucte_groupBy = DB::connection('mysqldh')->table('dathen')
        ->selectRaw('
        BenhThucTe,
        count(dathen.ID_DatHen) as tong
        ')
        ->where([
            ['dathen.TinhTrang','=','0'],
            ['dathen.DaDen','=','1']
        ])
        ->whereYear('dathen.NgayGioDenKham','2022')
        ->whereMonth('dathen.NgayGioDenKham','7')
        ->groupBy('dathen.BenhThucTe')
        ->get();

        $loaibenh_groupBy = DB::connection('mysqldh')->table('dathen')
        ->selectRaw('
        LoaiBenh,
        count(dathen.ID_DatHen) as tong
        ')
        ->where([
            ['dathen.TinhTrang','=','0'],
            ['dathen.DaDen','=','1']
        ])
        ->whereYear('dathen.NgayGioDenKham','2022')
        ->whereMonth('dathen.NgayGioDenKham','7')
        ->groupBy('dathen.LoaiBenh')
        ->get();

        return view('backend/thongke/month',[
            'benhthucte_groupBy' =>$benhthucte_groupBy,
            'loaibenh_groupBy' =>$loaibenh_groupBy
        ]);
    }
}
