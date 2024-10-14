<div class="notification">
    @if (session()->has('noti'))
        <div
            class="message {{ session()->get('noti')['type'] == config('base.noti.success') ? 'success' : 'error' }}">
            {{ session()->get('noti')['message'] }}
        </div>

        <script>
            setTimeout(() => {
                $('.message').delay(5000).slideUp();
            }, 3000);
        </script>
    @endif
</div>
