<div>
  <div class="w-full rounded-lg bg-white p-6 shadow dark:bg-zinc-900">
    <div class="flex flex-col-reverse md:flex-row">
      <div class="basis-12/12 grid grid-cols-2 gap-y-2 md:basis-8/12">
        <p>Наименование</p>
        <p class="">: {{ $quiz->name }}</p>
        <p>Код</p>
        <p class="">: {{ $quiz->code }}</p>
        <p>Тип школы</p>
        <p class="">: {{ $quiz->school_category->name }}</p>
        <p>Тип теста</p>
        <p class="">: {{ $quiz->quiz_type->description }}</p>
        <p>Дата начала</p>
        <p class="">: {{ date("d M Y H:i", strtotime($quiz->start_time)) }}</p>
        <p>Дата окончания</p>
        <p class="">: {{ date("d M Y H:i", strtotime($quiz->end_time)) }}</p>
        <p>Продолжительность</p>
        <p class="">: {{ $quiz->duration }} Минут</p>
      </div>
      <div class="basis-12/12 mx-10 md:mx-0 md:basis-3/12">
        <img
          src="{{ asset("images/icons/quiz.webp") }}"
          alt=""
          srcset=""
          class=""
        />
      </div>
    </div>
  </div>
  <div class="mt-5">
    <div class="relative overflow-x-auto rounded-lg">
      <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
        <thead
          class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th class="px-6 py-3">Рейтинг</th>
            <th class="px-6 py-3">Название</th>
            <th class="px-6 py-3">Школа</th>
            <th class="px-6 py-3">Оценка</th>
            <th class="px-6 py-3">Подробнее</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($student_quizzes as $student_quiz)
            <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
              <td
                class="whitespace-nowrap text-nowrap px-6 py-2 font-medium text-gray-900 dark:text-white"
              >
                {{ $loop->iteration }}
              </td>
              <td
                class="whitespace-nowrap px-6 py-2 font-medium text-gray-900 dark:text-white"
              >
                {{ $student_quiz->student->name }}
              </td>
              <td class="text-nowrap px-6 py-2">
                {{ $student_quiz->student->school->name }}
              </td>
              <td class="text-nowrap px-6 py-2">{{ $student_quiz->score }}</td>
              <td class="text-nowrap px-6 py-2">
                <button
                  wire:click="openModal({{ $student_quiz->id }}, {{ $loop->iteration }})"
                  type="button"
                  class="rounded-md border border-gray-200 bg-white px-5 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                >
                  См.
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mt-3 flex justify-end">
      <a
        href="{{ route("admin.quiz.recap", ["quiz" => $quiz->id]) }}"
        target="_blank"
        class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-500 hover:bg-gray-100 focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-gray-600 dark:hover:bg-gray-700"
        type="button"
      >
        <svg
          class="h-[20px] w-[20px] text-gray-800 dark:text-white"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          fill="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            fill-rule="evenodd"
            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z"
            clip-rule="evenodd"
          />
        </svg>
        Печать в PDF
      </a>
    </div>
  </div>
  @if ($open_detail_modal)
    <div
      class="fixed left-0 right-0 top-0 z-50 grid h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
    >
      <div class="relative max-h-full w-full max-w-2xl p-4">
        <!-- Modal content -->
        <div
          class="relative rounded-lg bg-white shadow md:min-w-[40vw] dark:bg-gray-700"
        >
          <!-- Modal header -->
          <div
            class="flex items-center justify-between rounded-t border-b px-4 py-3 dark:border-gray-600"
          >
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              Подробности выполнения
            </h3>
            <button
              wire:click="closeModal"
              type="button"
              class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-hide="default-modal"
            >
              <svg
                class="h-3 w-3"
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
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="space-y-4 p-4 md:p-5">
            <div class="flex justify-between">
              <p>Рейтинг #{{ $activeRanking }}</p>
              <p>Значение: {{ $activeStudentQuiz->score }} / 100</p>
            </div>
            <div class="grid grid-cols-2">
              <p>Наименование</p>
              <p class="">: {{ $activeStudentQuiz->student->name }}</p>
              <p>Пользователь</p>
              <p class="">: {{ $activeStudentQuiz->student->username }}</p>
              <p>Школа</p>
              <p class="">: {{ $activeStudentQuiz->student->school->name }}</p>
              <p>Правильные ответы</p>
              <p class="text-nowrap">
                : {{ $correct_answer_count }} /
                {{ $activeStudentQuiz->quiz->questions->count() }}
              </p>
              <p>Неправильные ответы</p>
              <p class="text-nowrap">
                : {{ $wrong_answer_count }} /
                {{ $activeStudentQuiz->quiz->questions->count() }}
              </p>
              <p>Не отвечено</p>
              <p class="text-nowrap">
                : {{ $not_answer_count }} /
                {{ $activeStudentQuiz->quiz->questions->count() }}
              </p>
              <p>Время начала</p>
              <p class="text-nowrap">
                : {{ date("d M Y H:i", strtotime($activeStudentQuiz->start_time)) }}
              </p>
              <p>Время окончания</p>
              <p class="text-nowrap">
                : {{ date("d M Y H:i", strtotime($activeStudentQuiz->end_time)) }}
              </p>
              <p>Продолжительность работы</p>
              <p class="text-nowrap">: {{ $duration }}</p>
            </div>
            <form action="" wire:submit="setScore">
              <div class="flex items-center justify-between gap-x-3">
                <p class="text-nowrap">Оценить</p>
                <input
                  wire:model="score"
                  type="number"
                  min="0"
                  max="100"
                  id="first_name"
                  class="w-full rounded border border-gray-300 bg-gray-50 p-2 text-xs text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                  placeholder="Nilai 0-100"
                />
                <button
                  type="submit"
                  class="rounded bg-gray-800 px-5 py-1 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                >
                  Изменить
                </button>
              </div>
            </form>
            @if ($activeStudentQuiz->quiz->quiz_type_id == 3)
              <div class="">
                <a href="{{ asset("storage/" . $essay_file) }}" download>
                  Скачать PDF
                </a>
                <iframe
                  src="{{ asset("storage/" . $essay_file) }}"
                  width="100%"
                  height="600px"
                ></iframe>
              </div>
            @endif
          </div>
          <!-- Modal footer -->
          <div
            class="flex items-center justify-end border-t border-gray-200 px-4 py-3 md:px-5 dark:border-gray-600"
          >
            <button
              wire:click="closeModal"
              type="button"
              class="ms-3 rounded border border-gray-200 bg-white px-5 py-1 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
            >
              Закрыть
            </button>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
