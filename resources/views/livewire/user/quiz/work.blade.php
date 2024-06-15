<div>
  {{-- Success is as dangerous as failure. --}}
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
          Quiz
        </a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a href="{{ route('quiz.show', ['quiz' => $quiz->id]) }}" class="text-gray-500 text-nowrap">
          {{ $quiz->name }}
        </a>
      </li>
      <li>
        <span class="mx-2">/</span>
      </li>
      <li>
        <a class="text-gray-500 text-nowrap">
          Kerjakan Quiz
        </a>
      </li>
    </ol>
  </nav>

  <div class="">
    <h1 class="text-momentum1 font-bold px-3">{{ $quiz->name }}</h1>
    <div class="flex flex-wrap md:flex-nowrap justify-between gap-x-5 gap-y-3 mt-5">
      <div class="basis-full md:basis-8/12 bg-white shadow-sm rounded-lg p-6">
        <h6 class="font-medium text-base">Nomor {{ $active_question }}</h6>
        {{-- @foreach ($quiz->questions as $question)
          @if ($loop->iteration == $active_question)
            <div>
              <div>
                {{ $question->question }}
              </div>
              <div class="my-2">
                <form action="">
                  @foreach ($question->options as $option)
                    <div class="flex items-start gap-1 py-3">
                      <input type="radio" name="" id="" class="mt-2">
                      <label for="" class="flex">
                        <p class="me-2">
                          @if ($loop->iteration == 1)
                            A
                          @elseif($loop->iteration == 2)
                            B
                          @elseif($loop->iteration == 3)
                            C
                          @elseif($loop->iteration == 4)
                            D
                          @endif
                          .
                        </p>
                        <div>
                          {{ $option->option }}
                        </div>
                      </label>
                    </div>
                  @endforeach
                </form>
              </div>
            </div>
          @endif
        @endforeach --}}
        <div>
          <div>
            {{ $show_question->question }}
          </div>
          <div class="my-2">
            {{-- <form action=""> --}}
            @foreach ($show_question->options as $option)
              <div class="flex items-start gap-1 py-3">
                <input type="radio" wire:model="selected_options.{{ $active_question - 1 }}"
                  name="question{{ $show_question->id }}options" value="{{ $option->id }}"
                  id="selected_options{{ $option->id }}" class="mt-2">
                <label for="selected_options{{ $option->id }}" class="flex">
                  <p class="me-2">
                    @if ($loop->iteration == 1)
                      A
                    @elseif($loop->iteration == 2)
                      B
                    @elseif($loop->iteration == 3)
                      C
                    @elseif($loop->iteration == 4)
                      D
                    @endif
                    .
                  </p>
                  <div>
                    {{ $option->option }}
                  </div>
                </label>
              </div>
            @endforeach
            {{-- </form> --}}
          </div>
        </div>
        <div class="flex {{ $active_question > 1 ? 'justify-between' : 'justify-end' }} mt-20">
          @if ($active_question > 1)
            <button wire:click="previousQuestion" class="px-3 py-1 rounded bg-momentum1 text-white">
              <i class="fa-solid fa-arrow-left"></i>
              Sebelumnya
            </button>
          @endif
          @if ($active_question != $quiz->questions->count())
            <button wire:click="nextQuestion" class="px-3 py-1 rounded bg-momentum1 text-white">
              Selanjutnya
              <i class="fa-solid fa-arrow-right"></i>
            </button>
          @endif
        </div>
      </div>
      <div class="basis-full md:basis-4/12">
        <div class="bg-white shadow-sm rounded-lg pb-5">
          <h6 class="px-5 py-2 bg-gray-200 rounded-t-lg font-medium">Daftar Soal</h6>
          <div class="px-6 py-6">
            <div class="grid gap-2 grid-cols-5 justify-between">
              @foreach ($quiz->questions as $index => $question)
                <button wire:click="setQuestion({{ $loop->iteration }})"
                  class="{{ $loop->iteration == $active_question ? 'bg-momentum1' : ($selected_options[$index] != null ? 'bg-momentum2' : 'bg-gray-500') }} px-2 py-1 text-white font-medium rounded">
                  {{ $loop->iteration }}
                </button>
              @endforeach
            </div>
          </div>
          <livewire:user.components.time-remaining :end_time="$quiz->end_time" />
          <div class="px-6 mt-2 flex gap-x-2">
            <div class="flex gap-x-1 items-center">
              <div class="h-3 w-3 bg-momentum1 rounded">
              </div>
              <p class="text-xs">Dilihat</p>
            </div>
            <div class="flex gap-x-1 items-center">
              <div class="h-3 w-3 bg-momentum2 rounded">
              </div>
              <p class="text-xs">Terjawab</p>
            </div>
            <div class="flex gap-x-1 items-center">
              <div class="h-3 w-3 bg-gray-500 rounded">
              </div>
              <p class="text-xs">Belum Dijawab</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
