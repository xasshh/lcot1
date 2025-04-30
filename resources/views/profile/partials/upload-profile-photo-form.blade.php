<section>
<form method="POST" action="{{ route('profile.uploadPhoto') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="profile_photo">Upload Profile Photo</label>
        <input type="file" name="profile_photo" class="form-control" required>
        @error('profile_photo')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Upload  </x-primary-button>
      
    </div>
</form>
</section>