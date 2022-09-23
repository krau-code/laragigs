{{-- Traditional PHP Syntax --}}
{{-- 
<h1><?php echo $heading; ?></h1>
<?php foreach($listings as $listing): ?>
    <h2><?php echo $listing['title']; ?></h2>
    <p><?php echo $listing['description']; ?></p>
<?php endforeach; ?>
--}}
{{-- -------------------------------------------------------------- --}}

{{-- Laravel Blade Syntax --}}
@extends('layout')

@section('title', 'Find Laravel Jobs & Projects')

@section('content')
    @include('partials._hero')
    @include('partials._search')
    
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        {{-- PHP Directive
            @php
                $test = "hello world";
            @endphp
            {{ $test }}
        --}}

        {{-- If Directive --}}
        {{--
            @if (count($listings) == 0)
                <p>No Listings Found</p>
            @endif
        --}}

        {{-- Unless Directive --}}
        @unless (count($listings) == 0)
            @foreach ($listings as $listing)
                {{-- Data / Listing Card --}}
                <x-listing-card :listing="$listing" />
            @endforeach
    </div>
        @else
    </div>
    <p class="text-center">No Listings Found</p>
        @endunless

    {{-- Pagination --}}
    <div class="mt-6 p-4">
        {{ $listings->links() }}
    </div>
@endsection