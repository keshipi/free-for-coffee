<?php

namespace App\Http\Controllers;

use App\Repositories\ScheduleRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    /** @var ScheduleRepository */
    private $scheduleRepo;

    /** @var UserRepository */
    private $userRepo;

    public function __construct(ScheduleRepository $scheduleRepo, UserRepository $userRepo)
    {
        $this->scheduleRepo = $scheduleRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();

        $partners = $this->userRepo->fetchPertners($id);
        return view('partners')
            ->with('partners', $partners);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepo->getUser($id);
        if (!$user) {
            abort(500);
        }

        // fetch my tomorrow schedule
        $myId = Auth::id();
        $mySchedule = $this->scheduleRepo->fetchTomorrow($myId);
        // fetch partner's tomorrow schedule
        $schedule = $this->scheduleRepo->fetchTomorrow($user->getId());
        // should exist
        if (!$mySchedule || !$schedule) {
            abort(500);
        }

        return view('candidates')
            ->with('user', $user)
            ->with('candidates', $mySchedule->matchSlots($schedule->getSlots()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
