<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Study Session Details') }}
        </h2>
    </x-slot>

    <x-modal name="edit-session-modal" :show="false" maxWidth="lg" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">
                {{ __('Make Changes to your Study Session') }}
            </h2>
            <form method="POST" action="{{ route('sessions.update', $session->id) }}" class="mt-6 space-y-6">
                @csrf
                @method('PATCH')
                <x-text-input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="course_name" :value="__('Course/Subject')" />
                        <x-text-input id="course_name" value="{{ old('course_name',$session->course_name)}}" name="course_name" placeholder="What subject or course" type="text" class="mt-1 block w-full" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('course_name')" />
                    </div>
                    <div>
                        <x-input-label for="topic" :value="__('Topic')" />
                        <x-text-input id="topic" name="topic" type="text" value="{{ old('topic', $session->topic) }}" placeholder="What do you want to learn" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('topic')" />
                    </div>
                    <div>
                        <x-input-label for="date" :value="__('Date')" />
                        <x-text-input id="date" name="date" type="date" value="{{ old('date', $session->date) }}" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('date')" />
                    </div>
                    <div>
                        <x-input-label for="start_time" :value="__('Start time')" />
                        <x-text-input id="start_time" name="start_time" value="{{ old('start_time', $session->start_time) }}" type="time" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                    </div>
                    <div>
                        <x-input-label for="duration" :value="__('Duration (minutes)')" />
                        <x-text-input id="duration" name="duration" type="number" value="{{ old('duration', $session->duration) }}" min="5" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-2">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button>
                        Confirm
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <section class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <header class="p-6 border-b">
                    <h3 class="font-bold text-2xl">{{ $session->course_name }} - {{ $session->topic }}</h3>
                </header>
                <div class="p-6 text-gray-900 space-y-3">
                    <div>
                        <span class="font-semibold">Date:</span>
                        <span>{{ $session->date }}</span>
                    </div>
                    <div>
                        <span class="font-semibold">Start Time:</span>
                        <span>{{ $session->start_time }}</span>
                    </div>
                    <div>
                        <span class="font-semibold">Duration:</span>
                        <span>{{ $session->duration }} minutes</span>
                    </div>
                    <div>
                        <span class="font-semibold">Status:</span>
                        <span>{{ $session->status }}</span>
                    </div>
                    <div>
                        <span class="font-semibold">Notes:</span>
                        <span>{{ $session->notes }}</span>
                    </div>
                </div>
                <footer class="p-6 border-t flex justify-end space-x-2 bg-gray-50">
                    <a href="{{ route('sessions.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Back to Sessions
                    </a>
                    <x-primary-button x-data="" x-on:click="$dispatch('open-modal','edit-session-modal')">
                        Edit Session
                    </x-primary-button>
                </footer>
            </article>
        </div>
    </section>
</x-app-layout>