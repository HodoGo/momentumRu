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
        <h6 class="font-medium text-base">Nomor 1</h6>
        <div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, libero fugit! Molestias, aut facilis
          inventore nesciunt unde mollitia porro, repudiandae ut repellat deleniti accusantium, culpa aperiam eius esse
          blanditiis ex!
        </div>
        <div class="my-2">
          <form action="">
            <div class="flex items-start gap-1 py-3">
              <input type="radio" name="" id="" class="mt-2">
              <label for="" class="flex">
                <p class="me-2">
                  A.
                </p>
                <div>
                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam sapiente repellendus assumenda ea quis
                  veniam at earum consectetur? Saepe, facilis.
                </div>
              </label>
            </div>
          </form>
        </div>
        <div class="flex justify-between mt-20">
          <button class="px-3 py-1 rounded bg-momentum1 text-white">
            <i class="fa-solid fa-arrow-left"></i>
            Sebelumnya
          </button>
          <button class="px-3 py-1 rounded bg-momentum1 text-white">
            Selanjutnya
            <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </div>
      <div class="basis-full md:basis-4/12 bg-white shadow-sm rounded-lg">
        <h6 class="px-5 py-2 bg-gray-200 rounded-t-lg font-medium">Daftar Soal</h6>
        <div class="px-6 py-6">
          <div class="grid gap-2 grid-cols-5 justify-between">
            <button class="bg-momentum1 px-2 py-1 text-white font-medium rounded">1</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">2</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">3</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">4</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">5</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">6</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">7</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">8</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">9</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">10</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">11</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">12</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">13</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">14</button>
            <button class="bg-momentum2 px-2 py-1 text-white font-medium rounded">15</button>
          </div>
        </div>
        <div class="px-6 text-sm flex gap-2">
          <p class="text-gray-500">Waktu Tersisa:</p>
          <p class="font-medium">10:00</p>
        </div>
      </div>
    </div>
  </div>
</div>
