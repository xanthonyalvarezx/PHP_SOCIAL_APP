<x-layout>
    <div class="container py-5 my-5">
        <form action="/upload/photo" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="profilePhoto" id="profilePhoto" required>
                @error('profilePhoto')
                    <p class="alert alert-danger small shadow-sm">{{ $message }}</p>
                @enderror
                <button class="btn btn-primary" type="submit">Upload</button>
            </div>
        </form>
    </div>
</x-layout>
