<?php

namespace App\Livewire;

use App\Models\Office;
use Livewire\Component;
use App\Models\MfoPapOffice;
use Livewire\WithPagination;
use App\Models\TargetFuntion;
use Livewire\Attributes\Rule;
use App\Models\MfoPap as MfoPaps;

class MfoPap extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $query = '';

    public $mfo_pap_id;

    #[Rule('required|string')]
    public $title = '';

    #[Rule('required')]
    public $office = [];

    #[Rule('required')]
    public $target_function = '';

    public function search()
    {
        $this->resetPage();
    }

    public function store()
    {
        $this->validate();

        $mfo_pap = MfoPaps::create([
            'user_id' => auth()->user()->id,
            'title' => $this->title,
            'target_function_id' => $this->target_function
        ]);

        foreach ($this->office as $office) {
            $mfo_pap->mfo_pap_office()->create([
                'mfo_pap_id' => $mfo_pap->id,
                'office_id' => $office
            ]);
        }

        session()->flash('success', 'MFO/PAP created.');

        $this->redirect(MfoPap::class);
    }

    public function edit($id)
    {
        $mfo_pap = MfoPaps::find($id);
        $this->mfo_pap_id = $mfo_pap->id;
        $this->title = $mfo_pap->title;

        foreach ($mfo_pap->mfo_pap_office as $office) {
            array_push($this->office, $office->office_id);
        }

        $this->target_function = $mfo_pap->target_function_id;

    }

    public function update()
    {
        $this->validate();

        $mfo_pap = MfoPaps::find($this->mfo_pap_id);
        $mfo_pap->title = $this->title;
        $mfo_pap->target_function_id = $this->target_function;
        MfoPapOffice::where('mfo_pap_id', $this->mfo_pap_id)->delete();
        foreach ($this->office as $office) {
            $mfo_pap->mfo_pap_office()->create([
                'mfo_pap_id' => $mfo_pap->id,
                'office_id' => $office
            ]);
        }

        $mfo_pap->save();

        session()->flash('success', 'MFO/PAP updated.');

        $this->redirect(MfoPap::class);

    }

    public function destroy($id)
    {
        MfoPaps::find($id)->delete();

        session()->flash('success', 'MFO/PAP deleted.');

        $this->redirect(MfoPap::class);
    }

    public function cancel()
    {
        $this->title = '';
        $this->office = [];
        $this->target_function = '';
        $this->resetValidation();
    }

    public function render()
    {
        $mfo_paps = MfoPaps::where('title', 'like', '%'.$this->query.'%')
                    ->paginate(10);

        $offices = Office::orderBy('name', 'asc')->get();

        $target_functions = TargetFuntion::orderBy('name', 'asc')->get();

        return view('livewire.mfo-pap', compact('mfo_paps', 'offices', 'target_functions'));
    }
}
