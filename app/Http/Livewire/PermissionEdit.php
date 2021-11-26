<?php

namespace App\Http\Livewire;

use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;
use Livewire\Component;

class PermissionEdit extends Component
{
    public $role;
    public $permissions;
    public $selectedPermission;

    public function mount($role)
    {
        $this->sync($role);
    }

    public function sync($id)
    {
        $this->role        = Role::where('id', $id)->with(['permissions'])->first();
        $this->permissions = Permission::query()
            ->whereNotIn('id', array_map(fn($value) => $value['id'], $this->role->permissions->toArray()))
            ->get();
    }

    public function render()
    {
        return view('livewire.permission-edit');
    }

    public function destroy($id)
    {
        $role       = Role::find($this->role->id);
        $permission = Permission::find($id);
        $role->detachPermission($permission);

        $this->sync($this->role->id);
    }

    public function add()
    {
        $role       = Role::find($this->role->id);
        $permission = Permission::find($this->selectedPermission);
        $role->attachPermission($permission);

        $this->sync($this->role->id);
    }
}
