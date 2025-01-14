<!DOCTYPE html><!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de gestión de eventos de la Universidad Nacional Autónoma de México">
    <title>{{ config('app.name', 'UNAM Eventos') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#F5F6F8] font-sans min-h-screen">
    <div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 800)">
        <!-- Header -->
        <header class="w-full bg-[#1C3D6C] shadow-lg fixed top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex justify-between items-center h-16 md:h-20">
                    <a href="/" class="focus:outline-none focus:ring-2 focus:ring-white/50 rounded-lg">
                        <img src="{{ asset('img/logo.webp') }}" alt="UNAM Logo" class="h-10 md:h-14 w-auto">
                    </a>
                    <a href="{{ route('login') }}" 
                       class="text-white hover:text-gray-200 transition-colors duration-200 
                              px-4 py-2 rounded-lg hover:bg-white/10 focus:outline-none focus:ring-2 
                              focus:ring-white/50 text-sm md:text-base">
                        Iniciar Sesión
                    </a>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 md:pt-28 pb-12">
            <!-- Loading Skeleton -->
            <div x-show="loading" class="animate-pulse space-y-8">
                <div class="space-y-4 max-w-2xl">
                    <div class="h-8 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="h-64 bg-gray-200 rounded"></div>
                    <div class="space-y-4">
                        <div class="h-32 bg-gray-200 rounded"></div>
                        <div class="h-32 bg-gray-200 rounded"></div>
                    </div>
                </div>
            </div>

            <!-- Actual Content -->
            <div x-show="!loading" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="grid md:grid-cols-2 gap-8">
                
                <!-- Left Column -->
                <div class="space-y-6">
                    <div class="space-y-4 max-w-xl">
                        <h1 class="text-[#3B4042] text-3xl md:text-4xl lg:text-5xl font-bold leading-tight text-center md:text-left">
                            Eventos UNAM
                        </h1>
                        <p class="text-[#5E5E5F] text-base md:text-lg text-center md:text-left">
                            Regístrate para participar en nuestros eventos académicos y culturales
                        </p>
                    </div>

                    <!-- Current Event Card -->
                    @if($currentEvent)
                    <div x-data="{ expanded: false }" 
                         class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <div class="p-4 md:p-6">
                            <h2 class="text-[#2C4D71] text-xl font-semibold mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#1C3D6C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $currentEvent->name }}
                            </h2>
                            
                            <div class="space-y-3">
                                <button @click="expanded = !expanded" 
                                        class="w-full text-left focus:outline-none focus:ring-2 focus:ring-[#2C4D71] rounded-lg p-2 -mx-2">
                                    <div class="flex items-center justify-between">
                                        <h3 class="font-semibold text-[#3B4042] text-lg">Ver detalles del evento</h3>
                                        <svg :class="expanded ? 'rotate-180 transform' : ''" 
                                             class="w-5 h-5 transition-transform duration-200 flex-shrink-0 ml-2" 
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </button>

                                <div x-show="expanded" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                     class="space-y-3 text-[#5E5E5F] text-sm md:text-base">
                                    <p>{{ $currentEvent->description }}</p>
                                    
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="break-words">{{ $currentEvent->location }}</span>
                                        <hr />
                                    </div>                                    
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>Inicia: {{ \Carbon\Carbon::parse($currentEvent->start_date)->locale('es')->translatedFormat('d \d\e F \d\e Y H:i') }} Horas</span>   
                                    </div>                                 
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Culmina: {{ \Carbon\Carbon::parse($currentEvent->end_date)->locale('es')->translatedFormat('d \d\e F \d\e Y H:i') }} Horas</span>   
                                    </div>                                 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-data="{ showTalks: false }" class="mt-4">
                        <button @click="showTalks = !showTalks" 
                                class="w-full bg-[#1C3D6C] text-white py-2 px-4 rounded-lg hover:bg-[#2C4D71] transition-colors duration-200">
                            <div class="flex items-center justify-between">
                                <span>Ver programa del evento</span>
                                <svg :class="showTalks ? 'rotate-180 transform' : ''"
                                    class="w-5 h-5 transition-transform duration-200"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                        
                        <div x-show="showTalks" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            class="mt-4">
                            <a href="{{ route('event.program', $currentEvent->id) }}" 
                            class="block bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-[#2C4D71] font-semibold">Programa completo</h3>
                                        <p class="text-[#5E5E5F] text-sm">Ver todas las charlas y ponentes</p>
                                    </div>
                                    <svg class="w-6 h-6 text-[#1C3D6C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="bg-white rounded-xl shadow-md p-4 md:p-6">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-gray-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <h2 class="text-[#2C4D71] text-xl font-semibold">No hay eventos activos</h2>
                                <p class="text-[#5E5E5F] mt-1">Próximamente publicaremos nuevos eventos.</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column - Registration Cards -->
                <div class="space-y-4">
                    <!-- Attendee Registration -->
                    <div class="group bg-white rounded-xl shadow-md p-4 md:p-6 hover:shadow-lg 
                              transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative">
                            <h3 class="text-[#2C4D71] text-xl font-semibold mb-2 flex items-center">
                                Asistente al Evento
                                <svg class="w-5 h-5 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity" 
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" 
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" 
                                          clip-rule="evenodd" />
                                </svg>
                            </h3>
                            <!-- Tooltip solo visible en desktop -->
                            <div class="hidden md:block absolute opacity-0 group-hover:opacity-100 transition-opacity 
                                      bg-black text-white text-sm rounded-lg py-2 px-3 -top-2 left-full ml-3 w-48 z-10">
                                Regístrate como asistente para participar en todos nuestros eventos
                            </div>
                        </div>
                        <p class="text-[#5E5E5F] mb-4">Participa en nuestros eventos académicos y culturales</p>
                        <a href="{{ route('register', ['type' => 'attendee']) }}" 
                           class="block w-full bg-[#1C3D6C] text-white text-center py-3 rounded-lg
                                  transform transition-all duration-200 
                                  hover:bg-[#2C4D71] hover:scale-[1.02] 
                                  active:scale-[0.98] 
                                  focus:outline-none focus:ring-2 focus:ring-[#2C4D71] focus:ring-offset-2">
                            Registro Asistente
                        </a>
                    </div>

                    <!-- Speaker Registration -->
                    <div class="group bg-white rounded-xl shadow-md p-4 md:p-6 hover:shadow-lg 
                              transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative">
                            <h3 class="text-[#2C4D71] text-xl font-semibold mb-2 flex items-center">
                                Orador
                                <svg class="w-5 h-5 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity" 
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" 
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" 
                                          clip-rule="evenodd" />
                                </svg>
                            </h3>
                            <!-- Tooltip solo visible en desktop -->
                            <div class="hidden md:block absolute opacity-0 group-hover:opacity-100 transition-opacity 
                                      bg-black text-white text-sm rounded-lg py-2 px-3 -top-2 left-full ml-3 w-48 z-10">
                                Regístrate como orador si vas a presentar una ponencia o dirigir una sesión
                            </div>
                        </div>
                        <p class="text-[#5E5E5F] mb-4">Comparte tu conocimiento y experiencia</p>
                        <a href="{{ route('register', ['type' => 'speaker']) }}"
                           class="block w-full bg-[#2C4D71] text-white text-center py-3 rounded-lg
                                  transform transition-all duration-200 
                                  hover:bg-[#1C3D6C] hover:scale-[1.02] 
                                  active:scale-[0.98] 
                                  focus:outline-none focus:ring-2 focus:ring-[#1C3D6C] 
                                  focus:ring-offset-2">
                            Registro Orador
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-16 py-8 bg-[#1C3D6C] text-white">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; {{ date('Y') }} Universidad Nacional Autónoma de México. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

<!-- Notification Component -->
    @if (session('status'))
    <div x-data="{ show: true }"
         x-show="show"
         x-transition:enter="transform ease-out duration-300 transition"
         x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-init="setTimeout(() => show = false, 4000)"
         class="fixed bottom-4 right-4 bg-white border-l-4 border-[#1C3D6C] p-4 rounded-lg shadow-lg z-50">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-[#1C3D6C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-800">
                    {{ session('status') }}
                </p>
            </div>
            <div class="ml-4 flex-shrink-0 flex">
                <button @click="show = false" 
                        class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-[#1C3D6C]">
                    <span class="sr-only">Cerrar</span>
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @endif
</body>
</html>
