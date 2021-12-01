<?php

namespace App\Http\Livewire\Auth;

use App\Models\Breed;
use App\Models\Breeding;
use App\Models\Category;
use App\Models\Files;
use App\Models\Members;
use App\Models\Rabbit;
use App\Models\RabbitStatus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class RabbitCreate extends Component
{
    use WithFileUploads;

    public $rabbit_id;
    public $org_id;
    public $tag_id;
    public $breeding_id;
    public $cage_no;
    public $category_id;
    public $breed_id;
    public $type;
    public $color;
    public $dob;
    public $gender;
    public $status_id;
    public $home_breed;
    public $notes;
    public $avatar;

    public $home_breed_selected = '';
    public $photos;
    public $video;

    public array $breeding_id_list = [];
    public array $category_id_list = [];
    public array $breed_id_list    = [];
    public array $status_id_list   = [];

    public function mount()
    {
        Rabbit::draftCleaner();

        $this->breeding_id_list = Breeding::where('org_id', Members::getOrgID(auth()->id()))->get()->toArray();
        $this->category_id_list = Category::all()->toArray();
        $this->breed_id_list    = Breed::all()->toArray();
        $this->status_id_list   = RabbitStatus::all()->toArray();
    }

    public function render()
    {
        return view('livewire.auth.rabbit-create');
    }

    public function setHomeBreed()
    {
        $model = Rabbit::create([
            'home_breed'  => $this->home_breed_selected,
            'org_id'      => Members::getOrgID(auth()->id()),
            'inserted_by' => auth()->user()->email,
            'is_draft'     => 1,
        ]);

        (new Rabbit())->idGenerator();

        $this->rabbit_id  = $model->id;
        $this->tag_id     = Rabbit::find($this->rabbit_id)->tag_id;
        $this->home_breed = $this->home_breed_selected;
    }

    public function updatedPhotos()
    {
        $this->validate([
            'photos.*' => 'mimes:jpg,jpeg,bmp,png|max:3072',
            'photos'   => 'max:3',
        ]);
    }

    public function updatedVideo()
    {
        $this->validate([
            'video' => 'mimetypes:video/mp4|max:7168',
        ]);
    }

    public function submit()
    {
        Rabbit::where('id', $this->rabbit_id)->update([
            'breeding_id' => $this->breeding_id,
            'cage_no'     => $this->cage_no,
            'category_id' => $this->category_id,
            'breed_id'    => $this->breed_id,
            'type'        => $this->type,
            'color'       => $this->color,
            'dob'         => $this->dob,
            'gender'      => $this->gender,
            'status_id'   => $this->status_id,
            'home_breed'  => $this->home_breed,
            'notes'       => $this->notes,
            'inserted_by' => auth()->id(),
            'is_draft'     => 0,
        ]);

        foreach ($this->photos as $photo) {
            $path = $photo->store('rabbits');
            Files::create([
                'model'       => 'Rabbit',
                'model_id'    => $this->rabbit_id,
                'path'        => $path,
                'filename'    => $photo->getClientOriginalName(),
                'extension'   => $photo->getClientOriginalExtension(),
                'size'        => Storage::size($path),
                'uploaded_by' => auth()->id(),
            ]);
        }

        $path = $this->video->store('rabbits');
        Files::create([
            'model'       => 'Rabbit',
            'model_id'    => $this->rabbit_id,
            'path'        => $path,
            'filename'    => $this->video->getClientOriginalName(),
            'extension'   => $this->video->getClientOriginalExtension(),
            'size'        => Storage::size($path),
            'uploaded_by' => auth()->id(),
        ]);

        session()->flash('message', 'New Rabbit Info successfully created.');

        return redirect()->route('rabbits');
    }
}
