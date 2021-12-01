<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Breeding') }}
        </h2>
    </x-slot>
    <div class="row justify-content-center my-5">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-3 border-bottom rounded-top pt-4">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="d-flex mb-3">
                        <a href="{{ route('breeding.create') }}" class="btn btn-success text-white">Create Breeding</a>
                    </div>
                    <div>
                        <livewire:auth.breeding-table/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
