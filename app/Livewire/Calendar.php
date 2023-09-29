<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\CarbonPeriod;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use App\Models\Calendar as Calendars;
use App\Models\CalendarRange;

class Calendar extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $query = '';

    public $event_id;

    #[Rule('required|string')]
    public $event_name = '';

    #[Rule('required|date|after_or_equal:today')]
    public $event_from = '';

    #[Rule('required|date|after_or_equal:event_from')]
    public $event_end = '';

    public function search()
    {
        $this->resetPage();
    }

    public function store()
    {
        $this->validate();

        $isDefined = CalendarRange::whereIn('date_range', [$this->event_from, $this->event_end])->first();

        if ($isDefined)
        {
            $this->addError('event_from', "Unable to set this date, as it has been designated within the '{$isDefined->calendar->event_name}' event.");
            return false;
        }


        $period = CarbonPeriod::create($this->event_from, $this->event_end);

       
        $calendar = Calendars::create([
            'user_id' => auth()->user()->id,
            'event_name' => $this->event_name,
            'event_from' => $this->event_from,
            'event_end' => $this->event_end
        ]);

        foreach ($period as $date) {
            $calendar->calendar_range()->create([
                'date_range' => $date->format('Y-m-d')
            ]);
        }

        session()->flash('success', 'Event created.');

        $this->redirect(Calendar::class);
    }

    public function edit($id)
    {
        $calendar = Calendars::find($id);
        $this->event_id = $calendar->id;
        $this->event_name = $calendar->event_name;
        $this->event_from = $calendar->event_from;
        $this->event_end = $calendar->event_end;
    }

    public function update()
    {
        $this->validate();

        $calendar = Calendars::find($this->event_id);
        $calendar->event_name = $this->event_name;
        $calendar->event_from = $this->event_from;
        $calendar->event_end = $this->event_end;
        $calendar->save();

        session()->flash('success', 'Event updated.');

        $this->redirect(Calendar::class);
    }

    public function destroy($id)
    {
        Calendars::find($id)->delete();

        session()->flash('success', 'Event deleted.');

        $this->redirect(Calendar::class);
    }

    public function cancel()
    {
        $this->event_name = '';
        $this->event_from = '';
        $this->event_end = '';
        $this->resetValidation();
    }
    
    public function render()
    {
        $calendars = Calendars::where('event_name', 'like', '%'.$this->query.'%')
                    ->orWhere('event_from', 'like', '%'.$this->query.'%')
                    ->orWhere('event_end', 'like', '%'.$this->query.'%')
                    ->paginate(10);
        return view('livewire.calendar', compact('calendars'));
    }
}
