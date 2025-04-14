<x-profile-layout :sharedData="$sharedData">
    <div class="list-group">
        @foreach ($posts as $post)
            <div class="card shadow-lg mb-3">
                <a href="/posts/{{ $post->id }}" class="list-group-item list-group-item-action">
                    <div> <img class="avatar-tiny" src="{{ $post->user->photo }}" />
                        <strong> {{ $post->title }}</strong>
                    </div>
                    <p>
                        {!! $post->body !!}
                    </p>
                    <sub>Posted on {{ $post->created_at->format('m/d/Y') }}</sub>
                </a>
            </div>
        @endforeach
    </div>
</x-profile-layout>
