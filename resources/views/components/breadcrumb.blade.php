<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
    <ol class="breadcrumb">

        @foreach ($data as $item)
            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}" aria-current="page">
                @if ($loop->last)
                    <span>{{ $item['name'] }}</span>
                @else
                    <a href="{{ route($item['url']) }}">{{ $item['name'] }}</a>
                @endif
            </li>
        @endforeach

        {{-- <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Layout Vertical Navbar
        </li> --}}
    </ol>
</nav>
