@extends('layouts.app')

@section('home-content')
    <div class="bg-base-100 -mt-[67px]">
        <!-- Section Hero -->
        <section class="bg-cover bg-center h-screen text-primary-content"
            style="background-image: url({{ asset('images/home-banner.jpg') }})">
            <div class="flex flex-col h-full container mx-auto justify-center">
                <div class="text-white w-full md:max-w-3xl p-5 md:text-left text-center">
                    <h1 class="md:text-8xl sm:text-7xl text-6xl font-bold leading-tight">
                        BE <span class="text-accent bebas-neue-bold">SPIRITED</span> FEARLESS AN
                        EVERYDAY ATHLETE
                    </h1>
                    <p class="text-white/50 md:text-lg mt-5 md:max-w-2xl max-w-lg">
                        A certified running coach and personal trainer for over a decade, I’ve
                        helped thousands of runners through 1-1 personalized coaching and fitness Club, I’ve helped
                        thousands of runners through 1-1 personalized coaching and fitness Club.
                    </p>
                    <button id="get-started-button"
                        class="mt-8 px-6 py-3 text-white mr-7 rounded-none btn-md outline outline-2 outline-accent outline-offset-2 transition ease-in-out duration-200">
                        Get Started <i class="fa-solid fa-chevron-right ml-2 transition ease-in-out duration-200"></i>
                    </button>
                    <button id="view-plan-button"
                        class="bg-accent mt-8 px-6 py-3 text-white rounded-none btn-md outline outline-2 outline-accent outline-offset-2 transition ease-in-out duration-200">
                        View Plan <i class="fa-solid fa-chevron-right ml-2 transition ease-in-out duration-200"></i>
                    </button>
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
    </script>
@endsection
