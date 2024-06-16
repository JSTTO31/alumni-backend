@props(['url'])

<tr>
    <td class="header">
        <a href="{{config('app.frontend_url')}}" target="_blank" style="display: flex;justify-content:center;align-items:center;">
            <img src="http://localhost:8000/storage/chief.png" class="logo" alt="Alumni Tracking Logo">
            {{ $slot }}
        </a>
    </td>
</tr>
