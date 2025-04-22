<div x-data="{ isOpen: false }">
    <a x-on:click="isOpen = true; setTimeout(()=>document.querySelector('#live-search-field').focus(),50)"
        class="bg-transparent border-none outline-none p-0 m-0 text-white mr-2 header-search-icon cursor-pointer"
        title="Search" data-toggle="tooltip" data-placement="bottom">
        <i class="fas fa-search"></i>
    </a>

    <div class="search-overlay" x-bind:class="isOpen ? 'search-overlay--visible' : ''">
        <div class="search-overlay-top shadow-sm">
            <div class="container container--narrow">
                <label for="live-search-field" class="search-overlay-icon"><i class="fas fa-search"></i></label>
                <input
                    x-on:keydown="document.querySelector('.circle-loader').classList.add('circle-loader--visible'); 
                    if(document.querySelector('#no-results')){document.querySelector('#no-results').style.display = 'none'};"
                    wire:model.live="search" autocomplete="off" type="text" id="live-search-field"
                    class="live-search-field" placeholder="What are you interested in?">
                <span x-on:click="isOpen = false;" class="close-live-search"><i class="fas fa-times-circle"></i></span>
            </div>
        </div>

        <div class="search-overlay-bottom">
            <div class="container container--narrow py-3">
                <div class="circle-loader"></div>
                <div class="live-search-results live-search-results--visible">
                    <div class="list-group shadow-sm">
                        @if (count($results) == 0 && $search != '')
                            <p id="no-results" class="alert alert-secondary text-center shadow-sm">Sorry no results
                                found!</p>
                        @endif
                        @if (count($results) > 0)
                            <div class="list-group-item active"><strong>Search Results</strong>
                                ({{ count($results) }} {{ count($results) > 1 ? 'results' : 'result' }} found )
                            </div>
                        @endif
                        @foreach ($results as $post)
                            <a href="/posts/{{ $post->id }}" class="list-group-item list-group-item-action">
                                <img class="avatar-tiny" src="{{ $post->user->photo }}">
                                <strong>{{ $post->title }}</strong>
                                <span class="text-muted small">by {{ $post->user->username }} on
                                    {{ $post->created_at->format('n/j/Y') }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
