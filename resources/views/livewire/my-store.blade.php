<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('My Store') }}
        </h2>
    </x-slot>
    <div class="card shadow bg-light">
        <div class="card-body bg-white px-5 py-3 border-bottom rounded-top pt-4">
            <div class="d-flex flex-column">
                <div class="row">
                    @foreach($for_sale as $item)
                        <div class="col-md-auto">
                            <div class="card">
                                <div class="w-100 flex d-flex justify-content-center">
                                    <img
                                        @if(count($item['images']) > 0)
                                        src="{{ route('storage.view', ['path' => encrypt($item['images'][0]['path'])]) }}"
                                        @else
                                        src="https://ui-avatars.com/api/?name=Blank"
                                        @endif
                                        class="cropped1" alt=""
                                        style="max-height: 180px;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item['tag_id'] }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $for_sale->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
