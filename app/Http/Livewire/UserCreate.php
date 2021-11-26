<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserCreate extends Component
{
    public $name     = '';
    public $email    = '';
    public $password = '';
    public $rules    = [
        'name'     => 'required|max:25',
        'email'    => 'required|unique:users',
        'password' => 'required',
    ];

    public function submit()
    {
        $this->validate();
        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', 'User successfully created.');

        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.user-create');
    }
}
