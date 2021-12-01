<?php

namespace App\Http\Livewire\Auth;

use App\Models\Breed;
use App\Models\Members;
use App\Models\Rabbit;
use Livewire\Component;

use App\Models\Breeding;

class BreedingCreate extends Component
{
    public $breeding_id;
    public $org_id;
    public $litter_no;
    public $cage_no;
    public $parent_doe;
    public $parent_buck;
    public $date_bred;
    public $expected_kindle_date;
    public $kindle_date;
    public $weaning_date;
    public $planned_rebreed_date;
    public $is_rebreed;
    public $born_alive;
    public $born_dead;
    public $total_kits;
    public $born_doe;
    public $born_buck;
    public $notes;

    public array $doe_list  = [];
    public array $buck_list = [];

    public function mount()
    {
        Breeding::draftCleaner();
        $this->org_id = Members::getOrgID(auth()->id());

        $model = Breeding::create(['is_draft' => 1, 'org_id' => $this->org_id]);

        (new Breeding())->idGenerator();

        $this->litter_no   = Breeding::find($model->id)->litter_no;
        $this->breeding_id = $model->id;
        $this->doe_list    = (new Rabbit())->myDoes()->get()->toArray();
        $this->buck_list   = (new Rabbit())->myBucks()->get()->toArray();
    }

    public function render()
    {
        $this->total_kits = $this->born_doe + $this->born_buck;

        return view('livewire.auth.breeding-create');
    }

    public function submit()
    {
        Breeding::updateOrCreate(['id' => $this->breeding_id],
            [
                'org_id'               => $this->org_id,
                'litter_no'            => $this->litter_no,
                'cage_no'              => $this->cage_no,
                'parent_doe'           => $this->parent_doe,
                'parent_buck'          => $this->parent_buck,
                'date_bred'            => $this->date_bred,
                'expected_kindle_date' => $this->expected_kindle_date,
                'kindle_date'          => $this->kindle_date,
                'weaning_date'         => $this->weaning_date,
                'planned_rebreed_date' => $this->planned_rebreed_date,
                'is_rebreed'           => $this->is_rebreed,
                'born_alive'           => $this->born_alive,
                'born_dead'            => $this->born_dead,
                'total_kits'           => $this->total_kits,
                'born_doe'             => $this->born_doe,
                'born_buck'            => $this->born_buck,
                'notes'                => $this->notes,
                'inserted_by'          => auth()->id()
            ]);

        return redirect()->route('breeding');
    }
}
