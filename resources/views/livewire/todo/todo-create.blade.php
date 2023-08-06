<div>
    <div>
        <x-input-label for="name" :value="__('Title')" />
        <x-text-input wire:model='title' id="title" class="block mt-1 w-full" type="text" name="title" required
            autofocus autocomplete="title" placeholder="Title here" />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
    <div class="mt-5">
        <x-primary-button wire:click.prevent='create'>
            {{ __('Create') }}
        </x-primary-button>
    </div>
</div>
