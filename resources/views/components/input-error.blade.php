@props(['messages'])

@if ($messages)
    <ul class="list-unstyled text-sm text-danger space-y-1">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
