<div>
    <x-slot name="header">
        <h3 class="h4 font-weight-bold my-auto ms-4">
            {{ __('Breeding') }} / {{ __('Create') }}
        </h3>
    </x-slot>
    <div class="row justify-content-center my-5">
        <div class="col-auto">
            <div class="card shadow bg-light">
                <div class="card-header">
                    <div class="card-title m-0 fs-3">{{ $litter_no }}</div>
                </div>
                <div class="card-body bg-white px-4 py-2 border-bottom rounded-top pt-4">
                    <form wire:submit.prevent="submit">
                        <div class="row mb-3">
                            <div class="col-md-3 mb-2">
                                <label>Cage No.</label>
                                <input type="text" class="form-control" wire:model="cage_no">
                                @error('cage_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>My Does</label>
                                <select class="form-control" wire:model="parent_doe">
                                    <option value="">-- Select Options --</option>
                                    @foreach($doe_list as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['tag_id'] }}</option>
                                    @endforeach
                                </select>
                                @error('parent_doe') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>My Bucks</label>
                                <select class="form-control" wire:model="parent_buck">
                                    <option value="">-- Select Options --</option>
                                    @foreach($buck_list as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['tag_id'] }}</option>
                                    @endforeach
                                </select>
                                @error('parent_buck') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Date Bred</label>
                                <input type="date" class="form-control" wire:model="date_bred">
                                @error('date_bred') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Expected Kindle Date</label>
                                <input type="date" class="form-control" wire:model="expected_kindle_date">
                                @error('expected_kindle_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Kindle Date</label>
                                <input type="date" class="form-control" wire:model="kindle_date">
                                @error('kindle_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Planned re-Breed</label>
                                <input type="date" class="form-control" wire:model="planned_rebreed_date">
                                @error('planned_rebreed_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>is re-Breed?</label>
                                <select class="form-control" wire:model="is_rebreed">
                                    <option value="">-- Select Options --</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('parent_buck') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Born Alive</label>
                                <input type="number" class="form-control" wire:model="born_alive">
                                @error('born_alive') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Born Dead</label>
                                <input type="number" class="form-control" wire:model="born_dead">
                                @error('born_dead') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Born Doe</label>
                                <input type="number" class="form-control" wire:model="born_doe">
                                @error('born_doe') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Born Buck</label>
                                <input type="number" class="form-control" wire:model="born_buck">
                                @error('born_buck') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Total Kits</label>
                                <input type="number" class="form-control" wire:model="total_kits" readonly>
                                @error('total_kits') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label>Notes</label>
                                <input type="text" class="form-control" wire:model="notes">
                                @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <a href="{{ route('breeding') }}" class="btn btn-secondary me-2">Cancel</a>
                                <button class="btn btn-success" wire:click="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
