<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Plans') }}
            </h2>
            <p class="mt-2 text-gray-600">
                {{ __('Manage your plans, set goals, and track your progress.') }}
            </p>
            <form method="POST" action= "{{ route('plans.store') }}">
                @csrf
                <x-primary-button>
                    {{ __('Create New Plan') }}
                </x-primary-button>
            </form>
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
</x-app-layout>
