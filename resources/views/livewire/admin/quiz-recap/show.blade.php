<div>
  {{-- Success is as dangerous as failure. --}}
  {{ $this->productInfolist }}
  <div class="mt-5">
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
  </div>
  @if ($open_detail_modal)
    <div
      class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full grid items-center">
      <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 md:min-w-[40vw]">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
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
              <p class="text-nowrap">: {{ $activeStudentQuiz->student->name }}</p>
              <p>Username</p>
              <p class="text-nowrap">: {{ $activeStudentQuiz->student->username }}</p>
              <p>Sekolah</p>
              <p class="text-nowrap">: {{ $activeStudentQuiz->student->school->name }}</p>
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
          </div>
          <!-- Modal footer -->
          <div
            class="flex items-center justify-end p-4 py-3 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button wire:click='closeModal' type="button"
              class="py-1 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
              Tutup
            </button>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
