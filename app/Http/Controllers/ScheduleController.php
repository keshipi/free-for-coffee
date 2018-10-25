<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use App\Repositories\ScheduleRepository;
use App\Repositories\SlotsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /** @var ScheduleRepository */
    private $scheduleRepo;

    /** @var SlotsRepository */
    private $slotsRepo;

    public function __construct(ScheduleRepository $scheduleRepo, SlotsRepository $slotsRepo)
    {
        $this->scheduleRepo = $scheduleRepo;
        $this->slotsRepo = $slotsRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 6;

        $schedule = $this->scheduleRepo->fetchTomorrow($id);
        
        return view('schedule')
            ->with('tomorrow', Carbon::tomorrow())
            ->with('slots', TimeSlot::getTimeSlot())
            ->with('schedule', $schedule);
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
        $id = 6;

        $slots = $this->slotsRepo->new($request->input('slots'));

        $schedule = $this->scheduleRepo->fetchTomorrow($id);

        if (!$schedule) {
            $tomorrow = Carbon::tomorrow()->format(config('app.date_format_db'));
            $schedule = $this->scheduleRepo->new($id, $tomorrow, $slots);
            $this->scheduleRepo->save($schedule);
        } else {
            $this->slotsRepo->update($schedule->getId(), $slots);
        }

        return redirect()->route('schedule.index');
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
