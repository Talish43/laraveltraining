<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl { mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>

                        <!-- Title -->
                        <div>
                            <x-input-label for="name" :value="__('Title')" />
                            <x-input-label value="{{$ticket->title}}" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="name" :value="__('Description')" />
                            <x-input-label value="{{$ticket->description}}" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('ticket.edit',$ticket->id) }}">
                                <x-primary-button class="ms-4">
                                    {{ __('Edit Ticket') }}
                                </x-primary-button>
                            </a>
                            @if(auth()->user()->isAdmin)
                                <form method="POST" action="{{ route('ticket.update',$ticket->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="status" value="resolved" />
                                    <input type="hidden" name="title" value="{{$ticket->title}}" />
                                    <input type="hidden" name="description" value="{{$ticket->description}}"  />
                                    <x-primary-button class="ms-4">
                                        {{ __('Approve') }}
                                    </x-primary-button>
                                </form>
                                <form method="POST" action="{{ route('ticket.update',$ticket->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="status" value="rejected" />
                                    <input type="hidden" name="title" value="{{$ticket->title}}" />
                                    <input type="hidden" name="description" value="{{$ticket->description}}"  />
                                    <x-primary-button class="ms-4">
                                        {{ __('Reject') }}
                                    </x-primary-button>
                                </form>
                            @endif
                        </div>
                        <div style="float: right; margin: 10px 0px 10px 0">
                            <x-input-label value="{{$ticket->status}}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>