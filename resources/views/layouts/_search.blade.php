<form action="" class="w-3/4 absolute top-5 right-2">
    <div class="relative border-2 border-gray-100 rounded-lg">
        <div class="absolute top-0 left-0">
        {{-- <div class="absolute top-4 left-3"> --}}
            <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
        </div>
        <x-input 
            id="search" 
            name="search" 
            type="text"
            class="h-8 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:ouline-none"
            placeholder="Search"
        />
        <div class="absolute top-0 right-0">
            <button type="submit" class="h-8 w-20 text-white rounded-lg bg-green-600  hover:bg-green-500 hover:text-green-700 hover:border-green-300 hover:border-2">
                Search
            </button>
        </div>
    </div>
</form>