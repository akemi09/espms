<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use App\Models\Office as Offices;

class Office extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $query = '';
    
    #[Rule('required|string')]
    public $office_name = '';

    public $office_id;
 
    public function search()
    {
        $this->resetPage();
    }

    public function store()
    {
        $this->validate();

        Offices::create([
            'name' => $this->office_name
        ]);

        session()->flash('success', 'Office created.');
        $this->redirect(Office::class);
    }

    public function edit($id)
    {
        $office = Offices::find($id);
        $this->office_id = $office->id;
        $this->office_name = $office->name;
    }

    public function update()
    {
        $this->validate();

        $office = Offices::find($this->office_id);
        $office->name = $this->office_name;
        $office->save();

        session()->flash('success', 'Office updated.');
        $this->redirect(Office::class);
    }

    public function destroy($id)
    {
        Offices::find($id)->delete();

        session()->flash('success', 'Office deleted.');
        $this->redirect(Office::class);
    }

    public function cancel()
    {
        $this->office_name = '';
        $this->resetValidation();
    }
    
    public function render()
    {
        $offices =  Offices::where('name', 'like', '%'.$this->query.'%')->paginate(10);
        return view('livewire.office', compact('offices'));
    }
}
