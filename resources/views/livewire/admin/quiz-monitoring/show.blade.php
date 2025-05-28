<div wire:poll.3s="check_expire">
  <div class="w-full rounded-lg bg-white p-6 shadow dark:bg-zinc-900">
    <div class="flex flex-col-reverse md:flex-row">
      <div class="basis-12/12 grid grid-cols-2 gap-y-2 md:basis-8/12">
        <p>Название</p>
        <p class="">: {{ $quiz->name }}</p>
        <p>Код</p>
        <p class="">: {{ $quiz->code }}</p>
        <p>Тип школы</p>
        <p class="">: {{ $quiz->school_category->name }}</p>
        <p>Тип теста</p>
        <p class="">: {{ $quiz->quiz_type->description }}</p>
        <p>Дата начала</p>
        <p class="">: {{ date('d M Y H:i', strtotime($quiz->start_time)) }}</p>
        <p>Дата окончания</p>
        <p class="">: {{ date('d M Y H:i', strtotime($quiz->end_time)) }}</p>
        <p>Продолжительность</p>
        <p class="">: {{ $quiz->duration }} Минут</p>
      </div>
      <div class="basis-12/12 mx-10 md:mx-0 md:basis-3/12">
        <img src="{{ asset('images/icons/quiz.webp') }}" alt="" srcset="" class="" />
      </div>
    </div>
  </div>

  <div class="relative mt-5 overflow-x-auto rounded-lg">
    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
      <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th class="px-6 py-3">No</th>
          <th class="px-6 py-3">Наименование</th>
          <th class="px-6 py-3">Школа</th>
          <th class="px-6 py-3">Статус</th>
          <th class="px-6 py-3">Оставшееся время</th>
          <th class="px-6 py-3">Отвечено</th>
          <th class="px-6 py-3">Статус выполнения</th>
        </tr>
      </thead>
      <tbody id="students-table-body">
        @foreach ($students as $student)
          <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
            <td class="whitespace-nowrap text-nowrap px-6 py-2 font-medium text-gray-900 dark:text-white">
              {{ $loop->iteration }}
            </td>
            <td class="whitespace-nowrap px-6 py-2 font-medium text-gray-900 dark:text-white">
              {{ $student['name'] }}
            </td>
            <td class="text-nowrap px-6 py-2">
              {{ $student['school_name'] }}
            </td>
            <td class="text-nowrap px-6 py-2">
              @if ($student['status'] == 'online')
                <span
                  class="me-2 rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                  Online
                </span>
              @else
                <span
                  class="me-2 rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                  Offline
                </span>
              @endif
            </td>
            <td class="px-6 py-2 font-medium">
              {{ $student['time_remaining'] }}
            </td>
            <td class="px-6 py-2 font-medium">
              {{ $student['answer_count'] }} / {{ $quiz->questions->count() }}
            </td>
            <td class="px-6 py-2 font-medium">
              @if ($student['is_done'])
                <span
                  class="me-2 rounded text-nowrap bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                  Выполнено
                </span>
              @elseif($student['is_done'] === 0)
                <span
                  class="me-2 rounded text-nowrap bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                  Выполняется
                </span>
              @elseif($student['is_done'] === null)
                <span
                  class="me-2 rounded text-nowrap bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                  Еще не сделано
                </span>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@assets
  <script src="{{ asset('build/assets/app-a671dfe1.js') }}"></script>
@endassets
