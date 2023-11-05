<?php

namespace App\Livewire;

use App\Models\Pcr;
use Livewire\Component;
use Livewire\WithPagination;

class TargetApproval extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $pcr_users = Pcr::select('user_id')
            ->whereYear('created_at', now()->format('Y'))
            ->with('user')
            ->groupBy('user_id')
            ->paginate(10);

        return view('livewire.target-approval', compact('pcr_users'));
    }
}
