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
    </div>
  </div>
</div>
