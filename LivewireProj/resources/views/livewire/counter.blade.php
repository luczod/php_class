 <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white">
   {{-- <h1 class="text-lg ml-4">{{ $count }}</h1> --}}
    <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" />
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
      <div class="flex gap-4 m-4">
          <img src="/img/laravel-2.svg" class="size-44"  alt="Laravel logo" />
          <img src="/img/tailwindcss.svg" class="size-44" alt="tailwind logo" />
          <img src="/img/livewire-2.svg" class="size-44" alt="Livewire logo" />
      </div>
      <h1>{{$count}}</h1>
      <div class="my-4 flex gap-4">
          <button id="counter" type="button" class="text-xl" wire:click="decrement">minus</button>
          <button id="counter" type="button" class="text-xl" wire:click="increment">plus</button>
      </div>
      <h2 class="text-2xl">Hello Livewire! count is {{$count}}</h2>
    </div>
</div>
