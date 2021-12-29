<?php

namespace App\Http\Livewire\Auth;

use App\Models\Breeding;
use App\Models\Members;
use Livewire\Component;

class BreedingEdit extends Component
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

    public function mount($breeding)
    {
        $model = Breeding::find($breeding);
        if (!Members::isValidOrg($model->org_id)) {
            return redirect()->route('breeding');
        }

        $this->breeding_id          = $model->id;
        $this->org_id               = $model->org_id;
        $this->litter_no            = $model->litter_no;
        $this->cage_no              = $model->cage_no;
        $this->parent_doe           = $model->parent_doe;
        $this->parent_buck          = $model->parent_buck;
        $this->date_bred            = $model->date_bred;
        $this->expected_kindle_date = $model->expected_kindle_date;
        $this->kindle_date          = $model->kindle_date;
        $this->weaning_date         = $model->weaning_date;
        $this->planned_rebreed_date = $model->planned_rebreed_date;
        $this->is_rebreed           = $model->is_rebreed;
        $this->born_alive           = $model->born_alive;
        $this->born_dead            = $model->born_dead;
        $this->total_kits           = $model->total_kits;
        $this->born_doe             = $model->born_doe;
        $this->born_buck            = $model->born_buck;
        $this->notes                = $model->notes;
    }

    public function render()
    {
        return view('livewire.breeding-edit');
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
                'updated_by'          => auth()->id()
            ]);

        return redirect()->route('breeding');
    }
}
