<x-app-layout>
    <x-slot name="header">
        <!-- Header: Title, Description & Clock -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">
                    {{ __('Study Sessions') }}
                </h2>
                <p class="mt-2 text-sm text-gray-600 max-w-xl">
                    {{ __('Track your sessions, monitor your progress, and stay on top of your learning goals.') }}
                </p>
            </div>
            <div class="flex items-center">
                <div id="current-time"
                    class="text-neutral-700 text-sm font-mono px-4 py-2 rounded-xl bg-neutral-100 border border-neutral-200 shadow-inner">
                </div>
            </div>
        </div>

        <!-- Stats: XP, Time, Sessions, Progress -->
        <div class="mt-8 grid gap-6 text-sm text-gray-700 grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 items-end">

            <!-- XP Badge -->
            <div class="flex flex-col items-center bg-gradient-to-br from-yellow-100 via-yellow-50 to-yellow-200 border border-yellow-200 rounded-2xl p-4 shadow-md">
                <div class="flex items-center gap-2">
                    <svg class="w-8 h-8 text-yellow-500 drop-shadow" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l2.09 6.26L20 9.27l-5 3.64L16.18 20 12 16.77 7.82 20 9 12.91l-5-3.64 5.91-.01z"/>
                    </svg>
                    <span class="font-extrabold text-xl">
                        {{ $totalXP }} <span class="uppercase text-yellow-700 text-base font-semibold">XP</span>
                    </span>
                </div>
                <span class="text-xs text-yellow-500 mt-1 font-medium">Level {{ floor($totalXP / 100) + 1 }}</span>
            </div>

            <!-- Total Study Time -->
            <div class="flex flex-col items-center bg-gradient-to-br from-blue-100 via-blue-50 to-blue-200 border border-blue-200 rounded-2xl p-4 shadow-md">
                <div class="flex items-center gap-2 mb-1">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 6v6l4 2"/>
                    </svg>
                    <span class="font-bold text-lg">{{ $totalStudyTime }}</span>
                </div>
                <span class="uppercase text-xs font-semibold text-blue-700 tracking-wide">Minutes Studied</span>
                @if ($totalStudyTime >= 60)
                    <span class="text-xs text-blue-400 mt-1">{{ number_format($totalStudyTime / 60, 1) }} hrs</span>
                @endif
            </div>

            <!-- Total Sessions -->
            <div class="flex flex-col items-center bg-gradient-to-br from-green-100 via-green-50 to-green-200 border border-green-200 rounded-2xl p-4 shadow-md">
                <div class="flex items-center gap-2 mb-1">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="4" y="4" width="16" height="16" rx="2"/>
                        <path d="M9 9h6v6H9z" fill="currentColor"/>
                    </svg>
                    <span class="font-bold text-lg">{{ $totalSessions }}</span>
                </div>
                <span class="uppercase text-xs font-semibold text-green-700 tracking-wide">Sessions</span>
                @if ($totalSessions >= 10)
                    <span class="text-xs text-green-500 mt-1">Streak: {{ $totalSessions }} 🔥</span>
                @endif
            </div>

            <!-- Progress Bar to Next Level -->
            <div class="flex flex-col col-span-2 sm:col-span-1 justify-end bg-gradient-to-br from-yellow-100 via-yellow-50 to-yellow-200 border border-yellow-200 rounded-2xl p-4 shadow-md">
                @php
                    $level = floor($totalXP / 100) + 1;
                    $xpThisLevel = $totalXP % 100;
                @endphp

                <span class="uppercase text-xs text-gray-500 font-semibold mb-1">Next Level Progress</span>
                <div class="w-full bg-neutral-200 rounded-full h-3 shadow-inner overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 h-3 rounded-full transition-all duration-500"
                        style="width: {{ min(100, $xpThisLevel) }}%">
                    </div>
                </div>
                <span class="text-xs text-gray-400 mt-1">{{ $xpThisLevel }}/100 XP to Level {{ $level + 1 }}</span>
            </div>

        </div>

    </x-slot>

        
        {{-- search-bar --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <input type="text" id="searchBar" placeholder="Search by course, topic, or date..."
            class="mt-4 block w-full sm:w-1/2 lg:w-1/3 rounded-xl border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 px-4 py-2 text-sm"
            onkeyup="filterSessions()">
    </div>
    {{-- page body --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8 px-4 sm:px-6 lg:px-8">

        {{-- ⏱️ Timer / Form Section --}}
        <div class="timer-here col-span-1 flex flex-col">
            <div class="flex-1 bg-white rounded-3xl p-6 border border-gray-200 shadow-2xl flex flex-col justify-between">
                <div class="mb-6">
                    <form action="{{ route('sessions.store') }}" id="timerForm" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="study_duration" id="study_duration">

                        <label for="title" class="block text-sm font-bold text-gray-700 mb-1">
                            What are you studying today?
                        </label>
                        <input type="text" id="title" name="title"
                            class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-inner bg-gray-50 focus:ring-2 focus:ring-yellow-400 focus:outline-none transition duration-150"
                            placeholder="Study topic...">

                        <input type="hidden" name="start_time" id="start_time">
                        <input type="hidden" name="end_time" id="end_time">
                    </form>
                </div>

                <div class="flex items-center justify-center mb-6 gap-4">
                    <button id="decrease-time"
                        class="text-gray-600 hover:text-yellow-500 text-2xl transition duration-150"
                        title="Decrease Time">
                        <i class="fa-solid fa-backward-step"></i>
                    </button>

                    <div id="duration-display"
                        class="text-5xl font-extrabold font-mono px-8 py-4 border-y border-gray-300 text-gray-800 bg-gray-100 rounded-2xl shadow-inner transition duration-150 min-w-[8rem] text-center">
                    </div>

                    <button id="increase-time"
                        class="text-gray-600 hover:text-yellow-500 text-2xl transition duration-150"
                        title="Increase Time">
                        <i class="fa-solid fa-forward-step"></i>
                    </button>
                </div>

                <div class="flex flex-wrap justify-center gap-4">
                    <!-- Start Button -->
                    <div class="flex flex-col items-center">
                        <button title="start timer" id="start-timer"
                            class="text-green-600 hover:text-green-700 text-xl transition duration-150">
                            <i class="fa-solid fa-play"></i>
                        </button>
                        <span class="text-xs text-gray-500 mt-1">Start</span>
                    </div>

                    <!-- Stop Button -->
                    <div class="flex flex-col items-center">
                        <button id="stop-timer" title="stop"
                            class="text-red-600 hover:text-red-700 text-xl transition duration-150">
                            <i class="fa-solid fa-stop"></i>
                        </button>
                        <span class="text-xs text-gray-500 mt-1">Stop</span>
                    </div>

                    <!-- Resume Button -->
                    <div class="flex flex-col items-center">
                        <button id="resume-timer" title="resume"
                            class="text-yellow-600 hover:text-yellow-700 text-xl transition duration-150">
                            <i class="fa-solid fa-play"></i>
                        </button>
                        <span class="text-xs text-gray-500 mt-1">Resume</span>
                    </div>

                    <!-- Reset Button -->
                    <div class="flex flex-col items-center">
                        <button id="reset-timer" title="reset"
                            class="text-blue-600 hover:text-blue-700 text-xl transition duration-150">
                            <i class="fa-solid fa-rotate-right"></i>
                        </button>
                        <span class="text-xs text-gray-500 mt-1">Reset</span>
                    </div>
                </div>
            </div>
        </div>

                {{-- 🗂️ Study Chart Placeholder --}}
        <div class="col-span-1 flex flex-col">
            <div class="flex-1 bg-white rounded-3xl p-2 border border-gray-200 shadow-xl flex flex-col justify-between">
                <h3 class="text-gray-900 text-lg font-semibold m-auto">Consistentcy based Study Chart📈</h3>
                <div class="flex items-center justify-center h-300">
                    <canvas id="studyChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
        
    </div>
    
    <div class=" grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8 px-4 sm:px-6 lg:px-8">
        

        {{-- 🕑 Recent Sessions Table --}}
        <div class="col-span-1 flex flex-col">
            <div class="flex-1 bg-white rounded-3xl p-6 border border-gray-200 shadow-xl flex flex-col justify-between">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-600 table-auto md:table-fixed">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Focus</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Duration</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($sessions->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center text-gray-500 py-4">No sessions found.</td>
                                </tr>
                            @else
                                @foreach ($sessions as $session)
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-800">{{ $session->title }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-800">{{ $session->study_duration }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-800">{{ $session->start_time->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
            {{-- //pagination --}}
            <div class="mt-12 flex justify-center">
                <div class="inline-flex rounded-2xl shadow-lg bg-white border border-gray-200 overflow-hidden">
                    {{ $sessions->links() }}
                </div>
            </div>
            
        </div>
        
    </div>
    <div class="mt-8 px-4 sm:px-6 lg:px-8">
        <p class="text-sm text-gray-500">
            Note: The timer will automatically save your session when it ends.
        </p>
    </div>

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

        function filterSessions() {
            const input = document.getElementById('searchBar');
            const filter = input.value.toLowerCase();
            const cards = document.querySelectorAll('.session-card');

            cards.forEach(card => {
                const course = card.dataset.course;
                const topic = card.dataset.topic;
                const date = card.dataset.date;

                if (
                    course.includes(filter) ||
                    topic.includes(filter) ||
                    date.includes(filter)
                ) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

        }

        //timer interactivity.
        let currentDuration = 25;
        let timerInterval;
        let remainingTime = currentDuration * 60; // in seconds
        let isRunning = false;
        let start_time;
        let end_timer;
        let timeId; // to store the interval ID
        let isPaused = false;



        //updateTimeOnChange
        function updateDuration(){
            const mins = Math.floor(remainingTime /  60);
            const seconds = remainingTime % 60;
            let formattedMins = mins < 10 ? '0' + mins : mins;
            let formattedSeconds = seconds < 10 ? '0' +seconds :seconds;
            document.getElementById('duration-display').textContent = formattedMins + ':' + formattedSeconds;
            
        }
        updateDuration(); // Initial call to set the display

        //listeneing for increase time click events
        document.getElementById('increase-time').addEventListener('click', () => {
            if(!isRunning){
                currentDuration += 5;
                remainingTime = currentDuration * 60;
                updateDuration();
            }
        })

        //listenining for decrease in time click events
        document.getElementById('decrease-time').addEventListener('click', () => {
            if(!isRunning && currentDuration > 5){
                currentDuration -= 5;
                remainingTime = currentDuration * 60;
                updateDuration();
            }else if(currentDuration <= 1){
                alert('Minimum duration is 5 minutes');
            }
        })

        //add event listener to start button(selecting the start button by id)
        const startButton = document.getElementById('start-timer');
        function startTimer() {

            if (isRunning) return;
            isRunning = true;

            //unit time in js is milliseconds.
            start_time = new Date();
            study_duration.value = currentDuration; // set the hidden input value
            end_timer = start_time.getTime() + currentDuration * 60 * 1000; // end time in milliseconds


            //wrap end_time in Date object
            end_timer = new Date(end_timer);

            //update the hidden input fields with start and end time.
            document.getElementById('start_time').value = start_time.toISOString()
            document.getElementById('end_time').value = end_timer.toISOString();
            const titleInput = document.getElementById('title');
            if (titleInput) {
            titleInput.value = titleInput.value.trim() || 'Study Session';
            }

            
            const increaseButton = document.getElementById('increase-time');
            const decreaseButton = document.getElementById('decrease-time');
            const resumeButton = document.getElementById('resume-timer');

            //disable input fields
            // titleInput.disabled = true;

            //disable buttons
            startButton.disabled = true;
            startButton.classList.add('opacity-50', 'cursor-not-allowed');

            increaseButton.disabled = true;
            decreaseButton.disabled = true;

            //setInterval; js function for repetitive looping.
            timeId = setInterval(() => {
                remainingTime -= 1;
                updateDuration();
                if(remainingTime === 0){
                    clearInterval(timeId);
                    isRunning = false;

                    //prevent resuming
                    resumeButton.disabled = true;
                    resumeButton.classList.add('opacity-50', 'cursor-not-allowed');

                    //allow start button again
                    startButton.disabled=false;

                    //automatically save data to DB
                    document.getElementById('timerForm').submit();
                    const form = document.getElementById("timerForm");
                    const formData = new FormData(form);

                    // Log form data
                    for (let [key, value] of formData.entries()) {
                    console.log(key + ": " + value);
                    }
                }
            }, 1000);
        }
        // Attach the click event listener to the start button
        startButton.addEventListener('click', startTimer);

       

        //stop timer
        const stopButton = document.getElementById('stop-timer');
        stopButton.addEventListener('click', () => {
            if(isRunning){
                clearInterval(timeId);
                isRunning = false;
            }else{
                alert('Timer is not running');
            }
        });

        //resume timer
        const resumeButton = document.getElementById('resume-timer');
        resumeButton.addEventListener('click', () => {
            if(!isRunning && remainingTime > 0){
                isRunning=true;
                timeId = setInterval(() => {
                remainingTime -= 1;
                updateDuration();
                if(remainingTime === 0){
                    clearInterval(timeId);
                    isRunning = false;
                }
            }, 1000);

            }else return;
        });

        //reset timer
        const resetButton = document.getElementById('reset-timer');
        resetButton.addEventListener('click', () => {
            clearInterval(timeId);
            isRunning = false;
            remainingTime = currentDuration * 60 //initial duration.
            updateDuration();
            startButton.disabled = false;
            startButton.classList.remove('opacity-50', 'cursor-not-allowed');
        });
        

    </script>
</x-app-layout>
