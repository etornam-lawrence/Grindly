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
                    <p class="mt-1 text-sm text-gray-500">Last visit: {{$user->last_login_date}}</p>
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

            <!-- Profitable Learning Resources -->
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="text-lg font-semibold text-neutral-800 mb-4">💡 Profitable Learning Resources</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @php
                        $resources = [
                            ['title' => 'Effective Study Techniques', 'desc' => 'Master proven methods to boost retention and ace exams.', 'url' => 'https://www.coursera.org/learn/learning-how-to-learn', 'platform' => 'Coursera'],
                            ['title' => 'Time Management for Students', 'desc' => 'Learn to prioritize, plan, and manage your college workload.', 'url' => 'https://www.edx.org/course/time-management', 'platform' => 'edX'],
                            ['title' => 'Public Speaking Essentials', 'desc' => 'Develop confidence and skills for presentations and speeches.', 'url' => 'https://www.udemy.com/course/public-speaking/', 'platform' => 'Udemy'],
                            ['title' => 'Critical Thinking & Problem Solving', 'desc' => 'Sharpen your reasoning and analytical skills for any subject.', 'url' => 'https://www.futurelearn.com/courses/logical-and-critical-thinking', 'platform' => 'FutureLearn'],
                            ['title' => 'Personal Finance 101', 'desc' => 'Understand budgeting, saving, and managing your money in college.', 'url' => 'https://www.khanacademy.org/college-careers-more/personal-finance', 'platform' => 'Khan Academy'],
                            ['title' => 'Career Planning & Development', 'desc' => 'Explore career options and prepare for the job market.', 'url' => 'https://www.coursera.org/learn/career-success', 'platform' => 'Coursera'],
                        ];
                    @endphp

                    @foreach ($resources as $res)
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex justify-between text-sm font-medium text-gray-700">
                                <span>{{ $res['title'] }}</span>
                                <a href="{{ $res['url'] }}" target="_blank" class="text-indigo-600 hover:underline">{{ $res['platform'] }}</a>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">{{ $res['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Video Learning -->
            <div class="bg-white p-6 rounded-2xl shadow">
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
            </div>

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


