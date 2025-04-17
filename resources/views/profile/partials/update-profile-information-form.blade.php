<section class="mb-8">
    <div class="card pb-6">
        <div class="card-header" id="basic_settings">
            <h3 class="card-title">
                {{ __('Basic Settings') }}
            </h3>
        </div>

        <form method="POST" action="{{ route('profile.updateProfile') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="card-body grid gap-5">
                <!-- Photo -->
                <div class="flex items-center flex-wrap gap-2.5">
                    <label class="form-label max-w-56">
                        {{ __('Photo') }}
                    </label>
                    <div class="flex items-center justify-between flex-wrap grow gap-2.5">
                        <span class="text-2sm text-gray-700">150x150px JPEG, PNG Image</span>
                        <div class="image-input size-16" data-image-input="true" onclick="document.getElementById('avatarInput').click()">
                            <input id="avatarInput" type="file" name="avatar" accept="image/*" onchange="previewImage(event)" style="display: none;">
                            <div class="image-input-placeholder rounded-full border-2 border-success image-input-empty:border-gray-300">
                                <div class="image-input-preview rounded-full"
                                     style="background-image:url('{{ asset(auth()->user()->avatar ?? 'metronic/media/avatars/blank.png') }}')">
                                </div>
                            </div>
                            <div class="btn btn-icon btn-icon-xs btn-icon-light shadow-default absolute z-1 size-5 -top-0.5 -end-0.5 rounded-full"
                                 onclick="resetImage(event)">
                                <i class="ki-filled ki-cross"></i>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Last Name -->
                <div class="w-full">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label flex items-center gap-1 max-w-56">
                            {{ __('Last Name') }}
                        </label>
                        <x-forms.input name="last_name" type="text" :value="old('last_name', auth()->user()->last_name)" required autofocus class="w-full" :messages="$errors->get('last_name')" />
                    </div>
                </div>

                <!-- First Name -->
                <div class="w-full">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label flex items-center gap-1 max-w-56">
                            {{ __('First Name') }}
                        </label>
                        <x-forms.input name="first_name" type="text" :value="old('first_name', auth()->user()->first_name)" required autofocus class="w-full" :messages="$errors->get('first_name')" />
                    </div>
                </div>

                <!-- Phone -->
                <div class="w-full">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label flex items-center gap-1 max-w-56">
                            {{ __('Phone Number') }}
                        </label>
                        <x-forms.input name="phone" type="text" :value="old('phone', auth()->user()->phone)" class="w-full" :messages="$errors->get('phone')" />
                    </div>
                </div>

                <!-- Save -->
                <div class="flex justify-end pt-2.5">
                    <x-forms.primary-button>{{ __('Save Changes') }}</x-forms.primary-button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = input.closest('.image-input').querySelector('.image-input-preview');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.style.backgroundImage = 'url(' + e.target.result + ')';
            };
            reader.readAsDataURL(file);
        }
    }

    function resetImage(event) {
        event.stopPropagation(); // pour éviter d’ouvrir le file picker
        const imageInput = document.getElementById('avatarInput');
        imageInput.value = ''; // reset le champ
        const preview = document.querySelector('.image-input-preview');
        preview.style.backgroundImage = 'url("{{ asset(auth()->user()->avatar ?? 'metronic/media/avatars/blank.png') }}")';
    }
</script>
