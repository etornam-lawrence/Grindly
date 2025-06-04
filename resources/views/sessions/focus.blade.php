<x-app-layout>
    
    <script>
        function focusTimer(duration) {
            return {
                timeLeft: duration * 60, // in seconds
                displayTime: '',
                intervalId: null,
                isPaused: false,

                startTimer() {
                    this.updateDisplay();
                    this.intervalId = setInterval(() => {
                        if (!this.isPaused && this.timeLeft > 0) {
                            this.timeLeft--;
                            this.updateDisplay();
                        }
                        if (this.timeLeft <= 0) {
                            clearInterval(this.intervalId);
                            // You can trigger "complete" automatically here if you want
                        }
                    }, 1000);
                },

                pauseTimer() {
                    this.isPaused = true;
                },

                resumeTimer() {
                    this.isPaused = false;
                },

                cancelSession() {
                    clearInterval(this.intervalId);
                    // Optionally redirect to a route or send a cancellation request
                    window.location.href = '{{ route('sessions.cancel', $session->id) }}';
                },

                updateDisplay() {
                    const mins = String(Math.floor(this.timeLeft / 60)).padStart(2, '0');
                    const secs = String(this.timeLeft % 60).padStart(2, '0');
                    this.displayTime = `${mins}:${secs}`;
                }
            };
        }

            window.addEventListener('beforeunload', (event) => {
            // Trigger cancel
            navigator.sendBeacon("{{ route('sessions.cancel', $session->id) }}");
        });


    </script>
    
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-md">
        
        <div 
        
            x-data="focusTimer({{ $duration }})" 
            x-init="startTimer()" 
            class="bg-white rounded-3xl shadow-2xl p-10 min-w-[340px] flex flex-col items-center gap-6 border border-blue-100"
        >
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Focusing on') }} : {{ $session->course_name }} - {{ $session->topic }}
                </h2>
            
            <h1 class="text-6xl font-extrabold mb-2 text-blue-700 transition-all drop-shadow-lg" x-text="displayTime"></h1>
            <span class="text-gray-400 text-lg mb-4 tracking-wide font-medium">{{ __('Focus Timer') }}</span>
           
               
            <div class="flex space-x-4 justify-center mt-6" id="actions">
                <!-- Pause Button -->
                <button x-show="!isPaused" @click="pauseTimer" type="button"
                    class="bg-yellow-500 text-white rounded px-4 py-2 hover:bg-yellow-600 transition">
                    Pause
                </button>

                <!-- Resume Button -->
                <button x-show="isPaused" @click="resumeTimer" type="button"
                    class="bg-green-500 text-white rounded px-4 py-2 hover:bg-green-600 transition">
                    Resume
                </button>

                <!-- Cancel Button -->
                <button @click="cancelSession" type="submit" form="cancelSession"
                    class="bg-red-500 text-white rounded px-4 py-2 hover:bg-red-600 transition">
                    Cancel
                </button>

                <form action={{ route('sessions.cancel', $session->id) }} method="POST" id="cancelSession"  class="hidden">
                    @csrf
                    {{-- @method('PATCH') --}}
                </form>
            </div>

        </div>
    </div>

   

</x-app-layout>