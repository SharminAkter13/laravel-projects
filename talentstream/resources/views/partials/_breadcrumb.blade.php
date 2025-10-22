@if (!empty($breadcrumbs))
<nav aria-label="breadcrumb" class="mt-3">
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $label => $url)
            {{-- Check if this is the last item (current page) --}}
            @if ($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
            @else
                <li class="breadcrumb-item"><a href="{{ $url }}">{{ $label }}</a></li>
            @endif
        @endforeach
    </ol>
</nav>
@endif