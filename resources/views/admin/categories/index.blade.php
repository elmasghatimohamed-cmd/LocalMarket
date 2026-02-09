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

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #080808;
        }

        ::-webkit-scrollbar-thumb {
            background: #222;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #DFFF00;
        }
    </style>

    <div class="w-full bg-darkBg text-white font-sans min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 py-12">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <h1 class="text-5xl font-tech tracking-tight uppercase text-white">Catégories</h1>
                    <p class="text-white/40 mt-2 uppercase tracking-widest text-xs font-bold">Gestion de l'inventaire &
                        Classification</p>
                </div>

                <a href="{{ route('admin.categories.create') }}"
                    class="px-8 py-4 bg-protech text-black rounded-full hover:bg-white transition font-extrabold text-xs uppercase tracking-tighter text-center">
                    + Ajouter une catégorie
                </a>
            </div>

            @if(session('status'))
                <div
                    class="mb-8 p-4 bg-protech/10 border border-protech/30 rounded-2xl text-protech font-bold text-sm uppercase tracking-widest animate-pulse">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-cardBg rounded-3xl border border-white/5 p-8 shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-white/5">
                                <th class="pb-6 px-4 text-white/40 font-bold text-[10px] uppercase tracking-[0.2em]">Nom de
                                    la catégorie</th>
                                <th
                                    class="pb-6 px-4 text-right text-white/40 font-bold text-[10px] uppercase tracking-[0.2em]">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($categories as $category)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="py-6 px-4">
                                        <div class="font-tech text-lg text-white group-hover:text-protech transition-colors">
                                            {{ $category->name }}
                                        </div>
                                        <div class="text-white/20 text-[10px] uppercase mt-1">ID: #{{ $category->id }}</div>
                                    </td>
                                    <td class="py-6 px-4 text-right">
                                        <div class="flex justify-end items-center gap-3">
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                                class="p-3 bg-white/5 border border-white/10 rounded-xl hover:bg-protech/20 hover:border-protech/50 text-white transition-all group/btn">
                                                <svg class="w-5 h-5 group-hover/btn:text-protech" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Confirmer la suppression ?')"
                                                    class="p-3 bg-white/5 border border-white/10 rounded-xl hover:bg-red-500/20 hover:border-red-500/50 text-white transition-all group/btn">
                                                    <svg class="w-5 h-5 group-hover/btn:text-red-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 pt-8 border-t border-white/5">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Style pour adapter la pagination Laravel au thème sombre */
        .pagination {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .page-item .page-link {
            background-color: #111 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            border-radius: 12px !important;
            padding: 0.5rem 1rem;
        }

        .page-item.active .page-link {
            background-color: #DFFF00 !important;
            color: black !important;
            font-weight: bold;
        }
    </style>
@endsection