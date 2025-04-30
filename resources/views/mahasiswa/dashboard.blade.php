<x-layout>
  <div class="h-[1000px]">
    <x-slot:title>{{ $title }}</x-slot:title>

    <div x-data="{open: false}" class="p-4 bg-amber-300 text-center">

      <button @click="open = !open" x-text="open ? 'tutup' : 'buka'" x-bind:class="open ? 'bg-gray-600' : 'bg-cyan-600'" class="p-8 mb-4 bg-amber-900"></button>
      <div x-show="open" x-transition.origin.top.left.duration.500ms class="h-8 bg-amber-700">
        <h2>halo kawan apa kabar</h2>
      </div>

    </div>

  </div>
</x-layout>
