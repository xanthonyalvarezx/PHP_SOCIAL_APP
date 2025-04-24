<x-layout>
    <div class="container py-md-5 container--narrow">
        <div>
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="d-flex align-content-center w-50">
                    <h2>
                        <img class="avatar-small" src="{{ $sharedData['profilePhoto'] }}" />
                        <strong>{{ $sharedData['user']->username }}</strong><br />
                    </h2>
                </div>
                <div>
                    @auth
                        @if (!$sharedData['currentlyFollowing'] and auth()->user()->id != $sharedData['user']->id)
                            <form class="ml-2 d-inline" action="/create/follow/{{ $sharedData['user']->username }}"
                                method="POST">
                                @csrf
                                <button class="btn btn-primary btn-sm h-10">Follow <i class="fas fa-user-plus"></i></button>
                            </form>
                        @else
                            <form class="ml-2 d-inline" action="/remove/follow/{{ $sharedData['user']->username }}"
                                method="POST">
                                @csrf
                                @if (auth()->user()->id != $sharedData['user']->id)
                                    <button class="btn btn-danger btn-sm h-10">Unfollow
                                        <i class="fas fa-user-plus"></i>
                                    </button>
                                @endif
                                @if (@auth()->user()->username == $sharedData['user']->username)
                                    <a class="btn btn-secondary btn-sm" href="/upload/photo">Change profile photo</a>
                                @endif
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
            <h5> {{ $sharedData['user']->email }}</h5>
        </div>
        <div class="profile-nav nav nav-tabs pt-2 mb-4">
            <a wire:navigate href="/profile/{{ auth()->user()->id }}"
                class="profile-nav-link nav-item nav-link {{ Request::segment(3) == '' ? 'active' : '' }}">Posts:
                {{ $sharedData['postCount'] }}</a>
            <a wire:navigate href="/profile/{{ auth()->user()->id }}/followers"
                class="profile-nav-link nav-item nav-link {{ Request::segment(3) == 'followers' ? 'active' : '' }}">Followers:
                {{ $sharedData['followers'] }}</a>
            <a wire:navigate href="/profile/{{ auth()->user()->id }}/following"
                class="profile-nav-link nav-item nav-link
                {{ Request::segment(3) == 'following' ? 'active' : '' }}">
                Following: {{ $sharedData['following'] }}</a>
        </div>
        <div class="profile-slot-content">
            {{ $slot }}
        </div>
    </div>

</x-layout>
