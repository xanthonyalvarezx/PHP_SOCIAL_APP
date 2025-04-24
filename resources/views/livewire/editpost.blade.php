<div>
    <form wire:submit="edit" class="card shadow-lg p-3" action="/update-post/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
            <input wire:model="title" value="{{ old('title', $post->title) }}" name="title" id="post-title"
                class="form-control form-control-lg form-control-title" type="text" placeholder=""
                autocomplete="off" />
            @error('title')
                <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
            <textarea wire:model="body" name="body" id="post-body" class="body-content tall-textarea form-control"
                type="text">{{ old('body', $post->body) }}</textarea>
            @error('body')
                <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
            @enderror
        </div>
        <button class="btn btn-primary">Save Changes</button>
    </form>
</div>
