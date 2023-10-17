<?php

namespace App\Livewire;

use App\Models\Pcr;
use Livewire\Component;

class Ipcr extends Component
{
    public $ipcr_id;

    public $actual_accomplishment = "";
    public $q1;
    public $e2;
    public $t3;
    public $a4;

    public function rate($id)
    {
        $pcr = Pcr::find($id);
        $this->ipcr_id = $pcr->id;
        $this->actual_accomplishment = $pcr->actual_accomplishments;
        $this->q1 = $pcr->q1;
        $this->e2 = $pcr->e2;
        $this->t3 = $pcr->t3;
        $this->a4 = $pcr->a4;
    }

    public function save()
    {
        $pcr = Pcr::find($this->ipcr_id);
        $pcr->actual_accomplishments = $this->actual_accomplishment;
        $pcr->q1 = $this->q1;
        $pcr->e2 = $this->e2;
        $pcr->t3 = $this->t3;
        $pcr->a4 = $this->a4;
        $pcr->save();
        session()->flash('success', 'Updated');
    }

    public function cancel()
    {
        $this->ipcr_id = null;
    }

    public function render()
    {
        $pcrs = Pcr::where('user_id', auth()->user()->id)
            ->whereYear('created_at', now()->format('Y-m-d'))
            ->where('status', Pcr::APPROVED)
            ->get();
        return view('livewire.ipcr', compact('pcrs'));
    }
}
