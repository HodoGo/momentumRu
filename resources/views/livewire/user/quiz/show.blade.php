<div>
  {{-- quiz code modal --}}
  @if ($show_quiz_code_modal)
    <div
      class="fixed inset-0 z-20 flex items-center justify-center bg-gray-900 bg-opacity-50"
      wire:click.self="closeQuizCodeModal"
    >
      <div class="w-10/12 rounded-lg bg-white p-6 md:w-1/3">
        <form action="" wire:submit="checkCode">
          <div class="mb-4 flex items-center justify-between">
            <h2 class="text-xl font-medium">Masukkan Kode Quiz</h2>
            <svg
              wire:click="closeQuizCodeModal"
              class="h-3 w-3 cursor-pointer"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 14 14"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
              />
            </svg>
          </div>
          <div class="mb-2 py-2">
            <input
              type="text"
              wire:model="quiz_code"
              class="block w-full rounded border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:outline-momentum1"
              placeholder="Kode Quiz"
            />
            <div class="px-1">
              @error("quiz_code")
                <livewire:components.input-error-message field="quiz_code" />
              @enderror
            </div>
          </div>
          <div class="mt-4 flex justify-between">
            <button
              type="button"
              wire:click="closeQuizCodeModal"
              class="rounded-md bg-red-700 px-3 py-1.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-red-300"
            >
              Tutup
            </button>
            <button
              type="submit"
              class="rounded-md bg-momentum1 px-3 py-1.5 text-center text-sm font-medium text-white hover:bg-momentum1 focus:outline-none focus:ring-momentum1"
            >
              Mulai
            </button>
          </div>
        </form>
      </div>
    </div>
  @endif

  {{-- Because she competes with no one, no one can compete with her. --}}
  <nav
    class="w-full rounded-md bg-gray-100 px-3 pb-3 pt-0 font-normal text-gray-500"
  >
    <ol class="list-reset flex">
      <li>
        <a wire:navigate href="{{ route("home") }}" class="text-gray-500">
          Home
        </a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a
          wire:navigate
          href="{{ route("quiz.index") }}"
          class="text-gray-500"
        >
          Quiz
        </a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a class="text-gray-500">{{ $quiz->name }}</a>
      </li>
    </ol>
  </nav>

  <div class="rounded-lg bg-white p-6 shadow-sm">
    <h1 class="font-bold text-momentum1">Detail Quiz</h1>
    <div class="mt-5 flex flex-wrap gap-x-10 gap-y-3 md:flex-nowrap">
      <div class="basis-full md:basis-7/12">
        <div
          class="h-48 w-full rounded-md bg-cover bg-center bg-no-repeat md:h-72"
          style="
            background-image: url('{{ asset("images/quizzes/quiz-2.webp") }}');
          "
        ></div>
        {{-- <p class="font-medium text-xl py-3">{{ $quiz->name }}</p> --}}
      </div>
      <div class="basis-full md:basis-5/12">
        <div class="flex flex-col gap-y-5">
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">Nama Quiz</div>
            <div class="basis-5/12 text-gray-500">
              {{ $quiz->name }}
            </div>
          </div>
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">Jenis Quiz</div>
            <div class="basis-5/12 text-gray-500">
              {{ $quiz->quiz_type->description }}
            </div>
          </div>
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Tanggal Mulai
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ date("d-m-Y H:i", strtotime($quiz->start_time)) }}
            </div>
          </div>
          <div class="flex">
            <div class="basis-6/12 font-medium text-gray-600">
              Tanggal Selesai
            </div>
            <div class="basis-5/12 text-gray-500">
              {{ date("d-m-Y H:i", strtotime($quiz->end_time)) }}
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
              {{ $has_work ? "Telah" : "Belum" }} Dikerjakan
            </div>
          </div>

          @if ($has_work)
            <a
              wire:navigate
              href="{{ route("quiz.history") }}"
              class="w-full rounded bg-momentum1 px-2 py-1 text-center font-medium text-white"
            >
              Lihat History Pengerjaan
            </a>
          @elseif ($has_end)
            <button
              class="w-full cursor-default rounded bg-momentum1 px-2 py-1 text-center font-medium text-white"
            >
              Quiz Telah Berakhir
            </button>
          @elseif ($has_begin == false)
            <button
              class="w-full cursor-default rounded bg-momentum1 px-2 py-1 text-center font-medium text-white"
            >
              Quiz Belum Dimulai
            </button>
          @else
            <button
              wire:click="openQuizCodeModal"
              class="w-full rounded bg-momentum1 px-2 py-1 text-center font-medium text-white"
            >
              Kerjakan Quiz
            </button>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
