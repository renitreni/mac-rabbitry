<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('My Organization') }}
        </h2>
    </x-slot>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <style>
        .circular--landscape {
            display: inline-block;
            position: relative;
            width: 96px;
            height: 96px;
            overflow: hidden;
            border-radius: 50%;
        }

        .circular--landscape img {
            width: auto;
            height: 100%;
            margin-left: -50px;
        }

        .cropped1 {
            width: 200px; /* width of container */
            height: 200px; /* height of container */
            object-fit: cover;
        }
    </style>
    <div class="row my-5 justify-content-center">
        <div class="col-md-auto">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-3 border-bottom rounded-top pt-4">
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column">
                            @if($logo_path)
                                <img src="{{ route('storage.view', ['path' => encrypt($logo_path)]) }}"
                                     class="circular--landscape shadow-sm">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $name }}"
                                     class="img-thumbnail rounded-circle w-75">
                            @endif

                            <div class="mt-2">
                                <label class="btn btn-sm btn-outline-secondary">
                                    Select Logo <input type="file" wire:model="logo" hidden>
                                </label>
                            </div>
                        </div>
                        <div class="ms-2">
                            <div class="d-flex flex-column mt-2">
                                <h2 class="fw-bolder m-0">{{ $name }}</h2>
                                <label class="text-muted">{{ $email }}</label>
                                <label class="text-muted">{{ $address }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-auto">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-3 border-bottom rounded-top pt-4">
                    <div class="flex d-flex flex-column justify-content-center">
                        @if($logo_path)
                            <img src="{{ route('storage.view', ['path' => encrypt($logo_path)]) }}"
                                 class="circular--landscape shadow-sm">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ $name }}"
                                 class="img-thumbnail rounded-circle w-75">
                        @endif
                        <label class="btn btn-sm btn-outline-secondary mt-3">
                            Select Logo <input type="file" wire:model="logo" hidden>
                        </label>
                    </div>
                    <div class="row">
                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
