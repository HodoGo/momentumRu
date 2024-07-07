<div>
  {{-- quiz code modal --}}
  @if ($show_quiz_code_modal)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-20"
      wire:click.self="closeQuizCodeModal">
      <div class="bg-white rounded-lg w-10/12 md:w-1/3 p-6">
        <form action="" wire:submit='checkCode'>
          <div class="mb-4 flex justify-between items-center">
            <h2 class="text-xl font-medium">Masukkan Kode Quiz</h2>
            <svg wire:click='closeQuizCodeModal' class="w-3 h-3 cursor-pointer" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
          </div>
          <div class="mb-2 py-2">
            <input type="text" wire:model='quiz_code'
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-momentum1 block w-full p-2.5"
              placeholder="Kode Quiz" />
            <div class="px-1">
              @error('quiz_code')
                <livewire:components.input-error-message field="quiz_code" />
              @enderror
            </div>
          </div>
          <div class="flex justify-between mt-4">
            <button type="button" wire:click='closeQuizCodeModal'
              class="px-3 py-1.5 text-sm font-medium text-center text-white bg-red-700 rounded-md hover:bg-red-800 focus:outline-none focus:ring-red-300">
              Tutup
            </button>
            <button type="submit"
              class="px-3 py-1.5 text-sm font-medium text-center text-white bg-momentum1 rounded-md hover:bg-momentum1 focus:outline-none focus:ring-momentum1">
              Mulai
            </button>
          </div>
        </form>
      </div>
    </div>
  @endif
  {{-- Because she competes with no one, no one can compete with her. --}}
  <nav class="bg-gray-100 px-3 pt-0 pb-3 rounded-md w-full text-gray-500 font-normal">
    <ol class="list-reset flex">
      <li>
        <a wire:navigate href="{{ route('home') }}" class="text-gray-500">Home</a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a wire:navigate href="{{ route('quiz.index') }}" class="text-gray-500">Quiz</a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a class="text-gray-500">{{ $quiz->name }}</a>
      </li>
    </ol>
  </nav>

  <div class="bg-white shadow-sm rounded-lg p-6">
    <h1 class="text-momentum1 font-bold">Detail Quiz</h1>
    <div class="flex flex-wrap md:flex-nowrap gap-x-10 gap-y-3 mt-5">
      <div class="basis-full md:basis-7/12">
        <div class="h-48 md:h-72 w-full bg-no-repeat bg-cover bg-center rounded-md"
          style="background-image: url('{{ asset('images/quizzes/quiz-2.webp') }}')">
        </div>
        {{-- <p class="font-medium text-xl py-3">{{ $quiz->name }}</p> --}}
      </div>
      <div class="basis-full md:basis-5/12">
        <div class="flex flex-col gap-y-5">
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Nama Quiz
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ $quiz->name }}
            </div>
          </div>
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Jenis Quiz
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ $quiz->quiz_type->description }}
            </div>
          </div>
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Tanggal Mulai
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ date('d-m-Y H:i', strtotime($quiz->start_time)) }}
            </div>
          </div>
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Tanggal Selesai
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ date('d-m-Y H:i', strtotime($quiz->end_time)) }}
            </div>
          </div>
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Durasi Pengerjaan
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ $quiz->duration }} Menit
            </div>
          </div>
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Status Pengerjaan
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ $has_work ? 'Telah' : 'Belum' }} Dikerjakan
            </div>
          </div>
          @if ($has_work)
            <a wire:navigate href="{{ route('quiz.history') }}"
              class="bg-momentum1 text-white font-medium px-2 py-1 rounded w-full w-8/12 text-center">
              Lihat History Pengerjaan
            </a>
          @elseif($has_end)
            <button
              class="cursor-default bg-momentum1 text-white font-medium px-2 py-1 rounded w-full w-8/12 text-center">
              Quiz Telah Berakhir
            </button>
          @elseif ($has_begin == false)
            <button
              class="cursor-default bg-momentum1 text-white font-medium px-2 py-1 rounded w-full w-8/12 text-center">
              Quiz Belum Dimulai
            </button>
          @else
            <button wire:click='openQuizCodeModal'
              class="bg-momentum1 text-white font-medium px-2 py-1 rounded w-full w-8/12 text-center">
              Kerjakan Quiz
            </button>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
