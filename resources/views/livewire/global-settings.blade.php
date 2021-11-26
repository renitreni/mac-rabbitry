<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Global Settings') }} (For Admins)
        </h2>
    </x-slot>
    <div class="row justify-content-center my-5">
        <div class="col-auto">
            <div class="card p-3">
                <div class="body">
                    <div class="d-flex">
                        <div class="d-flex flex-column mx-2">
                            <div>
                                <label>Statuses</label>
                                <div class="input-group mb-3">
                                    <input wire:model="status" type="text" class="form-control"
                                           placeholder="Status Name" aria-label="Recipient's username"
                                           aria-describedby="button-addon2">
                                    <button wire:click="addStatus" class="btn btn-success" type="button"
                                            id="button-addon2">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($rabbit_status_list as $item)
                                    <li class="list-group-item d-flex justify-content-between"
                                        x-data="{showConfirm: false}">
                                        <div>{{ $item['name'] }}</div>
                                        <div>
                                            <button x-show="!showConfirm" x-transition:enter.duration.500ms
                                                    x-on:click="showConfirm = true"
                                                    type="button" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button x-show="showConfirm" x-transition:enter.duration.500ms
                                                    wire:click="destroy('RabbitStatus', '{{ encrypt($item['id']) }}')"
                                                    type="button" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button x-show="showConfirm" x-transition:enter.duration.500ms
                                                    x-on:click="showConfirm = false"
                                                    type="button"
                                                    class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex flex-column mx-2">
                            <div>
                                <label>Category</label>
                                <div class="input-group mb-3">
                                    <input wire:model="category" type="text" class="form-control"
                                           placeholder="Type in Category name" aria-label="Recipient's username"
                                           aria-describedby="button-addon2">
                                    <button wire:click="addCategory" class="btn btn-success" type="button"
                                            id="button-addon2">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($category_list as $item)
                                    <li class="list-group-item d-flex justify-content-between"
                                        x-data="{showConfirm: false}">
                                        <div>{{ $item['name'] }}</div>
                                        <div>
                                            <button x-show="!showConfirm" x-transition:enter.duration.500ms
                                                    x-on:click="showConfirm = true"
                                                    type="button" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button x-show="showConfirm" x-transition:enter.duration.500ms
                                                    wire:click="destroy('Category', '{{ encrypt($item['id']) }}')"
                                                    type="button"
                                                    class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button x-show="showConfirm" x-transition:enter.duration.500ms
                                                    x-on:click="showConfirm = false"
                                                    type="button"
                                                    class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="d-flex flex-column mx-2">
                            <div>
                                <label>Breeds</label>
                                <div class="input-group mb-3">
                                    <input wire:model="breed" type="text" class="form-control"
                                           placeholder="Type in Breed name..." aria-label="Recipient's username"
                                           aria-describedby="button-addon2">
                                    <button wire:click="addBreed" class="btn btn-success" type="button"
                                            id="button-addon2">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($breed_list as $item)
                                    <li class="list-group-item d-flex justify-content-between"
                                        x-data="{showConfirm: false}">
                                        <div>{{ $item['name'] }}</div>
                                        <div>
                                            <button x-show="!showConfirm" x-transition:enter.duration.500ms
                                                    x-on:click="showConfirm = true"
                                                    type="button" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button x-show="showConfirm" x-transition:enter.duration.500ms
                                                    wire:click="destroy('Breed', '{{ encrypt($item['id']) }}')"
                                                    type="button"
                                                    class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button x-show="showConfirm" x-transition:enter.duration.500ms
                                                    x-on:click="showConfirm = false"
                                                    type="button"
                                                    class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-times"></i>
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
    </div>
</div>
