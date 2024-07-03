<nav class="bg-white text-white px-5 py-1 fixed w-full z-10">
  <div class="container mx-auto flex justify-between items-center">
    <!-- Hamburger icon -->
    <button id="hamburger" class="md:hidden focus:outline-none">
      <svg class="w-6 h-6 text-momentum2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>
    <!-- Admin Dashboard Title -->
    {{-- <div class="text-lg font-semibold flex-grow text-center md:flex-grow-0">Admin Dashboard</div> --}}
    <a wire:navigate href={{ route("home") }} class="flex-grow md:flex-grow-0 ml-0 md:ml-2">
      <img src="{{ asset('images/logo.png') }}" alt="" srcset="" class="object-cover h-12 mx-auto">
    </a>
    <!-- User Avatar -->
    <div class="relative">
      <div id="user-avatar" class="flex items-center gap-1 cursor-pointer">
        <img id="" src="{{ asset('images/man.png') }}" alt="User Avatar"
          class="w-10 h-10 rounded-full bg-momentum1">
        <p class="text-momentum2 text-sm font-medium hidden md:block">{{ Auth::guard('student')->user()->name }}</p>
      </div>
      <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20">
        <a wire:navigate href="{{ route('profile') }}"
          class="block px-4 py-2 font-medium text-gray-800 hover:bg-gray-200 flex gap-x-3 items-center">
          <i class="fa-solid fa-user"></i>
          Profile
        </a>
        <button wire:click="logout"
          class="w-full px-4 py-2 font-medium text-gray-800 hover:bg-gray-200 flex gap-x-3 items-center">
          <i class="fa-solid fa-right-from-bracket"></i>
          Logout
        </button>
      </div>
    </div>
  </div>
</nav>
