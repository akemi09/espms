<?php

namespace App\Livewire;

use App\Models\Pcr;
use App\Models\Opcr;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TargetFuntion;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use App\Models\TargetAcknowledgement;

class TargetApprovalView extends Component
{
    use WithPagination;

    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    #[Rule('required|image|max:1024')] // 1MB Max
    public $signatureImage;


 
    public function save()  
    {
        $this->validate();

        $imgFile = $this->signatureImage->store('signature');

        TargetAcknowledgement::create([
            'user_id' => auth()->user()->id,
            'target_user_id' => 1,
            'date_time' => now()->format('Y-m-d H:i:s'),
            'sign_url' => $imgFile,
        ]);

        session()->flash('success', 'Success');

        return redirect()->route('target.approvals.index');
    }

    public User $user;

    public $isAcknowledge = 'no';
    public $target_acknowledgement;

    public function mount(User $user)
    {
        $target_acknowledge = TargetAcknowledgement::where('target_user_id', $user->id)->first();

        if ($target_acknowledge)
        {
            $this->isAcknowledge = 'yes';
        }

        $this->target_acknowledgement = $target_acknowledge;

        $this->user = $user;
    }

    public function approve($id)
    {
        Pcr::where('id', $id)->update(['status' => Pcr::APPROVED]);
        Opcr::where('id', $id)->update(['status' => Pcr::APPROVED]);

        session()->flash('success', 'Approved.');
    }

    public function disapprove($id)
    {
        Pcr::where('id', $id)->update(['status' => Pcr::DISAPPROVED]);
        Opcr::where('id', $id)->update(['status' => Pcr::DISAPPROVED]);

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
