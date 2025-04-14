<x-profile-layout :sharedData="$sharedData">
    <div class="list-group">
        @foreach ($followers as $follow)
            <div class="card shadow-lg mb-3">
                <a href="/profile/{{ $follow->userFollowing->id }}" class="list-group-item list-group-item-action">
                    <div> <img class="avatar-tiny" src="{{ $follow->userFollowing->photo }}" />
                        {{ $follow->userFollowing->username }}
                    </div>
                </a>
            </div>
        @endforeach
    </div>

</x-profile-layout>
