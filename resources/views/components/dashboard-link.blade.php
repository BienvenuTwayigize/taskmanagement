<div>
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
    @php
        $user = Auth::user();
        $dashboardUrl = route('dashboard'); // Default fallback

        if ($user->type == 1) {
            $dashboardUrl = route('admin.home');
        } elseif ($user->type == 0) {
            $dashboardUrl = route('student');
        }
    @endphp

<a href="{{ $dashboardUrl }}" class="text-blue-500 hover:underline">
    {{ __('Dashboard') }}
</a>
</div>