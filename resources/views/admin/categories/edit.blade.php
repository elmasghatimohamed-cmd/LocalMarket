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

        .tech-input {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }

        .tech-input:focus {
            border-color: #DFFF00;
            box-shadow: 0 0 20px rgba(223, 255, 0, 0.15);
            outline: none;
            background: rgba(255, 255, 255, 0.05);
        }
    </style>

    <div class="w-full bg-darkBg text-white font-sans min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-8 py-12">

            <div class="mb-12">
                <a href="{{ route('admin.categories.index') }}"
                    class="text-white/40 text-[10px] font-bold uppercase tracking-[0.2em] hover:text-protech transition flex items-center gap-2 mb-4 group">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Annuler les modifications
                </a>
                <h1 class="text-4xl font-tech tracking-tight uppercase text-white">Éditer <span class="text-protech">ID:
                        #{{ $category->id }}</span></h1>
                <p class="text-white/40 mt-2 uppercase tracking-widest text-xs font-bold">Modification des paramètres de la
                    catégorie : {{ $category->name }}</p>
            </div>

            @if($errors->any())
                <div class="mb-8 p-6 bg-red-500/10 border border-red-500/20 rounded-2xl">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                        <span class="font-bold text-red-500 uppercase text-xs tracking-widest">Alerte Système : Données
                            Invalides</span>
                    </div>
                    <ul class="text-red-400/80 text-sm space-y-1 ml-5 list-disc">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-cardBg rounded-3xl border border-white/5 p-8 lg:p-12 shadow-2xl relative overflow-hidden">
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-protech/5 rounded-full blur-[100px]"></div>

                <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-10 relative">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <label class="text-white/40 font-bold text-[10px] uppercase tracking-[0.3em] ml-1">
                                Nom de la Catégorie
                            </label>
                            <span class="text-[9px] font-tech text-protech/40 uppercase">Mode Édition Actif</span>
                        </div>

                        <div class="relative">
                            <input type="text" name="name"
                                class="tech-input w-full px-6 py-5 rounded-2xl font-medium text-lg focus:ring-0"
                                value="{{ old('name', $category->name) }}" required>
                        </div>
                    </div>

                    <div class="pt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('admin.categories.index') }}"
                            class="py-5 bg-white/5 text-white/60 rounded-2xl hover:bg-white/10 hover:text-white transition-all font-bold text-xs uppercase tracking-widest text-center">
                            Abandonner
                        </a>

                        <button type="submit"
                            class="py-5 bg-protech text-black rounded-2xl hover:shadow-[0_0_30px_rgba(223,255,0,0.2)] hover:scale-[1.02] transition-all duration-300 font-extrabold text-xs uppercase tracking-widest flex items-center justify-center gap-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Mettre à jour le système
                        </button>
                    </div>
                </form>
            </div>

            <p class="text-center text-white/20 text-[9px] uppercase tracking-[0.4em] mt-12">
                Protech OS v2.0 - Database Management Protocol
            </p>
        </div>
    </div>
@endsection