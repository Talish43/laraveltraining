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
                    <form method="POST" action="{{ route('ticket.update',$ticket->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <!-- Title -->
                        <div>
                            <x-input-label for="name" :value="__('Title')" />
                            <x-text-input id="title" placeholder="Add Title" class="block mt-1 w-full" type="text" name="title" value="{{$ticket->title}}" autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="name" :value="__('Description')" />
                            <x-text-area placeholder="Add Description" name="description" id="description" value="{{$ticket->description}}"/>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Update Ticket') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>