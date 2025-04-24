<x-layout>
    <a a wire:navigate class="ml-4" href="/posts/{{ $post->id }}"><img src="/icons/red_back_arrow.svg" alt=""
            srcset="" height="50" width="50"><sub>back to post</sub></a>
    <div class="container py-md-5 container--narrow">
        <livewire:editpost :post="$post" />
    </div>

</x-layout>
