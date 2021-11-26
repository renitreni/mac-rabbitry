<?php

namespace App\Http\Livewire;

use App\Models\Breed;
use App\Models\Category;
use App\Models\RabbitStatus;
use Faker\Factory;
use Livewire\Component;

class GlobalSettings extends Component
{
    public array $rabbit_status_list = [];
    public array $breed_list         = [];
    public array $category_list      = [];

    public string $status   = '';
    public string $breed    = '';
    public string $category = '';

    public array $rules = [
        'status'   => 'required',
        'category' => 'required',
        'breed'    => 'required',
    ];

    public function render()
    {
        $this->rabbit_status_list = RabbitStatus::all()->toArray();
        $this->breed_list         = Breed::all()->toArray();
        $this->category_list      = Category::all()->toArray();

        return view('livewire.global-settings');
    }

    public function addStatus()
    {
        $this->validateOnly('status');

        RabbitStatus::create(['name' => $this->status, 'color' => Factory::create()->hexColor,]);

        $this->status = '';
    }

    public function addCategory()
    {
        $this->validateOnly('category');

        Category::create(['name' => $this->category,]);

        $this->category = '';
    }

    public function addBreed()
    {
        $this->validateOnly('breed');

        Breed::create(['name' => $this->breed,]);

        $this->breed = '';
    }

    public function destroy($model, $id)
    {
        $id = decrypt($id);
        eval("App\\Models\\$model::destroy($id);");
    }
}
