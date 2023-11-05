<?php

namespace App\Livewire;

use App\Models\Pcr;
use Livewire\Component;
use Livewire\WithPagination;

class RatedIpcr extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function getRatedIpcr()
    {
        $ipcrs = Pcr::select('user_id')->with('user')->groupBy('user_id')->paginate(10);

        return $ipcrs;
    }

    public function render()
    {
        return view('livewire.rated-ipcr', [
            'ipcr_users' => $this->getRatedIpcr(),
        ]);
    }
}
