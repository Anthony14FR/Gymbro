@extends('layouts.app')

@section('home-content')
    @if (session('success'))
        <dialog id="error_modal"
                class="modal p-0 animate__animated animate__slideInDown fixed top-20 left-0 right-0 z-50" open>
            <div class="modal-box bg-green-500 max-w-4xl items-center justify-between shadow-none p-4 flex flex-col sm:flex-row">
                <p class="text-white text-center sm:text-left mb-2 sm:mb-0"><i
                            class="fa-solid fa-circle-exclamation mr-2"></i>{{ session('success') }}</p>
                <button class="btn btn-sm bg-white text-black border-0 hover:bg-white/80"
                        onclick="closeModal('error_modal')">{{ __('Fermer') }}</button>
            </div>
        </dialog>
    @endif
    <div class="bg-base-100">
        <!-- Section Hero -->
        <section class="bg-cover bg-center min-h-screen text-primary-content flex items-center"
                 style="background-image: url({{ asset('images/home-banner.webp') }})">
            <div class="container mx-auto px-4">
                <div class="text-white w-full md:max-w-3xl p-5 text-center md:text-left">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-bold leading-tight">
                        {{ __('Repoussez') }} <span
                                class="text-accent bebas-neue-bold">{{ __('les Limites,') }}</span> {{ __('Dépassez vos objectifs') }}
                    </h1>
                    <p class="text-white/50 text-base md:text-lg mt-5 max-w-2xl mx-auto md:mx-0 mb-8">
                        {{__('Entraînez vous avec des programmes réalisés par notre équipe de coach, ou par notre communauté de sportifs.')}}
                    </p>
                    <a id="get-started-button" href="{{ route('register') }}"
                       class="inline-block mt-8 px-6 py-3 text-white rounded-none btn-md outline outline-2 outline-accent outline-offset-2 transition ease-in-out duration-200">
                        {{__('Rejoindre la communauté')}} <i
                                class="fa-solid fa-chevron-right ml-2 transition ease-in-out duration-200"></i>
                    </a>
                    <div class="w-48 h-1 rounded-full bg-accent text-white mt-8 shadow-md mx-auto md:mx-0">&ensp;</div>
                </div>
            </div>
        </section>

        <!-- Section Fonctionnalités -->
        <section class="py-16 bg-base-200">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">{{ __('Fonctionnalités Principales') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <i class="fas fa-dumbbell text-4xl text-accent mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">{{ __('Programmes Personnalisés') }}</h3>
                        <p>{{ __('Créez vos programmes personnalisés selon vos critères et vos objectifs.') }}</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-users text-4xl text-accent mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">{{ __('Programmes Communautaires') }}</h3>
                        <p>{{ __('Accédez aux programmes créés et partagés par notre communauté de sportifs.') }}</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-file-download text-4xl text-accent mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">{{ __('Téléchargement') }}</h3>
                        <p>{{ __('Téléchargez vos programmes en PDF ou CSV pour les partager facilement.') }}</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section Témoignages -->
        <section class="py-16 bg-base-100">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">{{ __('Ce que disent nos utilisateurs') }}</h2>
                <div class="carousel w-full">
                    <div id="slide1" class="carousel-item relative w-full">
                        <div class="flex flex-col items-center justify-center w-full">
                            <div class="bg-base-200 p-6 rounded-lg shadow-md max-w-xl mx-auto">
                                <div class="flex items-center justify-center mb-4">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                </div>
                                <p class="mb-4">"{{ __('L\'interface est très intuitive ! Créer mes programmes n\'a jamais été aussi facile. Gymbro a du potentiel') }}"</p>
                                <p class="font-semibold">- Lucas M., coach sportif indépendant</p>
                            </div>
                        </div>
                        <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                            <a href="#slide5" class="btn btn-circle">❮</a>
                            <a href="#slide2" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                    <div id="slide2" class="carousel-item relative w-full">
                        <div class="flex flex-col items-center justify-center w-full">
                            <div class="bg-base-200 p-6 rounded-lg shadow-md max-w-xl mx-auto">
                                <div class="flex items-center justify-center mb-4">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                                </div>
                                <p class="mb-4">"{{ __('Les PDF générés sont magnifiques et professionnels. Mes clients sont impressionnés par la qualité des programmes que je leur fournis.') }}"</p>
                                <p class="font-semibold">- Emma S., propriétaire d'une salle de sport</p>
                            </div>
                        </div>
                        <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                            <a href="#slide1" class="btn btn-circle">❮</a>
                            <a href="#slide3" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                    <div id="slide3" class="carousel-item relative w-full">
                        <div class="flex flex-col items-center justify-center w-full">
                            <div class="bg-base-200 p-6 rounded-lg shadow-md max-w-xl mx-auto">
                                <div class="flex items-center justify-center mb-4">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                </div>
                                <p class="mb-4">"{{ __('Entre les programmes officiels Gymbro et ceux de la communauté, j\'ai l\'embarras du choix pour varier mes entraînements. La qualité est au rendez-vous à chaque fois !') }}"</p>
                                <p class="font-semibold">- Thomas D., passionné de fitness</p>
                            </div>
                        </div>
                        <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                            <a href="#slide2" class="btn btn-circle">❮</a>
                            <a href="#slide4" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                    <div id="slide4" class="carousel-item relative w-full">
                        <div class="flex flex-col items-center justify-center w-full">
                            <div class="bg-base-200 p-6 rounded-lg shadow-md max-w-xl mx-auto">
                                <div class="flex items-center justify-center mb-4">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                </div>
                                <p class="mb-4">"{{ __('Gymbro a révolutionné ma façon de travailler. Je peux créer des programmes personnalisés pour chaque client en quelques clics. Un vrai gain de temps et de professionnalisme !') }}"</p>
                                <p class="font-semibold">- Sarah L., coach en ligne</p>
                            </div>
                        </div>
                        <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                            <a href="#slide3" class="btn btn-circle">❮</a>
                            <a href="#slide5" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                    <div id="slide5" class="carousel-item relative w-full">
                        <div class="flex flex-col items-center justify-center w-full">
                            <div class="bg-base-200 p-6 rounded-lg shadow-md max-w-xl mx-auto">
                                <div class="flex items-center justify-center mb-4">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                                </div>
                                <p class="mb-4">"{{ __('En tant que débutant, j\'apprécie vraiment de pouvoir accéder aux programmes créés par des pros. Ça me guide dans ma progression et me motive à me dépasser.') }}"</p>
                                <p class="font-semibold">- Alex M., nouvel adepte du fitness</p>
                            </div>
                        </div>
                        <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                            <a href="#slide4" class="btn btn-circle">❮</a>
                            <a href="#slide1" class="btn btn-circle">❯</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section CTA -->
        <section class="py-16 bg-base-200">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-base-content">{{ __('Prêt à commencer votre transformation ?') }}</h2>
                <p class="text-lg mb-8 text-base-content/80">{{ __('Rejoignez Gymbro dès aujourd\'hui et découvrez comment nos outils peuvent vous aider à atteindre vos objectifs fitness.') }}</p>
                <a href="{{ route('register') }}"
                   class="inline-block px-8 py-4 bg-accent text-white font-bold rounded-lg hover:bg-accent/90 transition duration-300 shadow-md">
                    {{ __('Créer mon compte gratuitement') }}
                </a>
            </div>
        </section>
    </div>

    <style>
        @media (max-width: 640px) {
            .modal {
                top: 1rem;
            }
        }
    </style>

    <script>
        const getStartedButton = document.getElementById('get-started-button');
        getStartedButton.addEventListener('mouseover', (e) => {
            e.target.querySelector('i').classList.add('transform', 'translate-x-2');
        });
        getStartedButton.addEventListener('mouseout', (e) => {
            e.target.querySelector('i').classList.remove('transform', 'translate-x-2');
        });

        function closeModal(modalId) {
            document.getElementById(modalId).close();
        }
    </script>
@endsection