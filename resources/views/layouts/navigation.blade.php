<div class="bg-[#131417] shadow-md z-40 relative border-b-4 border-gray-500/20">
    <nav class="navbar flex justify-between container mx-auto">
        <div class="">
            <div href="{{ route('subscriptions.index') }}" class="text-xl flex items-center gap-5">
                <img src="{{ asset('images/logo.svg') }}" alt="{{ __('navbar.logo_alt') }}" class="w-8 h-auto" />
                <span class="text-xl font-bold text-white">{{ __('navbar.brand') }}</span>
                @if (Auth::check())
                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <span class="text-xs bg-yellow-300 font-bold text-black/70 px-2 py-1 rounded-full">{{ __('navbar.admin') }}</span>
                        <a href="{{ route('users.index') }}" class="text-xs btn">{{ __('navbar.dashboard') }}</a>
                    @elseif (Auth::check() && Auth::user()->hasRole('premium'))
                        <span class="text-xs bg-yellow-300 font-bold text-black/70 px-2 py-1 rounded-full">{{ __('navbar.premium') }}</span>
                    @elseif (Auth::check() && Auth::user()->hasRole('user'))
                        <a href="{{ route('subscriptions.index') }}" class="text-xl flex items-center gap-5">
                            <div class="bg-yellow-300 font-bold text-black/70 flex px-2 py-1 rounded-full ml-6 cursor-default">
                                <span class="text-xs cursor-default">{{ __('navbar.not_subscribed') }} <a class="underline ml-1 text-xs cursor-pointer" href="{{ route('subscriptions.index') }}">{{ __('navbar.click_here') }}<a></span>
                            </div>
                        </a>
                    @endif
                @endif
            </div>
        </div>
        <div class="flex items-center">
            @auth
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-accent m-1 text-white">{{ __('navbar.menu') }} <i class="fa-solid fa-bars"></i></div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-200 text-white rounded-box z-[1] w-52 p-2 shadow">
                        <li><a href="{{ route('profile.edit') }}" class="">{{ __('navbar.profile') }}</a></li>
                        <li><a href="{{ route('programs.index') }}" class="">{{ __('navbar.programs') }}</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="hover:underline">{{ __('navbar.logout') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <form action="{{ route('change.language') }}" method="POST" class="ml-4">
                    @csrf
                    <select name="language" onchange="this.form.submit()" class="h-12 bg-accent dark:bg-accent text-white dark:text-white rounded-md">
                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                        <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
                    </select>
                </form>
            @else
                <div class="space-x-3 bg-base-300/80 p-2 flex items-center">
                    <a href="{{ route('login') }}" class="hover:underline">{{ __('navbar.login') }}</a>
                    <span>|</span>
                    <a href="{{ route('register') }}" class="hover:underline">{{ __('navbar.signup') }}</a>
                    <form action="{{ route('change.language') }}" method="POST" class="ml-4">
                        @csrf
                        <select name="language" onchange="this.form.submit()" class="bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded">
                            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                            <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
                        </select>
                    </form>
                </div>
            @endauth
        </div>
    </nav>
</div>
