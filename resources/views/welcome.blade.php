{@extends('layouts.app')

@section('home-content')
    @if (session('success'))
        <dialog id="error_modal" class="modal -mt-80 p-0 animate__animated animate__slideInDown" open>
            <div class="modal-box bg-green-500 max-w-4xl items-center justify-between shadow-none p-4 flex flex-row">
                <p class="text-white"><i class="fa-solid fa-circle-exclamation mr-2"></i>{{ session('success') }}</p>
                <button class="btn btn-sm bg-white text-black border-0 hover:bg-white/80"
                        onclick="closeModal('error_modal')">{{ __('welcome.close') }}</button>
            </div>
        </dialog>
    @endif
    <div class="bg-base-100 -mt-[76px]">
        <!-- Section Hero -->
        <section class="bg-cover bg-center h-screen text-primary-content"
                 style="background-image: url({{ asset('images/home-banner.jpg') }})">
            <div class="flex flex-col h-full container mx-auto justify-center">
                <div class="text-white w-full md:max-w-3xl p-5 md:text-left text-center">
                    <h1 class="md:text-8xl sm:text-7xl text-6xl font-bold leading-tight">
                        {{ __('welcome.hero_title_part1') }} <span class="text-accent bebas-neue-bold">{{ __('welcome.hero_title_part2') }}</span> {{ __('welcome.hero_title_part3') }}
                    </h1>
                    <p class="text-white/50 md:text-lg mt-5 md:max-w-2xl max-w-lg mb-8">
                        {{__('welcome.hero_description')}}
                    </p>
                    <a id="get-started-button" href="{{ route('register') }}"
                        class="mt-8 px-6 py-3 text-white mr-7 rounded-none btn-md outline outline-2 outline-accent outline-offset-2 transition ease-in-out duration-200">
                        {{__('welcome.get_started')}} <i class="fa-solid fa-chevron-right ml-2 transition ease-in-out duration-200"></i>
                    </a>
                    <div class="w-48 h-1 rounded-full bg-accent text-white mt-8 shadow-md">&ensp;</div>
                </div>
            </div>
        </section>
    </div>

    <script>
        const getStartedButton = document.getElementById('get-started-button');
        getStartedButton.addEventListener('mouseover', (e) => {
            e.target.children[0].classList.add('transform', 'translate-x-2');

            e.target.addEventListener('mouseout', (e) => {
                e.target.children[0].classList.remove('transform', 'translate-x-2');
            });

            e.preventDefault();
        });


        const viewPlanButton = document.getElementById('view-plan-button');
        viewPlanButton.addEventListener('mouseover', (e) => {
            e.target.children[0].classList.add('transform', 'translate-x-2');

            e.target.addEventListener('mouseout', (e) => {
                e.target.children[0].classList.remove('transform', 'translate-x-2');
            });

            e.preventDefault();
        });

        function closeModal(modalId) {
            document.getElementById(modalId).close();
        }
    </script>
@endsection
