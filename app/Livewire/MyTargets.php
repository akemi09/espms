<?php

namespace App\Livewire;

use App\Models\Pcr;
use App\Models\TargetFuntion;
use Livewire\Component;

class MyTargets extends Component
{
    public $mfo_pap_id;
    public $targets = [];


    public function addTarget()
    {
        array_push($this->targets, [
            'id' => 0,
            'title' => '',
        ]);

    }

    public function edit($id)
    {
        $this->mfo_pap_id = $id;
        $pcrs = Pcr::where('user_id', auth()->user()->id)
            ->where('mfo_pap_id', $id)
            ->get();
        
        foreach ($pcrs as $pcr) {
            array_push($this->targets, [
                'id' => $pcr->id,
                'title' => $pcr->targets
            ]);
        }

    }

    public function destroy($key)
    {
        Pcr::where('id', $this->targets[$key]['id'])->delete();
        unset($this->targets[$key]);

        session()->flash('success', 'Deleted.');
    }

    public $rules = [
        'targets.*.id' => 'nullable',
        'targets.*.title' => 'required|string'
    ];

    public $messages = [
        'targets.*.title' => 'The target title is required.'
    ];

    public function update()
    {
        
        $this->validate();

        foreach ($this->targets as $target) {
            Pcr::updateOrCreate(
                ['id' => $target['id'], 'user_id' => auth()->user()->id],
                [
                    'mfo_pap_id' => $this->mfo_pap_id,
                    'targets' => $target['title'],
                    'status' => Pcr::NEW,
                ]
            );
        }

        session()->flash('success', 'Updated.');

    }

    public function cancel()
    {
        $this->mfo_pap_id = "";
        $this->targets = [];

        $this->resetValidation();
    }
    
    public function render()
    {
        $target_functions = TargetFuntion::orderBy('id', 'asc')->get();

        $mfo_paps = auth()->user()->office->mfo_paps;

        $mfo_paps = $mfo_paps->groupBy('target_function_id');

        $target_counts = Pcr::where('user_id', auth()->user()->id)
                        ->whereYear('created_at', now()->format('Y'))
                        ->count();

        return view('livewire.my-targets', compact('target_functions', 'mfo_paps', 'target_counts'));
    }
}
