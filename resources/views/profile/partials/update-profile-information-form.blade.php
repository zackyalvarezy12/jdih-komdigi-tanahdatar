<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-2xl border border-dashed border-gray-300 mb-6">
            <div class="relative flex-shrink-0">
                @if($user->avatar)
                    <img id="avatar-preview" src="{{ asset('storage/' . $user->avatar) }}" 
                        style="width: 100px; height: 100px; border-radius: 15px; object-fit: cover; border: 3px solid white; shadow: 0 4px 6px rgba(0,0,0,0.1);">
                @else
                    <img id="avatar-preview" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=10b981&color=fff" 
                        style="width: 100px; height: 100px; border-radius: 15px; object-fit: cover;">
                @endif
            </div>

            <div class="flex-1">
                <h4 style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 5px;">Foto Profil</h4>
                <input id="avatar" name="avatar" type="file" 
                    class="mt-1 block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" 
                    accept="image/*" onchange="previewImage(event)"/>
                <p class="mt-2 text-xs text-gray-400">Rekomendasi: Persegi (1:1), Maks 2MB.</p>
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('avatar-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</section>