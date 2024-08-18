<div>
  {{-- Success is as dangerous as failure. --}}
  <nav
    class="w-full rounded-md bg-gray-100 px-3 pb-3 pt-0 font-normal text-gray-500"
  >
    <ol class="list-reset flex">
      <li>
        <a
          wire:navigate
          href="{{ route("home") }}"
          class="text-nowrap text-gray-500"
        >
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
          class="text-nowrap text-gray-500"
        >
          Quiz
        </a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a
          wire:navigate
          href="{{ route("quiz.show", ["quiz" => $quiz->id]) }}"
          class="text-nowrap text-gray-500"
        >
          {{ $quiz->name }}
        </a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a class="text-nowrap text-gray-500">Kerjakan Quiz</a>
      </li>
    </ol>
  </nav>

  <div class="">
    <h1 class="px-3 font-bold text-momentum1">{{ $quiz->name }}</h1>
    <div
      class="mt-5 flex flex-wrap justify-between gap-x-5 gap-y-3 md:flex-nowrap"
    >
      @if (count($quiz->questions) > 0)
        <div class="basis-full rounded-lg bg-white p-6 shadow-sm md:basis-8/12">
          <h6 class="text-base font-medium">Nomor {{ $active_question }}</h6>
          @foreach ($quiz->questions as $index => $question)
            @if ($loop->iteration == $active_question)
              <div class="block">
                <div class="">
                  {!! $question->question !!}
                  <div class="clear-left block"></div>
                </div>
                @if ($quiz->quiz_type_id != 3)
                  <div class="my-2 box-border block w-full">
                    <form action="">
                      @foreach ($question->options as $option)
                        <div class="flex items-start gap-1 py-3">
                          <input
                            type="radio"
                            wire:model="selected_options.{{ $index }}"
                            wire:click="updateAnswer"
                            name="question{{ $question->id }}options"
                            value="{{ $option->id }}"
                            id="selected_options{{ $option->id }}"
                            class="mt-2"
                          />
                          <label
                            for="selected_options{{ $option->id }}"
                            class="flex"
                          >
                            <p class="me-2">
                              @if ($loop->iteration == 1)
                                A.
                              @elseif ($loop->iteration == 2)
                                B.
                              @elseif ($loop->iteration == 3)
                                C.
                              @elseif ($loop->iteration == 4)
                                D.
                              @elseif ($loop->iteration == 5)
                                E.
                              @endif
                            </p>
                            <div>
                              {!! $option->option !!}
                            </div>
                          </label>
                        </div>
                      @endforeach
                    </form>
                  </div>
                  <div class="clear-left block"></div>
                @endif
              </div>
            @endif
          @endforeach

          <div
            class="{{ $active_question > 1 ? "justify-between" : "justify-end" }} mt-10 flex w-full"
          >
            @if ($active_question > 1)
              <button
                wire:click="setActiveQuestion('previous')"
                class="rounded bg-momentum1 px-3 py-1 text-white"
              >
                <i class="fa-solid fa-arrow-left"></i>
                Sebelumnya
              </button>
            @endif

            @if ($active_question != $quiz->questions->count())
              <button
                wire:click="setActiveQuestion('next')"
                class="rounded bg-momentum1 px-3 py-1 text-white"
              >
                Selanjutnya
                <i class="fa-solid fa-arrow-right"></i>
              </button>
            @endif

            @if ($quiz->quiz_type_id != 3)
              @if ($active_question == $quiz->questions->count())
                @if ($all_answered == true)
                  <button
                    wire:click="submit_quiz"
                    class="rounded bg-momentum1 px-3 py-1 text-white"
                  >
                    Kumpulkan
                    <i class="fa-solid fa-arrow-right"></i>
                  </button>
                @elseif ($all_answered == false)
                  <span class="text-xs text-red-400">
                    Semua pertanyaan belum terjawab
                  </span>
                @endif
              @endif
            @endif
          </div>
        </div>
      @else
        <div class="basis-full rounded-lg bg-white p-6 shadow-sm md:basis-8/12">
          <div class="grid place-items-center">
            <img
              src="{{ asset("images/icons/out-of-stock.webp") }}"
              class="h-16"
              alt=""
              srcset=""
            />
            <p class="mt-2 font-medium text-gray-400">Soal belum tersedia</p>
          </div>
        </div>
      @endif
      <div class="basis-full md:basis-4/12">
        <div class="rounded-lg bg-white pb-5 shadow-sm">
          <h6 class="rounded-t-lg bg-gray-200 px-5 py-2 font-medium">
            Daftar Soal
          </h6>
          <div class="px-6 py-6">
            <div class="grid grid-cols-5 justify-between gap-2">
              @foreach ($quiz->questions as $index => $question)
                <button
                  wire:click="setActiveQuestion('set', {{ $loop->iteration }})"
                  class="{{ $loop->iteration == $active_question ? "bg-momentum1" : ($selected_options[$index] != null ? "bg-momentum2" : "bg-gray-500") }} rounded px-2 py-1 font-medium text-white"
                >
                  {{ $loop->iteration }}
                </button>
              @endforeach
            </div>
          </div>
          <livewire:user.components.time-remaining
            :quiz_end_time="$quiz->end_time"
            :start_time_work="$student_quiz->start_time"
            :duration="$quiz->duration"
          />
          <livewire:user.components.user-online-component
            :quiz="$quiz"
            :student_quiz_id="$student_quiz->id"
            :answered_count="$answered_count"
            :start_time_work="$student_quiz->start_time"
          />
          <div class="mt-2 flex gap-x-2 px-6">
            <div class="flex items-center gap-x-1">
              <div class="h-3 w-3 rounded bg-momentum1"></div>
              <p class="text-xs">Dilihat</p>
            </div>
            @if ($quiz->quiz_type_id != 3)
              <div class="flex items-center gap-x-1">
                <div class="h-3 w-3 rounded bg-momentum2"></div>
                <p class="text-xs">Terjawab</p>
              </div>
              <div class="flex items-center gap-x-1">
                <div class="h-3 w-3 rounded bg-gray-500"></div>
                <p class="text-xs">Belum Dijawab</p>
              </div>
            @endif
          </div>
          @if ($quiz->quiz_type_id == 3)
            <div class="mt-3 px-6">
              <form
                action=""
                wire:submit="submit_essay_quiz"
                enctype="multipart/form-data"
              >
                <label
                  class="mb-2 block text-sm font-medium text-gray-900"
                  for="file_input"
                >
                  Upload Jawaban Anda (pdf)
                </label>
                <input
                  type="file"
                  wire:model="essay_answer_file"
                  name="essay_answer_file"
                  class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none"
                  id=""
                  accept=".pdf"
                />
                @error("essay_answer_file")
                  <livewire:components.input-error-message
                    field="essay_answer_file"
                  />
                @enderror

                <button
                  type="submit"
                  class="mt-2 w-full rounded bg-momentum1 px-5 py-1 text-white"
                >
                  Kumpul dan Selesaikan
                </button>
              </form>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
