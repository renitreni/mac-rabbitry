<div>
    <x-slot name="header">
        <a href="{{ route('users') }}" class="btn btn-secondary">Back</a>
        <h3 class="h4 font-weight-bold my-auto ms-4">
            {{ __('Manage Users') }} / {{ __('Users') }} / {{ __('Create') }}
        </h3>
    </x-slot>
    <div class="row justify-content-center my-5">
        <div class="col-auto">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-4 py-2 border-bottom rounded-top pt-4">
                    <form wire:submit.prevent="submit">
                        <div class="row mb-3">
                            <div class="col-6 mb-2">
                                <label>Name</label>
                                <input type="text" class="form-control" wire:model="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-2">
                                <label>E-mail</label>
                                <input type="email" class="form-control" wire:model="email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-2">
                                <label>Password</label>
                                <input type="password" class="form-control" wire:model="password">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
