<div class="bg-[#131417] shadow-md z-40 relative border-b-4 border-gray-500/20">
    <nav class="navbar flex justify-between container mx-auto">
        <div class="">
            <div href="{{ route('subscriptions.index') }}" class="text-xl flex items-center gap-5">
                <a href="{{ route('programs.index') }}" class="text-xl flex items-center gap-5">
                    <img src="{{ asset('images/logo.svg') }}" alt="Gymbro" class="w-8 h-auto"/>
                    <span class="ml-4 text-xl font-bold text-white">GYMBRO</span>
                </a>
                @if (Auth::check())
                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <span class="text-xs bg-yellow-300 font-bold text-black/70 px-2 py-1 rounded-full">Admin</span>
                        <a href="{{ route('users.index') }}" class="text-xs btn">Tableau de bord</a>
                    @elseif (Auth::check() && Auth::user()->hasRole('premium'))
                        <span
                                class="text-xs bg-yellow-300 font-bold text-black/70 px-2 py-1 rounded-full">Premium</span>
                    @elseif (Auth::check() && Auth::user()->hasRole('user'))
                        <a href="{{ route('subscriptions.index') }}" class="text-xl flex items-center gap-5">
                            <div
                                    class="bg-yellow-300 font-bold text-black/70 flex px-2 py-1 rounded-full ml-6 cursor-default">
                                <span class="text-xs cursor-default">Pas encore abonné ? Cliquez <a
                                            class="underline ml-1 text-xs cursor-pointer"
                                            href="{{ route('subscriptions.index') }}">ici</a></span>
                            </div>
                        </a>
                    @endif
                @endif
            </div>
        </div>
        <div class="">
            @auth
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-accent m-1 text-white">Menu <i
                                class="fa-solid fa-bars"></i></div>
                    <ul tabindex="0"
                        class="dropdown-content menu bg-base-200 text-white rounded-box z-[1] w-52 p-2 shadow">
                        <li><a href="{{ route('profile.edit') }}" class="">Profil</a></li>
                        <li><a href="{{ route('programs.index') }}" class="">Programmes</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="hover:underline">Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="space-x-3 bg-base-300/80 p-2">
                    <a href="{{ route('login') }}" class="hover:underline">Connexion</a>
                    <span>|</span>
                    <a href="{{ route('register') }}" class="hover:underline">Inscription</a>
                </div>
            @endauth
        </div>
    </nav>
</div>