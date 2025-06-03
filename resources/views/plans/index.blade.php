<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Plans') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Here you can manage your plans, goals, and achievements.') }}
            </p>

            <x-primary-button x-data="" x-on:click="$dispatch('open-modal', 'plan-modal')">
                {{ __('Make New Plan') }}
            </x-primary-button>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("All plans(in card forms)->goals(set-time), Calendars, recent achievements, XP-points!, due goalss") }}
                </div>
            </div>
        </div>
    </div>

    <x-modal name="plan-modal" :show="false" max-width="md" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Create New Plan') }}
            </h2>

            <div class="mt-4">
                <!-- Your form or modal content goes here -->
                <form method="POST" action="{{ route('plans.store') }}" class="mt-6 space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        {{-- <x-textarea id="description" name="description" class="mt-1 block w-full" required /> --}}
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close-modal', 'plan-modal')">
                    {{ __('Cancel') }}
                </x-secondary-button>
            </div>
        </div>
    </x-modal>
</x-app-layout>
