<aside id="sidebar"
  class="bg-white text-white w-64 space-y-6 p-6 absolute md:relative md:block hidden min-h-screen md:z-0 z-20">
  <nav class="space-y-4">
    <a wire:navigate href="{{ route('home') }}"
      class="block py-2.5 px-4 rounded transition duration-200 font-medium hover:text-white {{ Request::is('/') ? 'text-white bg-momentum1' : 'text-gray-500' }} hover:bg-momentum1 flex items-center gap-3">
      <i class="fa-solid fa-house"></i>
      <span class="">Home</span>
    </a>
    <a wire:navigate href="{{ route('quiz.index') }}"
      class="block py-2.5 px-4 rounded transition duration-200 font-medium hover:text-white {{ Request::is('quiz*') ? 'text-white bg-momentum1' : 'text-gray-500' }} hover:bg-momentum1 flex items-center gap-3">
      <i class="fa-solid fa-pen-to-square"></i>
      <span class="">Quiz</span>
    </a>
    <a wire:navigate href="{{ route('quiz.history') }}"
      class="block py-2.5 px-4 rounded transition duration-200 font-medium hover:text-white {{ Request::is('quiz/history*') ? 'text-white bg-momentum1' : 'text-gray-500' }} hover:bg-momentum1 flex items-center gap-3">
      <i class="fa-solid fa-clock-rotate-left"></i>
      <span class="">Quiz History</span>
    </a>
  </nav>
</aside>
