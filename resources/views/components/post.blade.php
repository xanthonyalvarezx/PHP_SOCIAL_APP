    <a wire:navigate href="/posts/{{ $post->id }}" class="list-group-item list-group-item-action">
        <div>
            <img class="avatar-tiny" src="{{ $post->user->photo }}" />
            <strong>
                {{ $post->title }}
            </strong>
        </div>
        <sub>
            Posted on {{ $post->created_at->format('m/d/Y') }}
            @if (!isset($hideAuthor))
                by {{ $post->user->username }}
            @endif
        </sub>
    </a>
