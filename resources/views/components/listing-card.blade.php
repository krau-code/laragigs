@props(['listing'])

<x-card>
    <div class="flex">
        {{-- Image --}}
        <img class="hidden w-48 mr-6 md:block" src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png')}}" alt="" />

        <div>
            {{-- Title --}}
            <h3 class="text-2xl">
                <a href="/listings/{{ $listing->id }}">{{ $listing->title }}</a>
            </h3>

            {{-- Company --}}
            <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
            
            {{-- Tags --}}
            <x-listing-tags :tagsCsv="$listing->tags" />

            {{-- Location --}}
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{ $listing->location }}
            </div>
        </div>
    </div>
</x-card>