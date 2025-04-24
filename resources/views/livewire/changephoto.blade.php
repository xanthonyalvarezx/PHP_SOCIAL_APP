<div>
    <form livewire:submit="uploadphoto" action="/upload/photo" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input wire:model="photo" type="file" name="profilePhoto" id="profilePhoto" required>
            @error('profilePhoto')
                <p class="alert alert-danger small shadow-sm">{{ $message }}</p>
            @enderror
            <button class="btn btn-primary" type="submit">Upload</button>
        </div>
    </form>
</div>
