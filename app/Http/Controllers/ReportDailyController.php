<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Attendance;
use App\Models\ReportDaily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportDailyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cek_sudah_absen = Attendance::select('id')->where('user_id', Auth::user()->id)->where('date', date('Y-m-d'))->where('exit_at','!=', null)->orderBy('id','desc')->first();
        $cek_date = ReportDaily::where('user_id', Auth::user()->id)->where('date',date('Y-m-d'))->first();
        $position_job = Auth::user()->jabatanAttribute->divisi;
        if($cek_date && $position_job->id != 18){
            $status = 1;
            $report_decode = json_decode($cek_date->report);
        }
        else{
            $status = 0;
            $report_decode = null;
        }
        
        if($position_job != null){
            
            $detail_job = json_decode($position_job->tugas);
            $count = count($detail_job);
            return view('member.report.index',[
                'status' => $status,
                'data'=>$cek_date,
                'count' => $count != null ? $count : 0,
                'detail_job' => $detail_job != null ? $detail_job : [],
                'position_job' => $position_job != null ? $position_job : [],
                'reports' => $report_decode,
                'cek_absen' => $cek_sudah_absen
            ]);
        }else{
            return view('member.report.index',[
                'count' => null ,
                'status' => $status,
                'data'=>$cek_date,
                'reports' => $report_decode,
                'cek_absen' => $cek_sudah_absen
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $cek_date = ReportDaily::where('user_id', Auth::user()->id)->where('date',date('Y-m-d'))->first();
        $cekAR = Divisi::where('id',18)->first();
        if($cek_date && $cekAR->id != Auth::user()->jabatanAttribute->division_id){
            // dd('true');
            return redirect()->route('member.reportDaily.index')->with(['message' => 'Data sudah ada.']);
        }
        else{
            $score = $request->score;
            $id_report = $request->id;
            $note = $request->note;
            $division_id = Auth::user()->jabatanAttribute->division_id;
            $array_save = array();
            for($i=0;$i<count($id_report);$i++){
                $array_save[$i]['id_tugas'] = $id_report[$i];
                $array_save[$i]['score'] = $score[$i];
            }

            $cek = Attendance::select('id')->where('user_id', Auth::user()->id)->where('date', date('Y-m-d'))->orderBy('id','desc')->first();
            
            $daily = new ReportDaily;
            $daily->user_id = Auth::user()->id;
            $daily->division_id = $division_id;
            $daily->attendance_id = $cek->id;
            $daily->note = $note;
            $daily->date = date('Y-m-d');
            $daily->report = json_encode($array_save);
            $daily->save();
    
    
            return redirect()->route('member.dashboard')->with(['message' => 'Berhasil menambah data DAP.']);
            
        }
        

    }


    public function reportList(Request $request)
    {
        $reports = ReportDaily::where('user_id', Auth::user()->id)->get();

        return view('member.report.reportlist',[
            'reports' => $reports
        ]);
    }
}
