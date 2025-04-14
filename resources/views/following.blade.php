<x-profile-layout :sharedData="$sharedData">
    <div class="list-group">
        @foreach ($following as $follow)
            <div class="card shadow-lg mb-3">
                <a href="/profile/{{ $follow->userFollowed->id }}" class="list-group-item list-group-item-action">
                    <div> <img class="avatar-tiny" src="{{ $follow->userFollowed->photo }}" />
                        {{ $follow->userFollowed->username }}
                    </div>
                </a>
            </div>
        @endforeach
    </div>

</x-profile-layout>
