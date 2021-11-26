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

class RabbitEdit extends Component
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
    public $photo;
    public $photos;
    public $video;
    public $video_temp;

    public $current_tab = 'details';

    public array $breeding_id_list = [];
    public array $category_id_list = [];
    public array $breed_id_list    = [];
    public array $status_id_list   = [];

    public function mount($rabbit)
    {
        $this->breeding_id_list = Breeding::where('org_id', Members::getOrgID(auth()->id()))->get()->toArray();
        $this->category_id_list = Category::all()->toArray();
        $this->breed_id_list    = Breed::all()->toArray();
        $this->status_id_list   = RabbitStatus::all()->toArray();

        $model             = Rabbit::find($rabbit);
        $this->rabbit_id   = $rabbit;
        $this->org_id      = $model->org_id;
        $this->tag_id      = $model->tag_id;
        $this->breeding_id = $model->breeding_id;
        $this->cage_no     = $model->cage_no;
        $this->category_id = $model->category_id;
        $this->breed_id    = $model->breed_id;
        $this->type        = $model->type;
        $this->color       = $model->color;
        $this->dob         = $model->dob;
        $this->gender      = $model->gender;
        $this->status_id   = $model->status_id;
        $this->home_breed  = $model->home_breed;
        $this->notes       = $model->notes;

        Files::syncPhotos('Rabbit', $rabbit, $this->photos);
        Files::syncVideos('Rabbit', $rabbit, $this->video);
    }

    public function render()
    {
        return view('livewire.auth.rabbit-edit');
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
            'updated_by'  => auth()->id(),
        ]);
    }

    public function deleteMedia($id, $path)
    {
        $real_path = decrypt($path);

        Files::query()->where('id', $id)->where('model_id', $this->rabbit_id)->where('model', 'Rabbit')->forceDelete();
        Files::syncPhotos('Rabbit', $this->rabbit_id, $this->photos);
        Files::syncVideos('Rabbit', $this->rabbit_id, $this->video);

        Storage::delete($real_path);
    }

    public function setCurrentTab($tab)
    {
        $this->current_tab = $tab;
    }

    public function uploadImage()
    {
        $this->validate([
            'photo' => [
                'required',
                'mimes:jpg,jpeg,bmp,png',
                'max:3072',
                function ($attribute, $value, $fail) {
                    if (3 <= Files::countPhotos('Rabbit', $this->rabbit_id)) {
                        $fail('Max of 3 photos only.');
                    }
                },
            ],
        ]);
        $path = $this->photo->store('rabbits');
        Files::create([
            'model'       => 'Rabbit',
            'model_id'    => $this->rabbit_id,
            'path'        => $path,
            'filename'    => $this->photo->getClientOriginalName(),
            'extension'   => $this->photo->getClientOriginalExtension(),
            'size'        => Storage::size($path),
            'uploaded_by' => auth()->id(),
        ]);
        Files::syncPhotos('Rabbit', $this->rabbit_id, $this->photos);
    }

    public function uploadVideo()
    {
        $this->validate([
            'video_temp' => [
                'mimetypes:video/mp4',
                'max:7168',
                'required',
                function ($attribute, $value, $fail) {
                    if (1 <= Files::countVideos('Rabbit', $this->rabbit_id)) {
                        $fail('Max of 1 video only.');
                    }
                },
            ],
        ]);

        $path = $this->video_temp->store('rabbits');
        Files::create([
            'model'       => 'Rabbit',
            'model_id'    => $this->rabbit_id,
            'path'        => $path,
            'filename'    => $this->video_temp->getClientOriginalName(),
            'extension'   => $this->video_temp->getClientOriginalExtension(),
            'size'        => Storage::size($path),
            'uploaded_by' => auth()->id(),
        ]);
        Files::syncVideos('Rabbit', $this->rabbit_id, $this->video);
    }

    public function destroy()
    {
        $files = Files::query()->where('model_id', $this->rabbit_id)->where('model', 'Rabbit')->get()->toArray();
        foreach ($files as $item) {
            $this->deleteMedia($item['id'], encrypt($item['path']));
        }
        Rabbit::where('id', $this->rabbit_id)->forceDelete();

        return redirect()->route('rabbits');
    }
}
