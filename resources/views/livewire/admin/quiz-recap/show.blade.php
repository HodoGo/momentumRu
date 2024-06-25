<div>
  {{-- Success is as dangerous as failure. --}}
  {{ $this->productInfolist }}
  <div class="mt-5">
    {{-- <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
      <label for="table-search" class="sr-only">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
              clip-rule="evenodd"></path>
          </svg>
        </div>
        <input type="text" id="table-search"
          class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Search for items">
      </div>
      <div class="flex gap-x-3">
        <div class="relative inline-block text-left" x-data="{ openDropdown: @entangle('openDropdown') }" @click.away="openDropdown = false">
          <button id="dropdownRadioButton" wire:click='handleClickOpenFilter'
            class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600"
            type="button">
            <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-3" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
            </svg>
            {{ $selectedSchoolFilter }}
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
            </svg>
          </button>
          @if ($openDropdown)
            <div id="dropdownRadio"
              class="z-10 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600 absolute mt-2">
              <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioButton">
                @foreach ($schools as $school)
                  <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
                      wire:click="selectOption('{{ $school->id }}')">
                      <input type="radio" value="{{ $school->id }}" name="filter-radio"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        @if ($selectedSchoolFilter === $school->id) checked @endif readonly />
                      <label for="filter-radio-{{ $school->id }}"
                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                        {{ $school->name }}
                      </label>
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
      </div>
    </div> --}}
    <div class="relative overflow-x-auto rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th class="px-6 py-3">Ranking</th>
            <th class="px-6 py-3">Nama</th>
            <th class="px-6 py-3">Sekolah</th>
            <th class="px-6 py-3">Nilai</th>
            <th class="px-6 py-3">Detail</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($student_quizzes as $student_quiz)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <td class="px-6 py-2 text-nowrap font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $loop->iteration }}
              </td>
              <td class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $student_quiz->student->name }}
              </td>
              <td class="px-6 py-2 text-nowrap">{{ $student_quiz->student->school->name }}</td>
              <td class="px-6 py-2 text-nowrap">{{ $student_quiz->score }}</td>
              <td class="px-6 py-2 text-nowrap">
                <button wire:click="openModal({{ $student_quiz->id }}, {{ $loop->iteration }})" type="button"
                  class="py-1 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                  Lihat
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="flex justify-end mt-3">
      <a href={{ route('admin.quiz.recap', ['quiz' => $quiz->id]) }}
        target="_blank"
        class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600"
        type="button">
        <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd"
            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z"
            clip-rule="evenodd" />
        </svg>
        Print To PDF
      </a>

    </div>
  </div>
  @if ($open_detail_modal)
    <div
      class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full grid items-center">
      <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 md:min-w-[40vw]">
          <!-- Modal header -->
          <div class="flex items-center justify-between px-4 py-3 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              Detail Pengerjaan
            </h3>
            <button wire:click='closeModal' type="button"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-hide="default-modal">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5 space-y-4">
            <div class="flex justify-between">
              <p>Peringkat #{{ $activeRanking }}</p>
              <p>Nilai: {{ $activeStudentQuiz->score }} / 100</p>
            </div>
            <div class="grid grid-cols-2">
              <p>Nama</p>
              <p class="">: {{ $activeStudentQuiz->student->name }}</p>
              <p>Username</p>
              <p class="">: {{ $activeStudentQuiz->student->username }}</p>
              <p>Sekolah</p>
              <p class="">: {{ $activeStudentQuiz->student->school->name }}</p>
              <p>Jawaban Benar</p>
              <p class="text-nowrap">
                : {{ $correct_answer_count }} / {{ $activeStudentQuiz->quiz->questions->count() }}</p>
              <p>Jawaban Salah</p>
              <p class="text-nowrap">
                : {{ $wrong_answer_count }} / {{ $activeStudentQuiz->quiz->questions->count() }}
              </p>
              <p>Tidak Dijawab</p>
              <p class="text-nowrap">
                : {{ $not_answer_count }} / {{ $activeStudentQuiz->quiz->questions->count() }}
              </p>
              <p>Waktu Mulai</p>
              <p class="text-nowrap">: {{ $activeStudentQuiz->start_time }}</p>
              <p>Waktu Selesai</p>
              <p class="text-nowrap">: {{ $activeStudentQuiz->end_time }}</p>
              <p>Durasi Pengerjaan</p>
              <p class="text-nowrap">: {{ $activeStudentQuiz->duration }}</p>
            </div>
            <form action="" wire:submit='setScore'>
              <div class="flex justify-between items-center gap-x-3">
                <p class="text-nowrap">Berikan Nilai</p>
                <input wire:model='score' type="number" min="0" max="100" id="first_name"
                  class="p-2 w-full text-gray-900 border border-gray-300 rounded bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Nilai 0-100" />
                <button type="submit"
                  class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded text-sm px-5 py-1 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                  Ubah
                </button>
              </div>
            </form>
            @if ($activeStudentQuiz->quiz->quiz_type_id == 3)
              <div class="">
                <a href="{{ asset('storage/' . $essay_file) }}" download>Download
                  PDF</a>
                <iframe src="{{ asset('storage/' . $essay_file) }}" width="100%" height="600px"></iframe>
              </div>
            @endif
          </div>
          <!-- Modal footer -->
          <div class="flex items-center justify-end px-4 py-3 md:px-5 border-t border-gray-200 dark:border-gray-600">
            <button wire:click='closeModal' type="button"
              class="py-1 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
              Tutup
            </button>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
