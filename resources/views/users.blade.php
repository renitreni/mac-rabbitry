<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Manage Users') }} / {{ __('Users') }}
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
                        <a href="{{ route('user.create') }}" class="btn btn-success text-white">Create User</a>
                    </div>

                    <div class='fill' style="div.content .fill { flex: 1; overflow-x: scroll };">
                        <livewire:user-table/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
