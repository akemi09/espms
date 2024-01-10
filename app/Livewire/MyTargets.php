<?php

namespace App\Livewire;

use App\Models\Pcr;
use App\Models\Opcr;
use Livewire\Component;
use App\Models\TargetFuntion;

class MyTargets extends Component
{
    public $mfo_pap_id;
    public $targets = [];
    public $forApproval = 'no';

    public $modal_title = "";

    public function mount()
    {
        $result = Pcr::where('user_id', auth()->user()->id)
            ->where('status', Pcr::NEW)->first();

        if($result)
        {
            $this->forApproval = 'yes';
        }
    }

    public function addTarget()
    {
        array_push($this->targets, [
            'id' => 0,
            'title' => '',
            'parent_id' => 0,
            'accountable' => '',
        ]);

    }

    public function edit($id, $title)
    {
        activity()->log('Edit target');
        $this->modal_title = $title;
        $this->mfo_pap_id = $id;
        $pcrs = Pcr::where('user_id', auth()->user()->id)
            ->where('mfo_pap_id', $id)
            ->get();
        
        foreach ($pcrs as $pcr) {
            array_push($this->targets, [
                'id' => $pcr->id,
                'title' => $pcr->targets,
                'parent_id' => $pcr->parent_id,
                'accountable' => $pcr->accountable,
            ]);
        }

    }

    public function destroy($key)
    {
        activity()->log('Delete target');
        Pcr::where('id', $this->targets[$key]['id'])->delete();
        Opcr::where('id', $this->targets[$key]['id'])->delete();
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
        
        activity()->log('Update target');
        $this->validate();

        foreach ($this->targets as $target) {
            Pcr::updateOrCreate(
                ['id' => $target['id'], 'user_id' => auth()->user()->id],
                [
                    'mfo_pap_id' => $this->mfo_pap_id,
                    'targets' => $target['title'],
                    'accountable' => $target['accountable'],
                    'parent_id' => $target['parent_id'],
                    'status' => Pcr::NEW,
                ]
            );

            Opcr::updateOrCreate(
                ['id' => $target['id'], 'user_id' => auth()->user()->id],
                [
                    'mfo_pap_id' => $this->mfo_pap_id,
                    'targets' => $target['title'],
                    'accountable' => $target['accountable'],
                    'parent_id' => $target['parent_id'],
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

        $my_targets = Pcr::where('user_id', auth()->user()->id)
                        ->whereYear('created_at', now()->format('Y'))
                        ->get();

        return view('livewire.my-targets', compact('target_functions', 'mfo_paps', 'my_targets'));
    }
}
