<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function thongke_range_date(Request $request)
    {
        $result = [];

        $benhthucte_groupBy = DB::connection('mysqldh')->table('dathen')
            ->selectRaw('
        BenhThucTe,
        count(dathen.ID_DatHen) as tong
        ')
            ->where([
                ['dathen.TinhTrang', '=', '0'],
                ['dathen.DaDen', '=', '1']
            ])
            ->whereDate('NgayGioDenKham', '>', $request->input('start'))
            ->whereDate('NgayGioDenKham', '<', $request->input('finish'))
            ->groupBy('dathen.BenhThucTe')
            ->get();



        $ajax_labels_benhthucte = [];
        $ajax_data_benhthucte = [];
        foreach ($benhthucte_groupBy as $item) {
            $ajax_benhthucte = $item->BenhThucTe != -1 ? $item->BenhThucTe : 'Khong XD';
            array_push($ajax_labels_benhthucte, $ajax_benhthucte);
            array_push($ajax_data_benhthucte, $item->tong);
        }

        $html = view('backend/thongke/timkiemtheothang',[
            'start' => $request->input('start'),
            'finish' => $request->input('finish')
        ])->render();

        $result['noidung'] = $html;

        $result['ajax_labels_benhthucte'] = $ajax_labels_benhthucte;
        $result['ajax_data_benhthucte'] = $ajax_data_benhthucte;


        return json_encode($result);
    }


    public function thongke_range_date_loaibenh(Request $request)
    {
        $result = [];

        $loaibenh_groupBy = DB::connection('mysqldh')->table('dathen')
        ->selectRaw('
        LoaiBenh,
        count(ID_DatHen) as tong
        ')
        ->where([
            ['TinhTrang','=','0'],
            ['DaDen','=','1']
        ])
        ->whereDate('NgayGioDenKham', '>', $request->input('start'))
            ->whereDate('NgayGioDenKham', '<', $request->input('finish'))
        ->groupBy('LoaiBenh')
        ->get();

        $ajax_labels_loaibenh = [];
        $ajax_data_loaibenh = [];
        foreach ($loaibenh_groupBy as $item) {
            $ajax_loaibenh = $item->LoaiBenh != -1 ? $item->LoaiBenh : 'Khong XD';
            array_push($ajax_labels_loaibenh, $ajax_loaibenh);
            array_push($ajax_data_loaibenh, $item->tong);
        }

        $html = view('backend/thongke/timkiemtheothang_loaibenh',[
            'start' => $request->input('start'),
            'finish' => $request->input('finish')
        ])->render();

        $result['noidung'] = $html;

        $result['ajax_labels_loaibenh'] = $ajax_labels_loaibenh;
        $result['ajax_data_loaibenh'] = $ajax_data_loaibenh;


        return json_encode($result);
    }
}
