<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ajifatur\Helpers\DateTimeExt;
use App\Models\Attendance;
use App\Models\Absent;
use App\Models\Leave;
use App\Models\User;

class AttendanceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        // Set params
        $category = $request->query('category') != null ? $request->query('category') : 1;
        $month = $request->query('month') != null ? $request->query('month') : date('m');
        $year = $request->query('year') != null ? $request->query('year') : date('Y');

        // Get the user
        $user = User::findOrFail(Auth::user()->id);

        // Set default date
        $dt1 = $month > 1 ? date('Y-m-d', strtotime($year.'-'.($month-1).'-'.$user->group->period_start)) : date('Y-m-d', strtotime(($year-1).'-12-'.$user->group->period_start));
        $dt2 = date('Y-m-d', strtotime($year.'-'.$month.'-'.$user->group->period_end));

        // Get attendances
        $attendances = Attendance::where('user_id','=',$user->id)->whereDate('date','>=',$dt1)->whereDate('date','<=',$dt2)->orderBy('date','desc')->get();

        // Count attendances
        $count[1] = $attendances->count();

        // Get late attendances
        $late = 0;
        foreach($attendances as $key=>$attendance) {
            $date = $attendance->start_at <= $attendance->end_at ? $attendance->date : date('Y-m-d', strtotime('-1 day', strtotime($attendance->date)));
            if(strtotime($attendance->entry_at) >= strtotime($date.' '.$attendance->start_at) + 60) $late++;
            if($category == 2) if(strtotime($attendance->entry_at) < strtotime($date.' '.$attendance->start_at) + 60) $attendances->forget($key);
        }

        // Count late attendances
        $count[2] = $late;

        // Get absents
        $absents1 = Absent::where('user_id','=',$user->id)->where('category_id','=',1)->where('date','>=',$dt1)->where('date','<=',$dt2)->orderBy('date','desc')->get();
        $absents2 = Absent::where('user_id','=',$user->id)->where('category_id','=',2)->where('date','>=',$dt1)->where('date','<=',$dt2)->orderBy('date','desc')->get();
        if($category == 3) $attendances = $absents1;
        if($category == 4) $attendances = $absents2;

        // Get leaves
        $leaves = Leave::where('user_id','=',$user->id)->where('date','>=',$dt1)->where('date','<=',$dt2)->orderBy('date','desc')->get();
        if($category == 5) $attendances = $leaves;

        // Count absents
        $count[3] = count($absents1);
        $count[4] = count($absents2);
        $count[5] = count($leaves);

        // View
        return view('member/attendance', [
            'category' => $category,
            'month' => $month,
            'year' => $year,
            'user' => $user,
            'dt1' => $dt1,
            'dt2' => $dt2,
            'attendances' => $attendances,
            'count' => $count,
        ]);
    }
}
