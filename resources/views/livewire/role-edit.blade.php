<div>
    <x-slot name="header">
        <a href="{{ route('roles') }}" class="btn btn-secondary">Back</a>
        <h3 class="h4 font-weight-bold my-auto ms-4">
            {{ __('Manage Users') }} / {{ __('Roles') }} / {{ __('Edit') }}
        </h3>
    </x-slot>
    <div class="row justify-content-center my-5">
        <div class="col-md-auto">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-4 py-3 border-bottom rounded-top pt-4">
                    <form wire:submit.prevent="submit">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label>Name</label>
                                <input type="text" class="form-control" wire:model="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-2">
                                <label>Slug</label>
                                <input type="text" class="form-control" wire:model="slug">
                                @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-2">
                                <label>Level</label>
                                <input type="text" class="form-control" wire:model="level">
                                @error('level') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-2">
                                <label>Description</label>
                                <input type="text" class="form-control" wire:model="description">
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
