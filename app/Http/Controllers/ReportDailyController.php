<?php

namespace App\Http\Controllers;

use App\Models\ReportDaily;
use Illuminate\Http\Request;

class ReportDailyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.report.index');
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
        dd($request->all());
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
