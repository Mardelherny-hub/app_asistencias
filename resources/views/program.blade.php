<!-- resources/views/events/program.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Programa del evento {{ $event->name }} - UNAM">
    <title>{{ $event->name }} - Programa | {{ config('app.name', 'UNAM Eventos') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-[#F5F6F8] to-[#E8EAED] font-sans min-h-screen">
    <div x-data="{ loading: true, showBackToTop: false }" 
         x-init="setTimeout(() => loading = false, 800); 
                 window.addEventListener('scroll', () => showBackToTop = window.pageYOffset > 500)">
        <!-- Header mejorado -->
        <header class="w-full bg-gradient-to-r from-[#1C3D6C] to-[#2C4D71] shadow-lg fixed top-0 z-50 backdrop-blur-sm bg-opacity-95">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex justify-between items-center h-16 md:h-20">
                    <a href="/" class="flex items-center space-x-3 focus:outline-none focus:ring-2 focus:ring-white/50 rounded-lg">
                        <img src="{{ asset('img/logo.webp') }}" alt="UNAM Logo" class="h-10 md:h-14 w-auto">
                        <span class="text-white font-semibold hidden md:block">Eventos UNAM</span>
                    </a>
                    <div class="flex items-center space-x-4">
                        <a href="/" class="text-white hover:text-gray-200 transition-colors duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            <span>Volver</span>
                        </a>
                        @auth
                            <a href="{{ route('dashboard') }}" 
                               class="bg-white/10 text-white px-4 py-2 rounded-lg hover:bg-white/20 transition-colors duration-200">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="bg-white/10 text-white px-4 py-2 rounded-lg hover:bg-white/20 transition-colors duration-200">
                                Iniciar Sesión
                            </a>
                        @endauth
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 md:pt-32 pb-12">
            <!-- Event Header con stats -->
            <div class="mb-8 bg-white rounded-xl shadow-md p-6 md:p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-[#3B4042] text-3xl md:text-4xl font-bold">{{ $event->name }}</h1>
                        <p class="text-[#5E5E5F] text-lg mt-2">Programa completo del evento</p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <div class="bg-[#F5F6F8] rounded-lg p-4 text-center min-w-[120px]">
                            <span class="text-2xl font-bold text-[#2C4D71]">{{ $talks->count() }}</span>
                            <p class="text-sm text-[#5E5E5F]">Charlas</p>
                        </div>
                        <div class="bg-[#F5F6F8] rounded-lg p-4 text-center min-w-[120px]">
                            <span class="text-2xl font-bold text-[#2C4D71]">{{ $talks->unique('speaker_id')->count() }}</span>
                            <p class="text-sm text-[#5E5E5F]">Ponentes</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline of Talks con mejoras visuales -->
            <div class="space-y-6">
                @foreach($talks as $talk)
                    <div x-data="{ showDetails: false }" 
                         class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="p-6 md:p-8">
                            <!-- Talk Header con horario destacado -->
                            <div class="flex flex-col md:flex-row md:items-start gap-6">
                                <div class="flex-shrink-0 bg-[#1C3D6C] text-white rounded-lg p-4 text-center md:w-32">
                                    <div class="text-2xl font-bold">
                                        {{ \Carbon\Carbon::parse($talk->start_time)->format('H:i') }}
                                    </div>
                                    <div class="text-sm opacity-75">
                                        {{ \Carbon\Carbon::parse($talk->start_time)->format('d M') }}
                                    </div>
                                </div>
                                
                                <div class="flex-1">
                                    <h2 class="text-2xl font-bold text-[#2C4D71] mb-3">{{ $talk->title }}</h2>
                                    <div class="flex items-center text-[#5E5E5F] mb-4">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        <span>{{ $talk->location }}</span>
                                    </div>

                                    <!-- Speaker card mejorado -->
                                    <div class="flex items-start space-x-4 bg-[#F5F6F8] rounded-lg p-4">
                                        <img src="{{ $talk->speaker->photo }}" 
                                             alt="{{ $talk->speaker->name }}"
                                             class="w-16 h-16 rounded-full object-cover ring-2 ring-white">
                                        <div>
                                            <h3 class="text-lg font-semibold text-[#2C4D71]">{{ $talk->speaker->name }}</h3>
                                            <div class="flex space-x-3 my-2">
                                                <a href="#twitter" class="text-[#1DA1F2] hover:text-[#1a90db] transition-colors duration-200">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                                    </svg>
                                                </a>
                                                <a href="#linkedin" class="text-[#0A66C2] hover:text-[#0957a7] transition-colors duration-200">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <p class="text-[#5E5E5F] text-sm">{{ Str::limit($talk->speaker->bio, 150) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Expandable Details con animación mejorada -->
                            <div class="mt-6">
                                <button @click="showDetails = !showDetails"
                                        class="w-full flex items-center justify-between p-4 bg-[#F5F6F8] rounded-lg hover:bg-[#E8EAED] transition-colors duration-200">
                                    <span class="text-[#2C4D71] font-medium">{{ 'showDetails' ? 'Detalles' : 'Ver detalles de la charla' }}</span>
                                    <svg :class="showDetails ? 'rotate-180 transform' : ''"
                                         class="w-5 h-5 text-[#2C4D71] transition-transform duration-200"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <div x-show="showDetails" 
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-y-4"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="mt-4 p-4 bg-[#F5F6F8] rounded-lg">
                               <p class="text-[#5E5E5F] leading-relaxed mb-4">{{ $talk->description }}</p>
                               
                               @auth
                                   <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6 pt-4 border-t border-gray-200">
                                       <!-- QR Code Button -->
                                       <a href="{{ $talk->getQrCodeUrl() }}"
                                          class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-[#1C3D6C] text-white rounded-lg hover:bg-[#2C4D71] transition-all duration-200 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                                           <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                     d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                           </svg>
                                           Registrar Asistencia
                                       </a>
                                       
                                       <!-- Add to Calendar Button -->
                                       <button class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-white border border-[#1C3D6C] text-[#1C3D6C] rounded-lg hover:bg-[#F5F6F8] transition-all duration-200 transform hover:-translate-y-1 shadow-sm hover:shadow-md">
                                           <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                     d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                           </svg>
                                           Agregar al Calendario
                                       </button>
                                   </div>
                               @endauth
                            </div>
                                                   </div>
                                               </div>
                                           @endforeach
                                       </div>
                                       
                                       <!-- Back to Top Button -->
                                       <button x-show="showBackToTop"
                                               x-transition:enter="transition ease-out duration-300"
                                               x-transition:enter-start="opacity-0 transform translate-y-2"
                                               x-transition:enter-end="opacity-100 transform translate-y-0"
                                               @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                                               class="fixed bottom-8 right-8 bg-[#1C3D6C] text-white p-3 rounded-full shadow-lg hover:bg-[#2C4D71] transition-colors duration-200">
                                           <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                                           </svg>
                                       </button>
                                   </main>
                            
                                   <!-- Footer -->
                                   <footer class="bg-white border-t border-gray-200 mt-12">
                                       <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                                           <div class="flex flex-col md:flex-row justify-between items-center">
                                               <div class="flex items-center space-x-4 mb-4 md:mb-0">
                                                   <img src="{{ asset('img/logo.webp') }}" alt="UNAM Logo" class="h-10 w-auto">
                                                   <span class="text-[#1C3D6C] font-semibold">Universidad Nacional Autónoma de México</span>
                                               </div>
                                               <div class="text-[#5E5E5F] text-sm">
                                                   © {{ date('Y') }} UNAM. Todos los derechos reservados.
                                               </div>
                                           </div>
                                       </div>
                                   </footer>
                               </div>
                            </body>
                            </html>