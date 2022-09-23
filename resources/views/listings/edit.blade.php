@extends('layout')

@section('title', 'Edit ' . $listing->title)

@section('content')
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        {{-- Header --}}
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit a Gig
            </h2>
            <p class="mb-4">Edit: {{ $listing->title }}</p>
        </header>

        {{-- Form --}}
        {{-- Enctype Attribute is required when there's File Input in the form --}}
        <form method="POST" action="/listings/{{ $listing->id }}" enctype="multipart/form-data">
            {{-- csrf directive is used for every POST form --}}
            {{-- Prevents cross site scripting attacks --}}
            @csrf
            {{-- Method Directive to get sent as a PUT --}}
            @method('PUT')

            {{-- Company --}}
            <div class="mb-6">
                <label for="company" class="inline-block text-lg mb-2" >
                    Company Name
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company" value="{{ $listing->company }}" /> {{-- old helper is used to keep the data when there's an error message --}}

                {{-- Error Message for a Text Field --}}
                @error('company')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Title --}}
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">
                    Job Title
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" placeholder="Example: Senior Laravel Developer" value="{{ $listing->title }}" />

                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Location --}}
            <div class="mb-6">
                <label for="location" class="inline-block text-lg mb-2" >
                    Job Location
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location" placeholder="Example: Remote, Boston MA, etc" value="{{ $listing->location }}" />

                @error('location')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">
                    Contact Email
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{ $listing->email }}"/>

                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Website --}}
            <div class="mb-6">
                <label for="website" class="inline-block text-lg mb-2">
                    Website/Application URL
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website" value="{{ $listing->website }}" />

                @error('website')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tags --}}
            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tags (Comma Separated)
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags" placeholder="Example: Laravel, Backend, Postgres, etc"  value="{{ $listing->tags }}"/>

                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Logo --}}
            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Company Logo
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

                <img class="w-48 mt-2 mr-6 mb-6" src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png')}}" alt="" />

                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">
                    Job Description
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10" placeholder="Include tasks, requirements, salary, etc">{{ $listing->description }}</textarea>

                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Update Gig
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
@endsection
