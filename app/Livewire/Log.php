<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class Log extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $logs = Activity::orderBy('id', 'desc')->paginate(10);
        
        return view('livewire.log', [
            'logs' => $logs,
        ]);
    }
}
