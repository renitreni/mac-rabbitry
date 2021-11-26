<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Rabbit') }} / {{ __('Create') }}
        </h2>
    </x-slot>
    <div class="row justify-content-center my-5">
        @if($home_breed)
            <div class="col-md-12">
                <div class="card shadow bg-light">
                    <div class="card-header">
                        <div class="card-title m-0">
                            <div class="row">
                                <div class="col-auto">
                                    <h2 class="m-0">{{ $tag_id }} </h2>
                                </div>
                                @if($home_breed == 'y')
                                    <div class="col-auto mt-auto">
                                        <h4 class="m-0">Home breed, <span class="badge bg-primary">Yes</span></h4>
                                    </div>
                                @else
                                    <div class="col-auto mt-auto">
                                        <h4 class="m-0">Home breed, <span class="badge bg-warning">No</span></h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white px-5 py-3 border-bottom rounded-top pt-4">
                        <div class="row">
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
                            <div class="col-md-auto mb-2">
                                <label>Images <span class="text-muted">(3mb max,3 images,jpeg,png)</span></label>
                                <div
                                    x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                >
                                    <!-- File Input -->
                                    <input type="file" wire:model="photos" class="form-control" multiple>
                                    <!-- Progress Bar -->
                                    <div x-show="isUploading">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                @error('photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('photos') @php $photos = null @endphp <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-auto mb-2">
                                <label>Video <span class="text-muted">(6mb Max,mp4,mov)</span></label>
                                <div
                                    x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                >
                                    <!-- File Input -->
                                    <input type="file" wire:model="video" class="form-control">

                                    <!-- Progress Bar -->
                                    <div x-show="isUploading">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                @error('video') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 h-25 d-flex flex-row">
                                @if ($photos)
                                    @foreach($photos as $item)
                                        <img src="{{ $item->temporaryUrl() }}"
                                             class="img-thumbnail shadow m-2" width="200" height="200">
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-12 mt-3 d-flex justify-content-end">
                                <a href="{{ route('rabbits') }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="button" class="align-self-end btn btn-success"
                                        wire:loading.attr="disabled" wire:target="photo,video"
                                        wire:click="submit">Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-4">
                <div class="card shadow bg-light">
                    <div class="card-body bg-white px-5 py-3 border-bottom rounded-top pt-4">
                        <div class="row">
                            <div class="col-12">
                                <label>Is this home breed?</label>
                                <div class="input-group mb-3">
                                    <select class="form-control" wire:model="home_breed_selected">
                                        <option value="">-- Select Option --</option>
                                        <option value="y">Yes</option>
                                        <option value="n">No</option>
                                    </select>
                                    <button class="btn btn-success" wire:click="setHomeBreed">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
