<?php

namespace App\Livewire;

use App\Models\Opcr;
use Livewire\Component;
use Livewire\WithPagination;

class RatedOpcr extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function getRatedIpcr()
    {
        $ipcrs = Opcr::select('user_id')->with('user')->groupBy('user_id')->paginate(10);

        return $ipcrs;
    }

    public function render()
    {
        return view('livewire.rated-opcr', [
            'opcr_users' => $this->getRatedIpcr(),
        ]);
    }
}
