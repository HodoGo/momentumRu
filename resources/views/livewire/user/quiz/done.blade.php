<div>
  <div class="min-h-full rounded-lg bg-white p-6 text-center shadow-sm">
    <h6 class="text-lg font-bold text-momentum1">Тест завершен</h6>
    <img
      src="{{ asset("images/icons/check.webp") }}"
      alt=""
      srcset=""
      class="mx-auto h-56 py-5"
    />
    <a
      wire:navigate
      href="{{ route("quiz.history") }}"
      class="rounded bg-momentum1 px-3 py-1 text-lg font-medium text-white"
    >
      Просмотр истории тестирования
    </a>
  </div>
</div>
