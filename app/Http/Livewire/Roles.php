<?php

namespace App\Http\Livewire;

use jeremykenedy\LaravelRoles\Models\Role;
use Livewire\Component;

class Roles extends Component
{
    public $listeners = ['destroyRole'];

    public function render()
    {
        return view('livewire.roles');
    }

    public function destroyRole($role)
    {
        Role::where('id', $role)->forceDelete();
        session()->flash('message', 'Role successfully deleted.');
        $this->emit('fillDataRoles');
    }
}
