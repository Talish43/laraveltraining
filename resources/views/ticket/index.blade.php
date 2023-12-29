<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between h-16 border-b-2 mb-5">
                    <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        {{ __("List All Tickets!") }}
                    </div>
                    <div class="sm:flex sm:items-center sm:ms-6">
                        <a href="{{ route('ticket.create') }}">Create Ticket</a>
                    </div>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    @if($tickets->isNotEmpty())
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-5" style="margin-top: 30px;">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col">Ticket Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 text-center">
                                <td class="px-6 py-4">
                                    {{$ticket->title}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$ticket->description}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$ticket->status}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$ticket->user->name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$ticket->created_at->diffForHumans()}}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{route('ticket.show',$ticket->id)}}">
                                        <x-primary-button>Show</x-primary-button>
                                    </a>
                                    <a href="{{route('ticket.edit',$ticket->id)}}">
                                        <x-primary-button>Edit</x-primary-button>
                                    </a>
                                    <form action="{{ route('ticket.destroy',$ticket->id) }}" method="post" style="display: inline">
                                        @method('delete')
                                        @csrf
                                        <x-primary-button>Delete</x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                        @if(auth()->user()->isAdmin)
                            <div style="padding: 0px 10px 10px 10px;">
                                {{ $tickets->links() }}
                            </div>
                        @endif
                    @else
                        <p style="padding: 20px; text-align: center;">You Don't Have Any Ticket Yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>