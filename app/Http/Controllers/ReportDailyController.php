<?php

namespace App\Http\Controllers;

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
        $cek_date = ReportDaily::where('user_id', Auth::user()->id)->where('date',date('Y-m-d'))->first();
        if($cek_date){
            $status = 1;
            $report_decode = json_decode($cek_date->report);
        }
        else{
            $status = 0;
            $report_decode = null;
        }
        if(Auth::user()->jabatanAttribute != null){
            $position_job = Auth::user()->jabatanAttribute->divisi;
            $detail_job = json_decode($position_job->tugas);
            $count = count($detail_job->tugas);
            return view('member.report.index',[
                'status' => $status,
                'data'=>$cek_date,
                'count' => $count != null ? $count : 0,
                'detail_job' => $detail_job != null ? $detail_job : [],
                'position_job' => $position_job != null ? $position_job : [],
                'reports' => $report_decode
            ]);
        }else{
            return view('member.report.index',[
                'status' => $status,
                'data'=>$cek_date,
                'reports' => $report_decode
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        if($cek_date){
            // dd('true');
            return redirect()->route('member.reportDaily.index')->with(['message' => 'Data sudah ada.']);
        }
        else{
            // dd('false');
            $score = $request->score;
            $id_report = $request->id;
            $note = $request->note;
    
            $array_save = array();
            for($i=0;$i<count($request->id);$i++){
                $array_save[$i]['score'] = $score[$i];
            }
    
            $daily = new ReportDaily;
            $daily->user_id = Auth::user()->id;
            $daily->note = $note;
            $daily->position_id = Auth::user()->position_id;
            $daily->date = date('Y-m-d');
            $daily->report = json_encode($array_save);
            $daily->save();
    
    
            return redirect()->route('member.dashboard')->with(['message' => 'Berhasil menambah data DAP.']);
            
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportDaily  $reportDaily
     * @return \Illuminate\Http\Response
     */
    public function show(ReportDaily $reportDaily)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportDaily  $reportDaily
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportDaily $reportDaily)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportDaily  $reportDaily
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportDaily $reportDaily)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportDaily  $reportDaily
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportDaily $reportDaily)
    {
        //
    }
}
