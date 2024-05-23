<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    protected $week = ["日","月","火","水","木","金","土"];
    public function show(Request $request,$target_month)
    {
        $year = Carbon::parse($target_month)->format("Y");
        $month = Carbon::parse($target_month)->format("m");
        $calendar_ym = Carbon::create($year,$month,1,0,0,0);

        $startDay = $calendar_ym->copy()->subMonth()->endOfMonth()->previous(Carbon::SUNDAY);
        $endDay = $calendar_ym->copy()->addMonth()->firstOfMonth()->next(Carbon::SATURDAY);

        $days = [];
        $currentDay = $startDay->copy();
        while ($currentDay->lte($endDay)) {
            $days[] = $currentDay->copy();
            $currentDay->addDay();
        }

        return view("calendar",compact("target_month","days"));
    }
}
