@extends('layouts.admin')

@section('content')
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        protech: '#DFFF00',
                        darkBg: '#080808',
                        cardBg: '#111111',
                    },
                    fontFamily: {
                        tech: ['Orbitron', 'sans-serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #080808;
            color: white;
        }

        /* Style personnalisé pour les inputs */
        .tech-input {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }

        .tech-input:focus {
            border-color: #DFFF00;
            box-shadow: 0 0 15px rgba(223, 255, 0, 0.1);
            outline: none;
            background: rgba(255, 255, 255, 0.05);
        }
    </style>

    <div class="w-full bg-darkBg text-white font-sans min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-8 py-12">

            <div class="mb-12">
                <a href="{{ route('admin.categories.index') }}"
                    class="text-protech text-[10px] font-bold uppercase tracking-[0.2em] hover:text-white transition flex items-center gap-2 mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à la liste
                </a>
                <h1 class="text-4xl font-tech tracking-tight uppercase text-white">Nouvelle Catégorie</h1>
                <p class="text-white/40 mt-2 uppercase tracking-widest text-xs font-bold">Initialisation d'un nouveau
                    segment d'inventaire</p>
            </div>

            @if($errors->any())
                <div class="mb-8 p-6 bg-red-500/10 border-l-4 border-red-500 rounded-r-2xl">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-bold text-red-500 uppercase text-xs tracking-widest">Erreurs de validation</span>
                    </div>
                    <ul class="list-disc list-inside text-red-400/80 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-cardBg rounded-3xl border border-white/5 p-8 lg:p-12 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-protech/5 blur-[80px]"></div>

                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="space-y-4">
                        <label class="block text-white/40 font-bold text-[10px] uppercase tracking-[0.3em] ml-1">
                            Désignation du Nom
                        </label>
                        <div class="relative group">
                            <input type="text" name="name"
                                class="tech-input w-full px-6 py-5 rounded-2xl font-medium text-lg"
                                placeholder="Ex: Équipements Cyber" value="{{ old('name') }}" required>
                            <div
                                class="absolute bottom-0 left-0 h-[2px] w-0 bg-protech transition-all duration-500 group-focus-within:w-full">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-5 bg-protech text-black rounded-2xl hover:bg-white transition-all duration-300 font-extrabold text-sm uppercase tracking-widest flex items-center justify-center gap-3 shadow-[0_10px_20px_rgba(223,255,0,0.1)]">
                            <span>Exécuter la création</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection