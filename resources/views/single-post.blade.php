<x-layout>

    <div class="container py-md-5 container--narrow card mb-5 shadow-lg rounded-4xl">
        <div class="d-flex justify-content-between">
            <h2>{{ $post->title }}</h2>
            @can('update', $post)
                <span class="pt-2">
                    <a wire:navigate href="/edit-post/{{ $post->id }}" class="text-primary mr-2" data-toggle="tooltip"
                        data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                    <livewire:deletepost :post="$post" />
                </span>
            @endcan
        </div>

        <p class="text-muted small mb-4">
            <a wire:navigate href="/profile/{{ $post->user->id }}"><img class="avatar-tiny"
                    src="{{ $post->user->photo }}" /></a>
            Posted by <a wire:navigate href="/profile/{{ $post->user->id }}">{{ $post->user->username }}</a> on
            {{ $post->created_at->format('m/d/Y') }}
        </p>

        <div class="body-content">
            {!! $post->body !!}
        </div>
    </div>

</x-layout>
