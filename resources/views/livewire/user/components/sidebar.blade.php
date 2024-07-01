<aside id="sidebar" class="bg-white text-white w-64 space-y-6 p-6 hidden md:block fixed top-14 bottom-0 z-10">
  <nav class="h-full flex flex-col justify-between space-y-4">
    <div class="flex flex-col gap-y-2">
      <a wire:navigate href="{{ route('home') }}"
        class="block py-2.5 px-4 rounded transition duration-200 font-medium hover:text-white {{ Request::is('/') ? 'text-white bg-momentum1' : 'text-gray-500' }} hover:bg-momentum1 flex items-center gap-3">
        <i class="fa-solid fa-house"></i>
        <span class="">Home</span>
      </a>
      <a wire:navigate href="{{ route('quiz.index') }}"
        class="block py-2.5 px-4 rounded transition duration-200 font-medium hover:text-white {{ Request::is('quiz*') && !Request::is('quiz/history') ? 'text-white bg-momentum1' : 'text-gray-500' }} hover:bg-momentum1 flex items-center gap-3">
        <i class="fa-solid fa-pen-to-square"></i>
        <span class="">Quiz</span>
      </a>
      <a wire:navigate href="{{ route('quiz.history') }}"
        class="block py-2.5 px-4 rounded transition duration-200 font-medium hover:text-white {{ Request::is('quiz/history*') ? 'text-white bg-momentum1' : 'text-gray-500' }} hover:bg-momentum1 flex items-center gap-3">
        <i class="fa-solid fa-clock-rotate-left"></i>
        <span class="">Quiz History</span>
      </a>
    </div>
    <div class="flex flex-col gap-y-4">
      <div class="bg-momentum1 rounded-xl px-4 pt-6 pb-4 text-white text-center">
        <img id="" src="{{ asset('images/man.png') }}" alt="User Avatar"
          class="w-16 h-16 rounded-full bg-white mx-auto mb-3">
        <p class="font-medium">{{ Auth::guard('student')->user()->name }}</p>
        <p class="text-sm">{{ Auth::guard('student')->user()->username}}</p>
        <a wire:navigate href="{{ route('profile') }}" type="button" class="px-3 px-2 py-0.5 text-xs font-medium text-center text-momentum1 bg-white rounded">Profile</a>
      </div>
      <button wire:click='logout'
        class="block w-full py-2.5 px-4 rounded transition duration-200 font-medium hover:text-white text-gray-500 hover:bg-momentum1 flex items-center gap-3">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span class="">Logout</span>
      </button>
    </div>
  </nav>
</aside>
