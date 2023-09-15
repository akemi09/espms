<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Calendar;

class Dashboard extends Component
{
    public function render()
    {
        $calendars = Calendar::whereYear('created_at', Carbon::now()->year)->get();
        $calendar_data_array = [];
        foreach ($calendars as $calendar) {
            $calendar_data_array[] = [
                'title' => $calendar->event_name,
                'start' => Carbon::parse($calendar->event_from)->format('Y-m-d'),
                'end' => Carbon::parse($calendar->event_end)->addDays(1)->format('Y-m-d'),
            ];
        }
        $data = json_encode($calendar_data_array);

        return view('livewire.dashboard', compact('data'));
    }
}
