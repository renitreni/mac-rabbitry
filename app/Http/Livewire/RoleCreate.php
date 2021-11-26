<?php

namespace App\Http\Livewire;

use jeremykenedy\LaravelRoles\Models\Role;
use Livewire\Component;

class RoleCreate extends Component
{
    public $name;
    public $slug;
    public $description;
    public $level;

    public function render()
    {
        return view('livewire.role-create');
    }

    public function submit()
    {
        $this->validate([
            'name'        => 'required',
            'slug'        => 'required',
            'description' => 'required',
            'level'       => 'required',
        ]);

        Role::create([
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
            'level'       => $this->level,
        ]);

        session()->flash('message', 'Roles successfully created.');

        return redirect()->route('roles');
    }
}
