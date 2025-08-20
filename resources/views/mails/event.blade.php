<x-guest-layout>
    <div class="py-10 px-8">
        <p class="user">
            Hey! {{$session->topic}}, you have successfully logged in to your account with {{ $session->study_duration }} email.

        </p>
        <p class="foote">
            If you didn't initiate this request, kindly do nothing
        </p>
    </div>
</x-guest-layout>