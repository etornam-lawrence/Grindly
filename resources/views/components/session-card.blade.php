<div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
    <div class="px-6 py-5">
        <h3 class="font-semibold text-lg text-gray-900 mb-1">
            {{ $session->course_name }} &mdash; {{ $session->topic }}
        </h3>
        <ul class="text-gray-700 text-sm space-y-1">
            <li>
                <span class="font-medium">Date:</span>
                {{ $session->date->format('F j, Y') }}
            </li>
            <li>
                <span class="font-medium">Start Time:</span>
                {{ $session->start_time }}
            </li>
            <li>
                <span class="font-medium">Duration:</span>
                {{ $session->duration }} minutes
            </li>
            <li>
                <span class="font-medium">Status:</span>
                {{ ucfirst($session->status) }}
            </li>
        </ul>
    </div>
    <div class="px-6 pb-4 flex justify-end">
        <a href="{{ route('sessions.show', $session->id) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded transition-colors duration-150">
            More
        </a>
    </div>
</div>