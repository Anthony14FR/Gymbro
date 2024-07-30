<div class="bg-[#131417] shadow-md z-40 relative border-b-4 border-gray-500/20">
    <nav class="navbar flex flex-col sm:flex-row justify-between items-center container mx-auto px-4 py-2">
        <div class="flex flex-col sm:flex-row items-center w-full sm:w-auto mb-4 sm:mb-0">
            <a href="{{ route('programs.index') }}" class="text-xl flex items-center gap-2 mb-2 sm:mb-0">
                <img src="{{ asset('images/logo.svg') }}" alt="Gymbro" class="w-8 h-auto"/>
                <span class="text-xl font-bold text-white">GYMBRO</span>
            </a>
            @if (Auth::check())
                <div class="flex items-center mt-2 sm:mt-0 sm:ml-4">
                    @if (Auth::user()->hasRole('admin'))
                        <span class="text-xs bg-yellow-300 font-bold text-black/70 px-2 py-1 rounded-full mr-2">Admin</span>
                        <a href="{{ route('users.index') }}" class="text-xs btn btn-sm">Tableau de bord</a>
                    @elseif (Auth::user()->hasRole('premium'))
                        <span class="text-xs bg-yellow-300 font-bold text-black/70 px-2 py-1 rounded-full">Premium</span>
                    @elseif (Auth::user()->hasRole('user'))
                        <a href="{{ route('subscriptions.index') }}" class="text-sm flex items-center">
                            <div class="bg-yellow-300 font-bold text-black/70 flex px-2 py-1 rounded-full cursor-default">
                                <span class="text-xs">Pas encore abonné ? Cliquez <span class="underline ml-1 cursor-pointer">ici</span></span>
                            </div>
                        </a>
                    @endif
                </div>
            @endif
        </div>
        <div class="w-full sm:w-auto">
            @auth
                <div class="dropdown dropdown-end w-full sm:w-auto">
                    <div tabindex="0" role="button" class="btn btn-accent m-1 text-white w-full sm:w-auto">Menu <i class="fa-solid fa-bars ml-2"></i></div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-200 text-white rounded-box z-[1] w-52 p-2 shadow mt-2">
                        <li><a href="{{ route('profile.edit') }}" class="">Profil</a></li>
                        <li><a href="{{ route('programs.index') }}" class="">Programmes</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit">Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="space-x-3 bg-base-300/80 p-2 text-center sm:text-left">
                    <a href="{{ route('login') }}" class="hover:underline">Connexion</a>
                    <span>|</span>
                    <a href="{{ route('register') }}" class="hover:underline">Inscription</a>
                </div>
            @endauth
        </div>
    </nav>
</div>