<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('user.store') }}" dir="rtl">
            @csrf

            <div>
                <x-jet-label for="user_name" value="{{ __('site.user_name') }}" />
                <x-jet-input id="user_name" class="block my-2 w-full" type="text" name="user_name" :value="old('user_name')"
                    autofocus autocomplete="user_name" />
            </div>
            
            <div class="mt-4">
                <x-jet-label for="department_id" value="{{ __('site.department') }}" />
                <select id="department_id" class="mt-1 @error('title') is-invalid @enderror" name="department_id" :value="old('department_id')"  autofocus style="display: block; width: 100%; height: calc(1.5em + 0.75rem + 2px); padding: 0.375rem 2rem; font-size: 1rem; font-weight: 400; line-height: 1.5; color: #6e707e; background-color: #fff; background-clip: padding-box; border: 1px solid #d1d3e2; border-radius: 0.35rem; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;">
                    <option class="mr-3">اختر القسم</option>
                    @include('lists.departments')
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('اسم المادة') }}" />
                <x-jet-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')"
                    autofocus autocomplete="name" />
            </div>

            <!-- level -->
            <div class="mt-4">
                <x-jet-input type="number" id="level" name="level" class="mt-1 block w-full" value="0"
                    style="display: none;" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('site.email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('site.password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password"
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('site.password_confirmation') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" autocomplete="new-password" />
            </div>

            <!-- administration level -->
            <div class="mt-4">
                <x-jet-input type="number" id="administration_level" name="administration_level"
                    class="mt-1 block w-full" value="1" style="display: none;" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('site.already_registered') }}
                </a>

                <x-jet-button class="mr-4" style="margin-right: 10px;">
                    {{ __('Site.register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
