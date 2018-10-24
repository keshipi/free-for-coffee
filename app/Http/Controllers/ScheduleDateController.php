<?php

namespace App\Http\Controllers;

use App\ScheduleDate;
use App\ScheduleDateSlot;
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
        $tomorrow = Carbon::tomorrow();
        $schedule = ScheduleDate::where('user_id', $id)
            ->where('date', $tomorrow->format(config('app.date_format_db')))
            ->first();
        $mySlots = isset($schedule->scheduleDateSlots) ? $schedule->scheduleDateSlots->pluck('slot') : collect();
        
        // 明日のタイムスロットを作成
        $slots = [];
        $start = new Carbon($tomorrow->format(config('app.date_format_db')) . ' ' . config('app.operation_start'));
        $end = new Carbon($tomorrow->format(config('app.date_format_db')) . ' ' . config('app.operation_end'));
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
        $id = 1;

        $tomorrow = $request->input('tomorrow');
        $scheduleDate = ScheduleDate::where('user_id', $id)
            ->where('date', $tomorrow)
            ->first();

        \DB::beginTransaction();
        try {
            if (!$scheduleDate) {
                $scheduleDate = new ScheduleDate();
                $scheduleDate->user_id = $id;
                $scheduleDate->date = $tomorrow;
                $scheduleDate->save();
            } else {
                $scheduleDate->touch();
                ScheduleDateSlot::where('schedule_date_id', $scheduleDate->id)->delete();
            }

            if ($request->input('slots')) {
                $slots = [];
                foreach ($request->input('slots') as $slot) {
                    $slots[] = ['slot' => $slot];
                }
                $scheduleDate->scheduleDateSlots()->createMany($slots);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            abort(500);
        }
        \DB::commit();

        return redirect()->route('date.index');
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
