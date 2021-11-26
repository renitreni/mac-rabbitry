<?php

namespace App\Http\Livewire;

use jeremykenedy\LaravelRoles\Models\Role;
use Livewire\Component;

class RoleEdit extends Component
{
    public $role_id;
    public $name;
    public $slug;
    public $description;
    public $level;

    public function mount($role)
    {
        $model             = Role::where('id', $role)->first();
        $this->role_id     = $model->id;
        $this->name        = $model->name;
        $this->slug        = $model->slug;
        $this->description = $model->description;
        $this->level       = $model->level;
    }

    public function render()
    {
        return view('livewire.role-edit');
    }

    public function submit()
    {
        $this->validate([
            'name'        => 'required',
            'slug'        => 'required',
            'description' => 'required',
            'level'       => 'required',
        ]);

        Role::where('id', $this->role_id)->update([
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
            'level'       => $this->level,
        ]);

        session()->flash('message', 'Roles successfully created.');

        return redirect()->route('roles');
    }
}
