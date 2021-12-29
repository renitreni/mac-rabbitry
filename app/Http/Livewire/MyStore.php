<?php

namespace App\Http\Livewire;

use App\Models\Members;
use App\Models\Organization;
use App\Models\Rabbit;
use Livewire\Component;

class MyStore extends Component
{
    public $org_id;

    public function mount()
    {
        $this->org_id = Members::getOrgID(auth()->id());
    }

    public function render()
    {
        return view('livewire.my-store', [
            'for_sale' => Rabbit::where('org_id', $this->org_id)->with(['images'])->paginate(10),
        ]);
    }
}
