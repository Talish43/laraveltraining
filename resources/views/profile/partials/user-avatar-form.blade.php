<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('User Avatar') }}
        </h2>

        <img style="    width: 80px !important;
    height: 80px !important;
    margin: 10px;" class="rounded-full" src="{{"/storage/$user->avatar"}}"  alt="{{$user->avatar}}"/>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Add or Update User Avatar") }}
        </p>
    </header>

    @if (Session::has('message'))
        <div class="text-red-600">{{ Session('message') }}</div>
    @endif
    <form method="post" action="{{ route('profile.avatar') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="avatar" :value="__('Avatar')" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)" required autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
