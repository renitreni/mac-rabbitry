<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Manage Users') }} / {{ __('Roles') }}
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
                        <a href="{{ route('role.create') }}" class="btn btn-success text-white">Create Role</a>
                    </div>
                    <livewire:roles-table/>
                </div>
            </div>
        </div>
    </div>
</div>
