<?php

namespace App\Livewire;

use App\Models\Office;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\User as Users;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class User extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $query = '';
    public $user_id;
    public $name = '';
    public $email = '';
    public $designation = '';
    public $office = '';
    public $roles = [];
    public $password = '';
    public $password_confirmation = '';

    public function search()
    {
        $this->resetPage();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email:filter|max:250|unique:users',
            'designation' => 'required|string',
            'office' => 'required',
            'roles' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = Users::create([
            'name' => Str::title($this->name),
            'email' => $this->email,
            'designation' => $this->designation,
            'office_id' => $this->office,
            'password' => Hash::make($this->password)
        ]);

        foreach ($this->roles as $role) {
            $user->assignRole($role);
        }

        session()->flash('success', 'User created.');

        $this->redirect(User::class);
    }

    public function edit($id)
    {
        $user = Users::find($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->designation = $user->designation;
        $this->office = $user->office_id;
        
        foreach ($user->roles as $role) {
            array_push($this->roles, $role['name']);
        }
    }

    public function update()
    {
        $data = $this->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email:filter|string|unique:users,email,'.$this->user_id,
            'designation' => 'required|string',
            'office' => 'required|integer',
            'roles' => 'required',
            'password' => 'sometimes|nullable|confirmed'
        ]);

        $user = Users::find($this->user_id);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->designation = $data['designation'];
        $user->office_id = $data['office'];
        $user->syncRoles($data['roles']);
        if($data['password'] != "")
        {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        session()->flash('success', 'User updated.');
        $this->redirect(User::class);
    }

    public function destroy($id)
    {
        if ($id == 1)
        {
            abort(403);
        }

        Users::find($id)->delete();

        session()->flash('success', 'User deleted.');
        $this->redirect(User::class);
    }

    public function cancel()
    {
        $this->name = '';
        $this->email = '';
        $this->designation = '';
        $this->office = '';
        $this->roles = [];
        $this->password = '';
        $this->password_confirmation = '';
        $this->resetValidation();
    }
    
    public function render()
    {
        $users =  Users::where('name', 'like', '%'.$this->query.'%')
                    ->orWhere('email', 'like', '%'.$this->query.'%')
                    ->paginate(10);
        $offices = Office::orderBy('name', 'asc')->get();
        $roles_list = Role::orderBy('name', 'asc')->get();

        return view('livewire.user', compact('users', 'offices', 'roles_list'));
    }
}
