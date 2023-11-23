<?php

namespace App\Livewire;

use App\Models\Opcr as Op;
use Livewire\Component;

class Opcr extends Component
{
    public $ipcr_id;

    public $actual_accomplishment = "";
    public $q1;
    public $e2;
    public $t3;
    public $a4;

    public $strategic = 0;
    public $core = 0;
    public $support = 0;

    public function rate($id)
    {
        activity()->log('Rate OPCR');
        $pcr = Op::find($id);
        $this->ipcr_id = $pcr->id;
        $this->actual_accomplishment = $pcr->actual_accomplishments;
        $this->q1 = $pcr->q1;
        $this->e2 = $pcr->e2;
        $this->t3 = $pcr->t3;
        $this->a4 = $pcr->a4;
    }

    public function save()
    {
        activity()->log('Save IPCR');
        $count = count(array_filter([$this->q1, $this->e2, $this->t3], 'strlen'));
        $pcr = Op::find($this->ipcr_id);
        $pcr->actual_accomplishments = $this->actual_accomplishment;
        $pcr->q1 = ($this->q1 == "") ? null : $this->q1;
        $pcr->e2 = ($this->e2 == "") ? null : $this->e2;
        $pcr->t3 = ($this->t3 == "") ? null : $this->t3;
        $pcr->a4 = number_format(( (int)$this->q1 + (int)$this->e2 + (int)$this->t3 ) / $count, 2);
        $pcr->save();
        session()->flash('success', 'Updated');
    }

    public function cancel()
    {
        $this->ipcr_id = null;
    }

    public function ratings()
    {
        
        $pcrs = Op::where('user_id', auth()->user()->id)
            ->whereYear('created_at', now()->format('Y-m-d'))
            ->where('status', Op::APPROVED)
            ->with('mfo_pap')
            ->get();

        if (count($pcrs))
        {

            $data = [];
    
            foreach ($pcrs as $pcr) {
                if($pcr->mfo_pap->target_function->id == $pcr->mfo_pap->target_function_id)
                {
                    $data[] = [
                        'id' => $pcr->mfo_pap->target_function->id,
                        'pcr_id' => $pcr->id,
                        'q1' => $pcr->q1,
                        'e2' => $pcr->e2,
                        't3' => $pcr->t3,
                        'a4' => $pcr->a4
                    ];
                }
            }
    
            $pcr = collect($data)->groupBy('id');
    
            $groupwithcount = $pcr->map(function ($pcr) {
                return [
                    'count' => $pcr->where('a4', '!=', null)->count(),
                    'total' => (float)$pcr->sum('a4'),
                ];
            });

            if (isset($groupwithcount[1]))
            {
                $this->strategic = ($groupwithcount[1]['count'] != 0) ? ($groupwithcount[1]['total'] / $groupwithcount[1]['count']) * 0.45 : 0;
            }

            if (isset($groupwithcount[2]))
            {
                $this->core = ($groupwithcount[2]['count'] != 0) ? ($groupwithcount[2]['total'] / $groupwithcount[2]['count']) * 0.45 : 0;
            }

            if (isset($groupwithcount[3]))
            {
                $this->support = ($groupwithcount[3]['count'] != 0) ? ($groupwithcount[3]['total'] / $groupwithcount[3]['count']) * 0.10 : 0;
            }
    
        }

    }

    public function render()
    {
        $this->ratings();
        $pcrs = Op::where('user_id', auth()->user()->id)
            ->whereYear('created_at', now()->format('Y-m-d'))
            ->where('status', Op::APPROVED)
            ->get();
        return view('livewire.ipcr', compact('pcrs'));
    }
}
