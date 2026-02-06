
@include('navigation-menu')

@extends('layouts.admin')

@section('content')
    <div class="bg-[#080808] min-h-screen font-sans selection:bg-[#DFFF00]  antialiased relative overflow-x-hidden">
        
       

        <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8 relative">
            <div class="space-y-12">

                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <div class="group bg-[#111]/80 backdrop-blur-sm border border-white/5 rounded-[2.5rem] p-8 shadow-2xl transition-all duration-500 hover:border-[#DFFF00]/30 hover:translate-y-[-4px]">
                        <div class="mb-6 flex items-center gap-2">
                            <div class="w-1 h-4 bg-[#DFFF00]"></div>
                            <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest">Protocol 01</span>
                        </div>
                        @livewire('profile.update-profile-information-form')
                    </div>
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="group bg-[#111]/80 backdrop-blur-sm border border-white/5 rounded-[2.5rem] p-8 shadow-2xl transition-all duration-500 hover:border-[#DFFF00]/30 hover:translate-y-[-4px]">
                        <div class="mb-6 flex items-center gap-2">
                            <div class="w-1 h-4 bg-[#DFFF00]"></div>
                            <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest">Protocol 02</span>
                        </div>
                        @livewire('profile.update-password-form')
                    </div>
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="group bg-[#111]/80 backdrop-blur-sm border border-white/5 rounded-[2.5rem] p-8 shadow-2xl transition-all duration-500 hover:border-[#DFFF00]/30 hover:translate-y-[-4px]">
                        <div class="mb-6 flex items-center gap-2">
                            <div class="w-1 h-4 bg-[#DFFF00]"></div>
                            <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest">Security Matrix</span>
                        </div>
                        @livewire('profile.two-factor-authentication-form')
                    </div>
                @endif

                <div class="group bg-[#111]/80 backdrop-blur-sm border border-white/5 rounded-[2.5rem] p-8 shadow-2xl transition-all duration-500 hover:border-[#DFFF00]/30 hover:translate-y-[-4px]">
                    <div class="mb-6 flex items-center gap-2">
                        <div class="w-1 h-4 bg-[#DFFF00]"></div>
                        <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest">Active Links</span>
                    </div>
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div class="bg-red-950/5 border border-red-900/20 rounded-[2.5rem] p-8 shadow-2xl transition-all duration-500 hover:bg-red-950/10">
                        <div class="mb-6 flex items-center gap-2">
                            <div class="w-1 h-4 bg-red-600"></div>
                            <span class="text-[10px] text-red-500/50 uppercase font-black tracking-widest">Danger Zone</span>
                        </div>
                        @livewire('profile.delete-user-form')
                    </div>
                @endif

            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap');

        /* Global Jetstream Overrides */
        .bg-white { background-color: transparent !important; }
        .shadow { box-shadow: none !important; }
        .text-gray-600, .text-gray-900 { color: #888 !important; }
        .border-gray-200 { border-color: rgba(255,255,255,0.05) !important; }
        
        /* Form Footer Detail */
        .bg-gray-50 {
            background-color: rgba(255,255,255,0.02) !important;
            border-top: 1px solid rgba(255,255,255,0.05) !important;
            padding: 1.5rem !important;
            margin-top: 2rem !important;
            border-radius: 1.5rem;
        }

        /* Section Headings */
        h3 { 
            font-family: 'Orbitron', sans-serif !important; 
            color: white !important; 
            text-transform: uppercase !important; 
            letter-spacing: 0.1em !important;
            font-size: 1.1rem !important;
        }

        /* Description text */
        .text-sm.text-gray-600 {
            color: #555 !important;
            font-size: 0.75rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
        }
        
        /* Inputs */
        input, select, textarea {
            background-color: #080808 !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            color: white !important;
            border-radius: 0.75rem !important;
            font-size: 0.875rem !important;
        }
        input:focus {
            border-color: #DFFF00 !important;
            box-shadow: 0 0 15px rgba(223, 255, 0, 0.1) !important;
        }

        /* Buttons */
        button[type="submit"], 
        .inline-flex.items-center.px-4.py-2.bg-gray-800 {
            background-color: #DFFF00 !important;
            color: black !important;
            font-family: 'Orbitron', sans-serif !important;
            font-weight: 900 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.15em !important;
            font-size: 0.7rem !important;
            border-radius: 9999px !important;
            padding: 0.75rem 2rem !important;
            border: none !important;
        }
        button[type="submit"]:hover {
            background-color: white !important;
            box-shadow: 0 0 25px rgba(223, 255, 0, 0.4) !important;
        }

        /* Labels */
        label {
            color: #DFFF00 !important;
            font-size: 0.7rem !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            margin-bottom: 0.5rem !important;
            display: block !important;
        }
    </style>
@endsection