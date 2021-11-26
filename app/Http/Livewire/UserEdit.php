<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;
use Livewire\Component;

class UserEdit extends Component
{
    public $name         = '';
    public $email        = '';
    public $password     = '';
    public $role_current = null;
    public $roles        = null;

    public function mount($user)
    {
        $this->user_id      = $user;
        $model              = User::find($user);
        $this->name         = $model->name;
        $this->email        = $model->email;
        $this->role_current = User::where('id', $user)->with(['roles'])->first()->toArray()['roles'][0]['id'] ?? null;
        $this->roles        = Role::all();
    }

    public function submit()
    {
        $this->validateOnly('name', [
            'name' => 'required',
        ]);
        User::where('id', $this->user_id)->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'User successfully updated.');

        return redirect()->route('users');
    }

    public function passwordUpdate()
    {
        $this->validateOnly('password', [
            'password' => 'required',
        ]);
        User::where('id', $this->user_id)->update([
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', 'Password successfully changed.');

        return redirect()->route('users');
    }

    public function roleUpdate()
    {
        $user = User::find($this->user_id);
        $role = Role::find($this->role_current);

        $user->detachAllRoles();
        $user->attachRole($role);

        session()->flash('message', 'Role successfully changed.');

        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.user-edit');
    }
}
