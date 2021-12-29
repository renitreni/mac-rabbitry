<?php

namespace App\Http\Livewire\Auth;

use App\Models\Members;
use App\Models\Organization;
use App\Models\Rabbit;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyOrganization extends Component
{
    use WithFileUploads;

    public $org_id;
    public $name;
    public $logo_path;
    public $address;
    public $email;

    public $logo;

    public function mount()
    {
        $this->org_id = Members::getOrgID(auth()->id());

        $model           = Organization::find($this->org_id);
        $this->name      = $model->name;
        $this->logo_path = $model->logo;
        $this->address   = $model->address;
        $this->email     = $model->email;

    }

    public function render()
    {
        return view('livewire.my-organization', [
            'for_sale' => Rabbit::where('org_id', $this->org_id)->with(['images'])->paginate(6)
        ]);
    }

    public function updatedLogo()
    {
        Storage::delete($this->logo_path);

        $path            = $this->logo->store('organization');
        $this->logo_path = $path;

        Organization::updateOrCreate(['id' => $this->org_id], ['logo' => $this->logo_path,]);
    }

}
