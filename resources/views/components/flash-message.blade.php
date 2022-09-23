@if(session()->has('message'))
     <div 
        {{-- Alpine JS Framework --}}
        
        {{-- Declare Data --}}
        x-data="{show: true}"

        {{-- Run When Element is Initialized --}}
        x-init="setTimeout(() => show = false, 3000)"

        {{-- Toggle Visibility --}}
        x-show="show"

        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white  px-48 py-3"
    >
        <p>
            {{ session('message') }}
        </p>
     </div>
@endif