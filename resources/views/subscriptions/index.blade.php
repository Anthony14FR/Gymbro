@extends('layouts.app')

@section('subscriptions-content')
    <div class="grid lg:grid-cols-2 grid-cols-1 h-screen -mt-[76px] relative z-1">
        @if (session('error'))
            <dialog id="error_modal" class="modal -mt-80 p-0 animate__animated animate__slideInDown" open>
                <div class="modal-box bg-red-500 max-w-4xl items-center justify-between shadow-none p-4 flex flex-row">
                    <p class="text-white"><i class="fa-solid fa-circle-exclamation mr-2"></i> Il semble qu'il y ait eu un problème
                        avec votre paiement. Veuillez réessayer.</p>
                    <button class="btn btn-sm bg-white text-black border-0 hover:bg-white/80"
                        onclick="closeModal('error_modal')">Fermer</button>
                </div>
            </dialog>
        @endif


        <div id="subscribe-section" class="px-16 bg-base-300 relative shadow-xl animate__animated animate__fadeIn">
            <p class="font-bold text-white text-4xl mt-40">Gymbro <span
                    class="bg-accent p-2 text-white rounded-xl shadow-lg">PRO</span></p>
            <p class="text-white/70 text-lg mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec
                purus
                et nunc.</p>
            <div class="mt-8">
                <div class="border border-2 border-gray-500/10 rounded-xl shadow-md p-5 bg-base-100">
                    <p class="text-white font-bold text-2xl mt-2 mb-5">Features <i
                            class="fa-brands fa-sketch text-accent ml-2"></i></p>
                    <ul class="text-white/70">
                        <li><i class="fa-solid fa-check text-gray-500 mr-2"></i> Access to all programs of the platform
                        </li>
                        <li><i class="fa-solid fa-check text-gray-500 mr-2"></i> Access to all programs of the community
                        </li>
                        <li><i class="fa-solid fa-check text-gray-500 mr-2"></i> Export your programs in PDF</li>
                    </ul>
                </div>
            </div>
            <p class="text-white font-bold text-2xl mt-2">Pricing <i
                    class="fa-brands fa-ethereum text-accent ml-2 mt-10"></i></p>
            <form action="{{ route('subscriptions.create') }}" method="POST" class="p-6 rounded-lg">
                @csrf
                <div class="flex">
                    <div class="flex space-x-3 mb-4">
                        <input type="radio" id="yearly" name="billing" value="yearly"
                            class="form-radio text-accent mt-2 h-6 w-6" checked>
                    </div>
                    <div class="ml-5">
                        <div class="flex flex-row items-center">
                            <label for="yearly" class="text-white text-2xl font-medium">Annuel</label>
                            <span class="bg-accent/20 text-white text-sm px-2 py-1 rounded ml-2">Save 15€</span>
                        </div>
                        <div class="flex space-x-2 mt-1">
                            <p class="text-sm text-white/80">1.75€/mois</p>
                            <div class="text-gray-500/60">|</div>
                            <p class="text-sm text-gray-500/60">21€ par an</p>
                        </div>
                    </div>
                </div>

                <div class="flex mt-8">
                    <div class="flex space-x-3 mb-4">
                        <input type="radio" id="monthly" name="billing" value="monthly"
                            class="form-radio text-accent mt-2 h-6 w-6" checked>
                    </div>
                    <div class="ml-5">
                        <div class="flex flex-row items-center">
                            <label for="monthly" class="text-white text-2xl font-medium">Mensuel</label>
                        </div>
                        <div class="flex space-x-2 mt-1">
                            <p class="text-sm text-white/80">3€/mois</p>
                            <div class="text-gray-500/60">|</div>
                            <p class="text-sm text-gray-500/60">36€ par an</p>
                        </div>
                    </div>
                </div>
                <button type="submit" id="subscribeBtn"
                    class="btn btn-accent text-white w-full font-semibold mt-16"></button>
            </form>

        </div>
        <div class="lg:flex hidden">
            <img src="{{ asset('images/subscribe-image.jpg') }}" alt="Subscription" class="w-full h-full object-cover" />
        </div>
    </div>

    <script>
        const yearlySentence = "Continuer avec l'abonnement annuel";
        const monthlySentence = "Continuer avec l'abonnement mensuel";
        const subscribeBtn = document.getElementById('subscribeBtn');
        subscribeBtn.textContent = monthlySentence;


        const radios = document.querySelectorAll('input[type="radio"]');
        radios.forEach(radio => {
            radio.addEventListener('change', (e) => {
                if (e.target.value === 'yearly') {
                    subscribeBtn.textContent = yearlySentence;
                } else {
                    subscribeBtn.textContent = monthlySentence;
                }
            });
        });

        function closeModal(modalId) {
            document.getElementById(modalId).close();
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showMessage("{{ session('success') }}", "success");
            @elseif (session('error'))
                showMessage("{{ session('error') }}", "error");
            @endif

            function showMessage(message, type) {
                const flashMessageDiv = document.getElementById('flash-message');
                flashMessageDiv.innerHTML = `<div class="p-4 ${
                    type === 'success' ? 'bg-green-500' : 'bg-red-500'
                } text-white">${message}</div>`;

                setTimeout(() => {
                    flashMessageDiv.innerHTML = '';
                }, 5000);
            }
        });
    </script>
@endsection
