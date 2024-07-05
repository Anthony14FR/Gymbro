@extends('layouts.app')

@section('content')
    <div class="bg-base-200">
        <!-- Section Hero -->
        <section class="bg-cover bg-center h-screen text-primary-content" style="background-image: url({{ asset('images/bck.webp') }})">
            <div class="flex items-center justify-center h-full bg-opacity-50 bg-base-900">
                <div class="text-center text-white">
                    <h1 class="text-5xl font-bold">Bienvenue sur Gymbro</h1>
                    <p class="mt-4 text-xl">Ton partenaire pour une vie plus saine.</p>
                    <a href="{{ route('register') }}" class="mt-8 px-4 py-2 btn btn-accent rounded-full">Rejoins-nous</a>
                </div>
            </div>
        </section>

        <!-- Section Fonctionnalités -->
        <section id="features" class="py-16 bg-base-100">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-center">Fonctionnalités</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                    <div class="flex flex-col items-center text-center p-6 bg-base-200 rounded-lg shadow-md">
                        <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                        </svg>
                        <h3 class="mt-4 text-xl font-semibold">Programmes personnalisés</h3>
                        <p class="mt-2">Crée des plans d'entraînement sur mesure adaptés à tes besoins.</p>
                    </div>
                    <div class="flex flex-col items-center text-center p-6 bg-base-200 rounded-lg shadow-md">
                        <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                        </svg>
                        <h3 class="mt-4 text-xl font-semibold">Accèdes aux programmes de la communauté</h3>
                        <p class="mt-2">Découvre et partage des plans d'entraînement avec d'autres membres.</p>
                    </div>
                    <div class="flex flex-col items-center text-center p-6 bg-base-200 rounded-lg shadow-md">
                        <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                        </svg>
                        <h3 class="mt-4 text-xl font-semibold">Des programmes Gymbro réalisés par des professionnels</h3>
                        <p class="mt-2">Découvre des plans d'entraînement conçus par des coachs professionnels.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Appel à l'action -->
        <section class="py-8 bg-primary text-primary-content">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-bold">Prêt à commencer ?</h2>
                <p class="mt-4 text-xl">Rejoins Gymbro aujourd'hui et fais le premier pas vers une vie plus saine.</p>
                <a href="/register" class="mt-8 px-4 py-2 btn btn-accent rounded-full">Inscris-toi maintenant</a>
            </div>
        </section>
    </div>
@endsection
