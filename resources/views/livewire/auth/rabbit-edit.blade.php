<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Rabbit') }} / {{ __('Edit') }}
        </h2>
    </x-slot>
    <div class="d-flex flex-column">
        <div class="nav flex-row nav-pills me-3 mb-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link @if($current_tab== 'details') active @endif"
                    wire:click="setCurrentTab('details')"
                    id="v-pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-details" type="button" role="tab" aria-controls="v-pills-details"
                    aria-selected="true">Details
            </button>
            <button class="nav-link @if($current_tab== 'media') active @endif"
                    wire:click="setCurrentTab('media')"
                    id="v-pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-media" type="button" role="tab" aria-controls="v-pills-media"
                    aria-selected="false">Media
            </button>
        </div>

        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade @if($current_tab== 'details') show active @endif" id="v-pills-details" role="tabpanel"
                 aria-labelledby="v-pills-details">
                <div class="card shadow bg-light">
                    <div class="card-header">
                        <div class="card-title m-0">
                            <div class="row">
                                <div class="col-auto">
                                    <h2 class="m-0">{{ $tag_id }} </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white px-5 py-3 border-bottom rounded-top pt-4">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label>Home Bred?</label>
                                <select class="form-control" wire:model="home_breed">
                                    <option value="">-- Select Option --</option>
                                    <option value="y">Yes</option>
                                    <option value="n">No</option>
                                </select>
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Cage No</label>
                                <input type="text" class="form-control" wire:model="cage_no">
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Breeding</label>
                                <select class="form-control" wire:model="breeding_id">
                                    <option value="">-- Select Option --</option>
                                    @foreach($breeding_id_list as $key => $item)
                                        <option value="{{ $item['id'] }}">{{ $item['litter_no'] }}</option>
                                    @endforeach
                                </select>
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Category</label>
                                <select class="form-control" wire:model="category_id">
                                    <option value="">-- Select Option --</option>
                                    @foreach($category_id_list as $key => $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Breed Type</label>
                                <select class="form-control" wire:model="breed_id">
                                    <option value="">-- Select Option --</option>
                                    @foreach($breed_id_list as $key => $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Status</label>
                                <select class="form-control" wire:model="status_id">
                                    <option value="">-- Select Option --</option>
                                    @foreach($status_id_list as $key => $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Type</label>
                                <select class="form-control" wire:model="type">
                                    <option value="">-- Select Option --</option>
                                    <option value="meat">Meat</option>
                                    <option value="pet">Pet</option>
                                </select>
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Color</label>
                                <input type="text" class="form-control" wire:model="color">
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Date Of Birth</label>
                                <input type="date" class="form-control" wire:model="dob">
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Gender</label>
                                <select class="form-control" wire:model="gender">
                                    <option value="">-- Select Option --</option>
                                    <option value="unknown">Unknown</option>
                                    <option value="buck">Buck</option>
                                    <option value="doe">Doe</option>
                                </select>
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-9 mb-2">
                                <label>Notes</label>
                                <input type="text" class="form-control" wire:model="notes">
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 mt-3 d-flex justify-content-end">
                                <a href="{{ route('rabbits') }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="button" class="align-self-end btn btn-success me-2"
                                        wire:loading.attr="disabled" wire:target="photo,video"
                                        wire:click="submit">Save
                                </button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Delete
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Please be reminded that {{ $tag_id }} will be wiped out.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary text-white"
                                                        wire:click="destroy">Proceed</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade @if($current_tab== 'media') show active @endif" id="v-pills-media" role="tabpanel" aria-labelledby="v-pills-media">
                <div class="card shadow bg-light">
                    <div class="card-header">
                        <div class="card-title m-0">
                            <div class="row">
                                <div class="col-auto">
                                    <h2 class="m-0">{{ $tag_id }} </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white px-5 py-3 border-bottom rounded-top pt-4">
                        <div class="row">
                            <div class="col-md-auto mb-2">
                                <label>Images <span class="text-muted">(3mb max,3 images,jpeg,png)</span></label>
                                <div
                                    x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                    class="d-flex flex-row"
                                >
                                    <!-- File Input -->
                                    <input type="file" wire:model="photo" class="form-control">

                                    <button x-show="!isUploading" class="btn btn-success ms-2" wire:click="uploadImage">
                                        <i class="fas fa-upload"></i>
                                    </button>

                                    <!-- Progress Bar -->
                                    <div x-show="isUploading" class="my-auto ms-2">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                @error('photo') @php $photo = null @endphp
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 d-flex">
                                @if ($photos)
                                    @foreach($photos as $item)
                                        <div class="position-relative">
                                            <div class="btn-group position-absolute">
                                                <button type="button" class="btn btn-outline-light dropdown"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        style="top: 17px;left: 168px;">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                                wire:click="deleteMedia({{ $item->id }}, '{{ encrypt($item->path) }}')">
                                                            Delete
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                            <img src="{{ route('storage.view', ['path' => encrypt($item->path)]) }}"
                                                 class="img-thumbnail shadow m-2" width="200" height="200">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-auto mb-2">
                                <label>Video <span class="text-muted">(6mb Max,mp4,mov)</span></label>
                                <div class="d-flex flex-row"
                                    x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                >
                                    <!-- File Input -->
                                    <input type="file" wire:model="video_temp" class="form-control">

                                    <button x-show="!isUploading" class="btn btn-success ms-2" wire:click="uploadVideo">
                                        <i class="fas fa-upload"></i>
                                    </button>

                                    <!-- Progress Bar -->
                                    <div x-show="isUploading" class="my-auto ms-2">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                @error('video_temp') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 h-25 d-flex flex-row">
                                @if ($video)
                                    <div class="d-flex flex-row position-relative">
                                        <div>
                                            <video class="img-thumbnail shadow m-2" width="420" controls>
                                                <source src="{{ route('storage.video', ['path' => encrypt($video->path)]) }}"
                                                        type="video/mp4">
                                            </video>
                                        </div>
                                        <div class="position-absolute top-0 end-0 mt-3 me-3">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-light dropdown rounded"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button type="button" class="dropdown-item"
                                                                wire:click="deleteMedia({{ $video->id }}, '{{ encrypt($video->path) }}')">
                                                            Delete
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
