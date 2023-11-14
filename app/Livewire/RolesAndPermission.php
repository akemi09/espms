<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesAndPermission extends Component
{
    public $permissions = [];

    public function mount()
    {
        $roles = Role::orderBy('name', 'asc')->get();
        foreach ($roles as $role) {
            foreach ($role->permissions->pluck('name') as $permission) {
                array_push($this->permissions, $permission);
            }
        }

    }

    public function save()
    {
        $permissions = [];
        foreach ($this->permissions as $permission) {
            $role = explode('.', $permission);
            $permissions[$role[0]][] = $permission;
            $r = Role::where('name', $role[0])->first();
            $r->syncPermissions($permissions[$role[0]]);
        }

        session()->flash('success', 'Updated.');

        $this->redirect(RolesAndPermission::class);
    }

    public function render()
    {
        $roles = Role::orderBy('name', 'asc')->get();
        return view('livewire.roles-and-permission', [
            'roles' => $roles
        ]);
    }
}
