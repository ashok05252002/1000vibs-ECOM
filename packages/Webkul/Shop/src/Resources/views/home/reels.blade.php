<div class="container mt-20 mb-16 max-lg:px-8 max-md:mt-8 max-sm:mt-7 max-sm:px-4">
    <h2 class="font-dmserif text-3xl max-md:text-2xl max-sm:text-xl mb-8 text-zinc-900">
        Our Customer Reviews
    </h2>
    
    <div class="flex gap-6 overflow-x-auto pb-4 no-scrollbar scroll-smooth snap-x snap-mandatory md:flex md:justify-center md:gap-8 md:pb-0">
        @php
            $reels = [
                ['id' => 1, 'src' => 'https://mmiveoaqcneebkmxushx.supabase.co/storage/v1/object/public/uploads/FEEDBACK%20(1).mp4'],
                ['id' => 2, 'src' => 'https://mmiveoaqcneebkmxushx.supabase.co/storage/v1/object/public/uploads/IMG_0263%20(1).mp4'],
                ['id' => 3, 'src' => 'https://mmiveoaqcneebkmxushx.supabase.co/storage/v1/object/public/uploads/IMG_0710%20(1).mp4'],
            ];
        @endphp

        @foreach($reels as $reel)
            <div class="review-video-card relative bg-zinc-950 rounded-2xl overflow-hidden shadow-md snap-start group cursor-pointer border border-zinc-900 hover:border-indigo-500/30 transition-all duration-300">
                <!-- Video Element -->
                <video 
                    id="reel-video-{{ $reel['id'] }}"
                    class="w-full h-full object-cover"
                    loop
                    muted
                    autoplay
                    playsinline
                    webkit-playsinline
                    preload="metadata"
                    onclick="togglePlay('{{ $reel['id'] }}')"
                >
                    <source src="{{ $reel['src'] }}" type="video/mp4">
                </video>

                <!-- Custom Overlay Controls -->
                <div class="absolute inset-0 flex flex-col justify-between p-4 bg-gradient-to-t from-black/50 via-transparent to-transparent pointer-events-none">
                    
                    <!-- Top Info badge -->
                    <div class="flex justify-between items-start w-full">
                        <span class="bg-black/40 backdrop-blur-md px-3 py-1 rounded-full text-xs text-white font-medium flex items-center gap-1.5 border border-white/5">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Video
                        </span>
                    </div>

                    <!-- Center Play/Pause Indicator -->
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div id="play-btn-{{ $reel['id'] }}" class="w-14 h-14 rounded-full bg-black/40 backdrop-blur-md border border-white/10 flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:bg-black/60">
                            <!-- Play Icon -->
                            <svg id="play-icon-{{ $reel['id'] }}" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" class="w-6 h-6 translate-x-0.5">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            <!-- Pause Icon -->
                            <svg id="pause-icon-{{ $reel['id'] }}" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" class="w-6 h-6 hidden">
                                <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Bottom Controls (Mute/Unmute) -->
                    <div class="flex justify-end items-center w-full z-10 pointer-events-auto">
                        <button 
                            type="button"
                            onclick="toggleMute(event, '{{ $reel['id'] }}')" 
                            class="w-10 h-10 rounded-full bg-black/40 backdrop-blur-md border border-white/10 hover:border-white/30 text-white flex items-center justify-center transition-all active:scale-95"
                            title="Mute/Unmute"
                        >
                            <!-- Mute Icon -->
                            <svg id="mute-icon-{{ $reel['id'] }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 9.75 19.5 12m0 0 2.25 2.25M19.5 12l2.25-2.25M19.5 12l-2.25 2.25m-10.5-6 4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                            <!-- Speaker Icon -->
                            <svg id="speaker-icon-{{ $reel['id'] }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .review-video-card {
        height: 300px;
        width: 168px;
        flex-shrink: 0;
    }
    @media (max-width: 768px) {
        .review-video-card {
            height: 440px;
            width: 250px;
        }
    }
    @media (max-width: 480px) {
        .review-video-card {
            height: 480px;
            width: calc(100vw - 32px);
        }
    }
    /* Maintain original aspect ratio inside fullscreen mode */
    video:fullscreen {
        object-fit: contain !important;
        background-color: #000000;
    }
    video:-webkit-full-screen {
        object-fit: contain !important;
        background-color: #000000;
    }
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
    function togglePlay(id) {
        const video = document.getElementById('reel-video-' + id);
        
        // Mute all other videos first to prevent multiple audio tracks playing
        document.querySelectorAll('video[id^="reel-video-"]').forEach(v => {
            if (v.id !== 'reel-video-' + id) {
                v.muted = true;
                const otherId = v.id.replace('reel-video-', '');
                const otherMuteIcon = document.getElementById('mute-icon-' + otherId);
                const otherSpeakerIcon = document.getElementById('speaker-icon-' + otherId);
                if (otherMuteIcon) otherMuteIcon.classList.remove('hidden');
                if (otherSpeakerIcon) otherSpeakerIcon.classList.add('hidden');
            }
        });

        // Enter fullscreen for full view on click
        if (video.requestFullscreen) {
            video.requestFullscreen();
        } else if (video.webkitRequestFullscreen) {
            video.webkitRequestFullscreen();
        } else if (video.msRequestFullscreen) {
            video.msRequestFullscreen();
        }

        // Unmute when going fullscreen so sound plays
        video.muted = false;
        const muteIcon = document.getElementById('mute-icon-' + id);
        const speakerIcon = document.getElementById('speaker-icon-' + id);
        if (muteIcon) muteIcon.classList.add('hidden');
        if (speakerIcon) speakerIcon.classList.remove('hidden');

        video.play();
    }

    function toggleMute(event, id) {
        event.stopPropagation(); // Avoid triggering video play/pause on clicking volume button
        
        const video = document.getElementById('reel-video-' + id);
        const muteIcon = document.getElementById('mute-icon-' + id);
        const speakerIcon = document.getElementById('speaker-icon-' + id);

        if (video.muted) {
            // Mute all other videos first so only one video is unmuted at a time
            document.querySelectorAll('video[id^="reel-video-"]').forEach(v => {
                if (v.id !== 'reel-video-' + id) {
                    v.muted = true;
                    const otherId = v.id.replace('reel-video-', '');
                    const otherMuteIcon = document.getElementById('mute-icon-' + otherId);
                    const otherSpeakerIcon = document.getElementById('speaker-icon-' + otherId);
                    if (otherMuteIcon) otherMuteIcon.classList.remove('hidden');
                    if (otherSpeakerIcon) otherSpeakerIcon.classList.add('hidden');
                }
            });

            video.muted = false;
            muteIcon.classList.add('hidden');
            speakerIcon.classList.remove('hidden');
        } else {
            video.muted = true;
            muteIcon.classList.remove('hidden');
            speakerIcon.classList.add('hidden');
        }
    }

    // Global listener to detect when user exits fullscreen and mute the video again
    const handleFullscreenChange = () => {
        const fullscreenElement = document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement;
        if (!fullscreenElement) {
            document.querySelectorAll('video[id^="reel-video-"]').forEach(v => {
                v.muted = true;
                const id = v.id.replace('reel-video-', '');
                const muteIcon = document.getElementById('mute-icon-' + id);
                const speakerIcon = document.getElementById('speaker-icon-' + id);
                if (muteIcon) muteIcon.classList.remove('hidden');
                if (speakerIcon) speakerIcon.classList.add('hidden');
            });
        }
    };

    document.addEventListener('fullscreenchange', handleFullscreenChange);
    document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
    document.addEventListener('mozfullscreenchange', handleFullscreenChange);
    document.addEventListener('MSFullscreenChange', handleFullscreenChange);
</script>
