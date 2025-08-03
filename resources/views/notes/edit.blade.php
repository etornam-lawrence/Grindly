<x-app-layout>
    <div class="flex flex-col md:flex-row min-h-screen bg-neutral-50 text-neutral-900">

          {{-- Note Creation Modal --}}
        <x-modal name="plan-modal" :show="false" max-width="md" focusable>
            <div class="p-8 bg-white rounded-xl">
                <h2 class="text-2xl font-semibold text-neutral-900 mb-2">
                    {{ __('Add a Productive Note') }}
                </h2>
                <p class="text-neutral-500 mb-6">
                    {{ __("Write down tasks, ideas, or anything that moves you forward. Productivity starts here.") }}
                </p>

                <form method="POST" action="{{ route('notes.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text"
                            class="mt-1 block w-full rounded-lg border-neutral-300 focus:border-neutral-800 focus:ring-neutral-800"
                            required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div class="flex justify-end gap-3">
                        <x-secondary-button x-on:click="$dispatch('close-modal', 'plan-modal')" class="rounded-xl">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button class="rounded-xl bg-neutral-800 hover:bg-neutral-900">
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </x-modal>
        <!-- Sidebar -->
        
        <aside class="w-full md:w-72 border-b md:border-b-0 md:border-r border-neutral-200 bg-white p-4 md:p-6 flex flex-col">

            <!-- Header with title, New Note button & Home link -->
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xl font-bold text-neutral-900">Notes</h2>
            </div>

            <div class="flex items-center justify-between mb-6">
                
                <div class="flex items-center gap-2">
                    <!-- New Note Button -->
                    <x-primary-button 
                        x-data 
                        x-on:click="$dispatch('open-modal', 'plan-modal')"
                        class="bg-neutral-800 hover:bg-neutral-900 text-white px-4 py-1.5 text-sm rounded-lg shadow transition font-medium">
                        <svg class="w-4 h-4 mr-1 -mt-0.5 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('New Note') }}
                    </x-primary-button>

                    <!-- Back to Home -->
                    <a href="{{ route('notes.index') }}"
                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-neutral-100 hover:bg-neutral-200 text-sm text-neutral-700 font-medium rounded-lg transition">
                        <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Home
                    </a>
                </div>
            </div>

            <!-- Search Input -->
            <div class="py-2 mb-2">
                <input type="text" id="searchBar" placeholder="Search notes..."
                        class="block w-md sm:w-60 rounded-xl border border-gray-300 focus:border-gray-500 focus:ring-gray-500 px-4 py-2 text-sm"
                        onkeyup="searchNotesList()">
            </div>

            <!-- List of Notes -->
            <ul id="noteList" class="overflow-y-auto flex-1 space-y-1.5 pr-1">
                @foreach ($notes as $n)
                    <li class="relative group noteList">
                        <a href="{{ route('notes.edit',['note' => $n->id, 'slug' => Str::slug($n->title)]) }}"
                        class="block px-3 py-2 rounded-lg text-sm transition-all duration-200 ease-in-out 
                                {{ $note && $note->id === $n->id 
                                    ? 'bg-neutral-200 text-neutral-900 font-semibold' 
                                    : 'hover:bg-neutral-100 text-neutral-600' }}"
                        data-title="{{ strtolower($n->title) }}">
                            {{ $n->title ?: 'Untitled' }}
                        </a>

                        <!-- Notion-style menu button -->
                        <div class="bin-icon absolute right-2 top-1/2 -translate-y-1/2 transition group-hover:opacity-100 opacity-0">
                            <form method="POST" action="{{ route('notes.destroy', $n->id) }}"
                                onsubmit="return confirm('Delete this note?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fa-regular fa-trash-can focus:ring-2 focus:ring-neutral-300 rounded-full p-1">
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>


        </aside>


        <!-- Main Note Editor -->
        <main class="flex-1 bg-white p-4 md:p-10">
            @if ($note)
                {{-- Sticky Save and Search Bar --}}
                <div class="sticky top-0 z-10 bg-white py-2 mb-4 border-b border-neutral-200 flex flex-col md:flex-row md:items-center justify-between gap-2">
                    {{-- Save Button --}}
                    <x-primary-button  form="noteForm" class="bg-neutral-800 hover:bg-neutral-900 rounded-xl px-6 py-2 shadow font-semibold transition">
                        <svg class="inline-block w-5 h-5 mr-2 -mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Save Note
                    </x-primary-button >


                    {{-- Current Time  --}}
                    <div id="current-time" class="ml-auto text-neutral-700 text-sm font-mono px-4 py-1.5 rounded-lg bg-neutral-100 border border-neutral-200">
                    </div>

                </div>

                {{-- Title & Content Fields --}}
                <form method="POST" id="noteForm" action="{{ route('notes.update', ['note'=>$note->id, 'slug'=>Str::slug($note->title)]) }}" class="space-y-6 max-w-4xl mx-auto noteContent">
                    @csrf
                    @method('PATCH')

                    <input type="text" name="title" id="noteTitle"
                           value="{{ $note->title }}"
                           class="w-full text-3xl font-bold border-none focus:outline-none focus:ring-0 bg-transparent"
                           placeholder="Untitled" />

                    <textarea name="content" id="noteContent" 
                              class="noteContent  w-full min-h-[80vh] text-base leading-relaxed border border-transparent focus:ring-0 focus:outline-none bg-transparent resize-none"
                              placeholder="Start writing your note here...">{{ $note->content }}</textarea>
                   

                </form>
            @else
                <div class="text-center text-neutral-400 mt-24 text-lg">
                    Select or create a note to begin writing.
                </div>
            @endif
        </main>
    </div>

    {{-- JS: Live Search (Sidebar + In-Note) --}}
    <script>
        // Sidebar search through all notes
        document.getElementById('sidebarSearch').addEventListener('input', function (e) {
            const query = e.target.value.toLowerCase();
            const notes = document.querySelectorAll('.note-item');

            notes.forEach(note => {
                const title = note.getAttribute('data-title');
                note.style.display = title.includes(query) ? 'block' : 'none';
            });
        });

        // Current time display
         function updateTime() {
            const el = document.getElementById('current-time');
            if (!el) return;
            const now = new Date();
            el.textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        }
        setInterval(updateTime, 1000);
        updateTime();
        
         const openDropdowns = new Set();

        function toggleDropdown(event, id) {
            event.stopPropagation();

            const target = document.getElementById(`dropdown-${id}`);

            // Close all other open dropdowns
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                if (el !== target) el.classList.add('hidden');
            });

            // Toggle the current one
            target.classList.toggle('hidden');
        }

        // Close dropdowns on outside click
        window.addEventListener('click', () => {
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
        });


        function searchNotesList() {
             const input = document.getElementById('searchBar');
            const filter = input.value.toLowerCase();
            const cards = document.querySelectorAll('.noteList');

            cards.forEach(card => {
                const title = card.querySelector('a')?.textContent.toLowerCase() || '';
                const content = card.textContent.toLowerCase() || '';

                if (title.includes(filter) || content.includes(filter)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
  

</x-app-layout>
