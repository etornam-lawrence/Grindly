<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Study Session') }}
            </h2>
          

             <x-primary-button x-data="" x-on:click="$dispatch('open-modal', 'session-modal')">
                {{ __('Make new session') }}
            </x-primary-button>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Here you can manage your study sessions, goals, and achievements.') }}   
            </p>

            <div>Level logic</div>
            <div>Study goal proficiency goes here</div>
        </div>
    </x-slot>

    <x-modal name="session-modal" :show="false" maxWidth="lg" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">
                {{ __('Create New Study Session') }}
            </h2>
            <form method="POST" action="{{ route('sessions.store') }}" class="mt-6 space-y-6">
                @csrf
                <x-text-input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="course_name" :value="__('Course/Subject')" />
                        <x-text-input id="course_name" name="course_name" placeholder="What subject or course" type="text" class="mt-1 block w-full" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('course_name')" />
                    </div>
                    <div>
                        <x-input-label for="topic" :value="__('Topic')" />
                        <x-text-input id="topic" name="topic" type="text" placeholder="What do you want to learn" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('topic')" />
                    </div>
                    <div>
                        <x-input-label for="date" :value="__('Date')" />
                        <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('date')" />
                    </div>
                    <div>
                        <x-input-label for="start_time" :value="__('Start time')" />
                        <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                    </div>
                    <div>
                        <x-select name="duration">
                            <option value="" disabled selected>{{ __('Select duration') }}</option>
                            @foreach([5, 10, 15, 20, 30, 45, 60] as $duration)
                                <option value="{{ $duration }}">{{ $duration }} {{ __('minutes') }}</option>
                            @endforeach
                            <option value="120">2 hours</option>
                        </x-select>
                        <x-input-label for="duration" :value="__('Duration (minutes)')" />
                        {{-- <x-text-input id="duration" name="duration" type="number" min="5" class="mt-1 block w-full" required /> --}}
                        <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                    </div>
                    <div>
                        <x-textarea name="notes" rows="5" placeholder="Notes here..." ></x-textarea>
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($sessions->isEmpty())
                        <p class="text-gray-600">{{ __('No study sessions found. Create your first session!') }}</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($sessions as $session)
                                <x-session-card :session="$session" />
                                
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
