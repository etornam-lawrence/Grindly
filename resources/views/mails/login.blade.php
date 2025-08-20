<x-guest-layout>
    <div class="py-10 px-8">
        <p class="user">
            Hey! {{$user->name}}, you have successfully logged in to your account with {{ $user->email }} email.

        </p>
        <p class="foote">
            If you didn't initiate this request, kindly do nothing
        </p>
    </div>
</x-guest-layout>