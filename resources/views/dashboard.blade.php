<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between mb-2">
            <div>
                <h2 class="text-2xl font-bold text-neutral-800">Welcome back, Grinder 👋</h2>
                <p class="text-sm text-gray-500">Here’s your progress for today</p>
            </div>
            <div id="current-time" class="text-neutral-700 text-sm font-mono px-5 py-3 rounded-lg bg-neutral-100 border border-neutral-200">
                
            </div>
        </div>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow">
                    <h3 class="text-lg font-semibold text-neutral-800">XP Points</h3>
                    <p class="mt-2 text-4xl font-bold text-indigo-600">{{ $totalXP }} XP</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow">
                    <h3 class="text-lg font-semibold text-neutral-800">Current Streak</h3>
                    <p class="mt-2 text-4xl font-bold text-orange-500">🔥 {{ $user->current_streak }} days</p>
                    <p class="mt-1 text-sm text-gray-500">Keep the momentum going!</p>
                    <p class="mt-1 text-sm text-gray-500">Last visit: {{$user->last_login_date ? $user->last_login_date->diffForHumans() : 'Today'}}</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow">
                    <h3 class="text-lg font-semibold text-neutral-800 mb-2">Recent Activity</h3>
                    <ul class="space-y-2 text-sm text-gray-700">
                        @if($recents->isEmpty())
                            <li class="text-gray-400">No recent activity.</li>
                        @else
                            @foreach ($recents as $recentActivity)
                                
                                <li>✅ {{ $recentActivity->description }} <span class="block text-xs text-gray-400">{{ $recentActivity->created_at->diffForHumans() }}</span></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Video Learning -->
            {{-- <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-lg font-semibold text-neutral-800 mb-4">🎥 Learn Vast Topics</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @php
                        $videos = [
                            ['title' => 'Artificial Intelligence Explained', 'url' => 'https://www.youtube.com/embed/8jLOx1hD3_o'],
                            ['title' => 'Quantum Computing Basics', 'url' => 'https://www.youtube.com/embed/3u1fu6f8Hto'],
                            ['title' => 'Neural Networks Demystified', 'url' => 'https://www.youtube.com/embed/aircAruvnKk'],
                            ['title' => 'The Math of Machine Learning', 'url' => 'https://www.youtube.com/embed/IpGxLWOIZy4'],
                            ['title' => 'Introduction to Blockchain', 'url' => 'https://www.youtube.com/embed/SSo_EIwHSd4'],
                            ['title' => 'Understanding Cloud Computing', 'url' => 'https://www.youtube.com/embed/2LaAJq1lB1Q'],
                            ['title' => 'What is Data Science?', 'url' => 'https://www.youtube.com/embed/X3paOmcrTjQ'],
                            ['title' => 'Basics of Cybersecurity', 'url' => 'https://www.youtube.com/embed/inWWhr5tnEA'],
                        ];
                    @endphp

                    @foreach ($videos as $video)
                        <div>
                            <iframe class="w-full aspect-video rounded-lg" src="{{ $video['url'] }}" title="{{ $video['title'] }}" frameborder="0" allowfullscreen></iframe>
                            <p class="mt-2 text-sm font-medium text-gray-700">{{ $video['title'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div> --}}

        </div>
    </div>
    <script>
        // Update current time every second
        function updateCurrentTime() {
            const now = new Date();
            const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            document.getElementById('current-time').textContent = now.toLocaleTimeString([], options);
        }

        setInterval(updateCurrentTime, 1000);
        updateCurrentTime(); // Initial call to set time immediately
    </script>
</x-app-layout>


