<?php

namespace App\Livewire;

use App\Models\Pcr;
use App\Models\TargetFuntion;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TargetApprovalView extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function approve($id)
    {
        Pcr::where('id', $id)->update(['status' => Pcr::APPROVED]);

        session()->flash('success', 'Approved.');
    }

    public function disapprove($id)
    {
        Pcr::where('id', $id)->update(['status' => Pcr::DISAPPROVED]);

        session()->flash('success', 'Disapproved.');
    }

    public function render()
    {
        $pcrs = Pcr::where('user_id', $this->user->id)
            ->with('mfo_pap')
            ->get();

        $target_functions = TargetFuntion::orderBy('id', 'asc')->get();
    
        return view('livewire.target-approval-view', compact('pcrs', 'target_functions'));
    }
}
