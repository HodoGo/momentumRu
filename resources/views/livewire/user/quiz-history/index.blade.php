<div>
  {{-- The best athlete wants his opponent at his best. --}}
  <nav class="bg-gray-100 px-3 pt-0 pb-3 rounded-md w-full text-gray-500 font-normal">
    <ol class="list-reset flex">
      <li>
        <a href="{{ route('home') }}" class="text-gray-500 text-nowrap">
          Home
        </a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a href="{{ route('quiz.index') }}" class="text-gray-500 text-nowrap">
          Quiz History
        </a>
      </li>
    </ol>
  </nav>

  <div class="bg-white shadow-sm rounded-lg pt-6 px-4">
    <h1 class="text-momentum1 font-bold">Quiz yang telah dikerjakan</h1>
    <div class="my-5">
      <livewire:user.components.quiz-history-modal />
      {{-- <div class="flex justify-between items-center md:gap-x-28 pb-6">
        <div class="md:grow flex gap-x-1 items-center">
          <img class="w-10 h-10 rounded-full bg-gray-300 md:hidden" />
          <div class="md:grow flex flex-col md:flex-row md:justify-between text-nowrap text-xs md:text-base font-medium">
            <p class="text-black">Quiz 1</p>
            <p class="text-gray-500 md:text-black">Pilihan Ganda</p>
          </div>
        </div>
        <div class="md:grow flex md:justify-between flex-col md:flex-row text-nowrap text-xs md:text-base font-medium text-end">
          <p class="text-black">12/12/24 10:20</p>
          <p class="text-gray-500 md:text-black">Nilai: 85/100</p>
        </div>
        <div class="hidden md:block">
          <button class="bg-momentum1 text-white px-3 rounded font-medium">Detail</button>
        </div>
      </div> --}}
    </div>
  </div>
</div>
