<section class="mb-8">
    <div class="card pb-6">
        <div class="card-header" id="auth_email">
            <h3 class="card-title">
                {{ __('Email') }}
            </h3>
        </div>

        <!-- Vérification -->
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="POST" action="{{ route('profile.email.update') }}">
            @csrf
            @method('patch')

            <div class="card-body grid gap-5">
                <!-- Email Input -->
                <x-forms.input
                    label="{{ __('Email') }}"
                    name="email"
                    type="email"
                    :value="old('email', auth()->user()->email)"
                    required
                    :messages="$errors->get('email')"
                />

                <!-- Email non vérifié -->
                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                    <div class="text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif

                <!-- Save -->
                <div class="flex justify-end pt-2.5">
                    <x-forms.primary-button>{{ __('Save Changes') }}</x-forms.primary-button>
                </div>
            </div>
        </form>
    </div>
</section>
