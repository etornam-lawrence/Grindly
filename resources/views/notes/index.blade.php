<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="font-semibold text-3xl text-neutral-900 leading-tight tracking-tight">
                        {{ __('Grindly Notes Dashboard') }}
                    </h2>
                    <p class="mt-1 text-base text-neutral-500">
                        {{ __('Your ideas, tasks, and progress—all in one place.') }}
                    </p>
                </div>
                <div class="flex items-center gap-4">
                    
                    {{-- New Note Button --}}
                    <x-primary-button x-data="" x-on:click="$dispatch('open-modal', 'note-modal')"
                        class="bg-neutral-800 hover:bg-neutral-900 rounded-xl px-6 py-2 shadow font-semibold transition">
                        <svg class="inline-block w-5 h-5 mr-2 -mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('New Note') }}
                    </x-primary-button>

                    {{-- Current Time Display --}}
                    <div id="current-time" class="text-neutral-700 text-sm font-mono px-4 py-1.5 rounded-lg bg-neutral-100 border border-neutral-200">               
                    </div>
                </div>
            </div>
            
        </div>
        
    </x-slot>
    
{{-- Search Bar --}}
            
    {{-- Main Notes Display --}}
    <div class="py-12 bg-neutral-50 min-h-screen flex flex-col items-center">
        <div class="max-w-6xl w-full px-6">
            <div class="mb-10 text-neutral-700 text-lg bg-white border border-neutral-200 font-medium rounded-xl shadow-sm p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <span>
                    {{ __("Productivity is visible progress. Your notes are cards—each one a step forward.") }}
                </span>
                <span class="mt-4 md:mt-0 md:ml-4 w-full md:w-auto">
                    {{-- Search Bar --}}
                    <input type="text" id="searchBar" placeholder="Search notes..."
                    class="block w-full sm:w-80 rounded-xl border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 px-4 py-2 text-sm"
                    onkeyup="filterNotes()">
                </span>
            </div>
        </div>

        <div class="max-w-6xl w-full flex justify-center">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-center w-full">
                
                {{-- Notes Loop --}}
                @forelse ($notes as $note)
                    <div class="relative bg-white border border-neutral-200 rounded-xl shadow group transition hover:shadow-lg hover:border-neutral-300 notion-card">
                        <div class="absolute top-4 right-4 w-2 h-2 rounded-full bg-neutral-200 group-hover:bg-neutral-400 transition"></div>
                        <div class="p-6 flex flex-col gap-3">
                            <a href="{{ route('notes.edit', ['note' => $note->id, 'slug' => Str::slug($note->title)]) }}">
                                <h3 class="text-xl font-bold text-neutral-800 group-hover:text-neutral-900 transition tracking-tight">
                                    {{ $note->title }}
                                </h3>
                                <div class="text-neutral-600 text-base mt-1 line-clamp-5 whitespace-pre-line">
                                    {{ $note->content }}
                                </div>
                            </a>
                            <div class="absolute bottom-3 right-5 transition opacity-0 group-hover:opacity-90">
                                <form method="POST" action="{{ route('notes.destroy', $note->id) }}"
                                    onsubmit="return confirm('Delete this note?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="fa-regular fa-trash-can focus:ring-2 focus:ring-neutral-300 rounded-full p-1">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-neutral-400 text-center py-20 text-lg">
                        {{ __("No notes yet. Start capturing your next productive idea!") }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Note Creation Modal --}}
    <x-modal name="note-modal" :show="false" max-width="md" focusable>
        <div class="p-8 bg-white rounded-xl">
            <h2 class="text-2xl font-semibold text-neutral-900 mb-2">
                {{ __('Add a Productive Note') }}
            </h2>
            <p class="text-neutral-500 mb-6">
                {{ __("Write down tasks, ideas, or anything that moves you forward. Productivity starts here.") }}
            </p>

            <form method="POST" action="{{ route('notes.store') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" name="title" type="text"
                        class="mt-1 block w-full rounded-lg border-neutral-300 focus:border-neutral-800 focus:ring-neutral-800"
                        required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                </div>

                <div class="flex justify-end gap-3">
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'note-modal')" class="rounded-xl">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-primary-button class="rounded-xl bg-neutral-800 hover:bg-neutral-900">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    {{-- Notion-like Card Styles --}}
    <style>
        .notion-card {
            border-width: 1.5px;
            box-shadow: 0 2px 8px 0 rgba(55, 53, 47, 0.04), 0 1.5px 3px 0 rgba(55, 53, 47, 0.06);
            transition: box-shadow 0.2s, border-color 0.2s;
            background: linear-gradient(135deg, #fafaf9 0%, #fff 100%);
        }
        .notion-card:hover {
            border-color: #b5b5b5;
            box-shadow: 0 4px 16px 0 rgba(55, 53, 47, 0.10), 0 3px 6px 0 rgba(55, 53, 47, 0.10);
        }
    </style>
    <script>
        // Current time display
        function updateTime() {
            const el = document.getElementById('current-time');
            if (!el) return;
            const now = new Date();
            el.textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        }
        setInterval(updateTime, 1000);
        updateTime();

        function filterNotes() {
            const input = document.getElementById('searchBar');
            const filter = input.value.toLowerCase();
            const cards = document.querySelectorAll('.notion-card');

            cards.forEach(card => {
                const title = card.querySelector('h3')?.textContent.toLowerCase() || '';
                const content = card.querySelector('div.text-neutral-600')?.textContent.toLowerCase() || '';

                if (title.includes(filter) || content.includes(filter)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
    });


    }
    </script>
</x-app-layout>
