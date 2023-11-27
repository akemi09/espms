<?php

namespace App\Http\Controllers;

use App\Models\Opcr;
use App\Models\Pcr;
use App\Models\User;
use App\Models\Signatories;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneratePdfController extends Controller
{
    public $strategic;
    public $core;
    public $support;
    public User $user;
    public $signed = '';
    public $type;

    public function __invoke($type, User $user)
    {

        $this->type = $type;
        $this->user = $user;
        if($type === 'ipcr')
        {
            $mfo_paps = Pcr::where('user_id', $user->id)->with('mfo_pap')->get();

            $this->checkIfSigned();
    
            $ipcr = collect($mfo_paps)->groupBy(['mfo_pap.target_function.name', 'mfo_pap.title']);
            $this->getRating();
            
            $pdf = Pdf::loadView('ipcr-pdf', [
                'ipcr' => $ipcr,
                'user' => $user,
                'strategic' => $this->strategic,
                'core' => $this->core,
                'support' => $this->support,
                'signed' => $this->signed
            ]);
            $pdf->setPaper('A4', 'landscape');
            $pdf->output();
            $domPdf = $pdf->getDomPDF();
  
            $canvas = $domPdf->get_canvas();
            $canvas->page_text(10, $canvas->get_height() - 20, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);


            return $pdf->stream('ipcr-pdf.pdf');

        } elseif ($type === 'opcr') {
            $mfo_paps = Opcr::where('user_id', $user->id)->with('mfo_pap')->get();

            $this->checkIfSigned();
    
            $opcr = collect($mfo_paps)->groupBy(['mfo_pap.target_function.name', 'mfo_pap.title']);
            $this->getRating();
            
            $pdf = Pdf::loadView('opcr-pdf', [
                'opcr' => $opcr,
                'user' => $user,
                'strategic' => $this->strategic,
                'core' => $this->core,
                'support' => $this->support,
                'signed' => $this->signed
            ]);
            $pdf->setPaper('A4', 'landscape');


            return $pdf->stream('opcr-pdf.pdf');
        } else {
            return false;
        }
        
        
    }

    public function checkIfSigned()
    {

        $signed = Signatories::where('pcr_owner_id', $this->user->id)
            ->where('signatory_id', auth()->user()->id)
            ->first();

        if ($signed)
        {
            $this->signed = $signed->signature;
        }
    }

    public function getRating()
    {
        if ($this->type === 'ipcr')
        {
            $pcrs = Pcr::where('user_id', $this->user->id)
                ->whereYear('created_at', now()->format('Y-m-d'))
                ->where('status', Pcr::APPROVED)
                ->with('mfo_pap')
                ->get();
        }

        if ($this->type === 'opcr')
        {
            $pcrs = Opcr::where('user_id', $this->user->id)
                ->whereYear('created_at', now()->format('Y-m-d'))
                ->where('status', Pcr::APPROVED)
                ->with('mfo_pap')
                ->get();
        }
        
        if (count($pcrs) > 0)
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
}
