<?php

namespace App\Http\Controllers;

use App\ScheduleDate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 1;

        // 明日の自分の予定を取得
        $tomorrow = Carbon::tomorrow()->format(config('app.date_format_db'));
        $schedule = ScheduleDate::where('user_id', $id)->where('date', $tomorrow)->first();
        $mySlots = isset($schedule->scheduleDateSlots) ? $schedule->scheduleDateSlots->pluck('slot') : collect();
        
        // 明日のタイムスロットを作成
        $slots = [];
        $start = new Carbon($tomorrow . ' ' . config('app.operation_start'));
        $end = new Carbon($tomorrow . ' ' . config('app.operation_end'));
        while ($start->lt($end)) {
            $slots[] = $start->format('H:i');
            $start->addMinutes(config('app.slot_length'));
        }

        return view('home')
            ->with('tomorrow', $tomorrow)
            ->with('slots', $slots)
            ->with('mySlots', $mySlots);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ScheduleDate  $scheduleDate
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleDate $scheduleDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ScheduleDate  $scheduleDate
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleDate $scheduleDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScheduleDate  $scheduleDate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleDate $scheduleDate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScheduleDate  $scheduleDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleDate $scheduleDate)
    {
        //
    }
}
