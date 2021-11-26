<div>
    <x-slot name="header">
        <a href="{{ route('roles') }}" class="btn btn-secondary">Back</a>
        <h3 class="h4 font-weight-bold my-auto ms-4">
            {{ __('Manage Users') }} / {{ __('Permission Edit') }}
        </h3>
    </x-slot>
    <div class="row justify-content-center my-5">
        <div class="col-md-5">
            <div class="card shadow bg-light">
                <div class="card-header">
                    <div class="card-title">Edit {{ $role->name }} Permission</div>
                </div>
                <div class="card-body bg-white px-4 py-3 border-bottom rounded-top pt-4">
                    <div class="input-group mb-3">
                        <select type="text" class="form-control" wire:model="selectedPermission">
                            <option value=""> -- Select Option --</option>
                            @foreach($permissions as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-success" wire:click="add">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                    <ul class="list-group">
                        @foreach($role->permissions as $item)
                            <li class="list-group-item">
                                <div class="d-flex flex-row justify-content-between">
                                    <label>{{ $item['name'] }}</label>
                                    <button class="btn btn-sm btn-outline-danger" wire:click="destroy({{$item->id}})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
