@props([
    'hasHeader'  => true,
    'hasFeature' => true,
    'hasFooter'  => true,
])

<!DOCTYPE html>

<html
    lang="{{ app()->getLocale() }}"
    dir="{{ core()->getCurrentLocale()->direction }}"
>
    <head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KRW3VSDG');</script>
<!-- End Google Tag Manager -->
    
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1300310362093540');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1300310362093540&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

        {!! view_render_event('bagisto.shop.layout.head.before') !!}

        <title>{{ $title ?? '' }}</title>

        <meta charset="UTF-8">

        <meta
            http-equiv="X-UA-Compatible"
            content="IE=edge"
        >
        <meta
            http-equiv="content-language"
            content="{{ app()->getLocale() }}"
        >

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        >
        <meta
            name="base-url"
            content="{{ url()->to('/') }}"
        >
        <meta
            name="currency"
            content="{{ core()->getCurrentCurrency()->toJson() }}"
        >
        <meta 
            name="generator" 
            content="Bagisto"
        >

        @stack('meta')

        <link
            rel="icon"
            sizes="16x16"
            href="{{ core()->getCurrentChannel()->favicon_url ?? bagisto_asset('images/favicon.ico') }}"
        />

        @bagistoVite(['src/Resources/assets/css/app.css', 'src/Resources/assets/js/app.js'])

        <link
            rel="preconnect"
            href="https://fonts.googleapis.com"
            crossorigin
        />

        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin
        />

        <link
            rel="preload" as="style"
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Serif+Display&display=swap"
        />

        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Serif+Display&display=swap"
        />

        @stack('styles')

        <style>
            @keyframes promoPulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.2); }
                100% { transform: scale(1); }
            }
            @keyframes modalEntrance {
                from { transform: scale(0.9); opacity: 0; }
                to { transform: scale(1); opacity: 1; }
            }
            @keyframes floatBounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-6px); }
            }
            #welcome-promo-floating-timer {
                animation: floatBounce 3s ease-in-out infinite;
                transition: all 0.3s ease;
            }
            #welcome-promo-floating-timer:hover {
                animation-play-state: paused;
                transform: translateY(-4px) scale(1.05) !important;
                box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.4), 0 10px 10px -5px rgba(99, 102, 241, 0.1) !important;
            }
        </style>

        <style>
            {!! core()->getConfigData('general.content.custom_scripts.custom_css') !!}
        </style>

        @if(core()->getConfigData('general.content.speculation_rules.enabled'))
            <script type="speculationrules">
                @json(core()->getSpeculationRules(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            </script>
        @endif

        {!! view_render_event('bagisto.shop.layout.head.after') !!}

    </head>

    <body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KRW3VSDG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        {!! view_render_event('bagisto.shop.layout.body.before') !!}

        <a
            href="#main"
            class="skip-to-main-content-link"
        >
            Skip to main content
        </a>

        <!-- Built With Bagisto -->
        <div id="app">
            <!-- Flash Message Blade Component -->
            <x-shop::flash-group />

            <!-- Confirm Modal Blade Component -->
            <x-shop::modal.confirm />



            <!-- Page Header Blade Component -->
            @if ($hasHeader)
                <x-shop::layouts.header />
            @endif

            @if(
                core()->getConfigData('general.gdpr.settings.enabled')
                && core()->getConfigData('general.gdpr.cookie.enabled')
            )
                <x-shop::layouts.cookie />
            @endif

            {!! view_render_event('bagisto.shop.layout.content.before') !!}

            <!-- Page Content Blade Component -->
            <main id="main" class="bg-white">
                {{ $slot }}
            </main>

            {!! view_render_event('bagisto.shop.layout.content.after') !!}


            <!-- Page Services Blade Component -->
            @if ($hasFeature)
                <x-shop::layouts.services />
            @endif

            <!-- Page Footer Blade Component -->
            @if ($hasFooter)
                <x-shop::layouts.footer />
            @endif
        </div>

        <!-- 1-Minute Highlight Pop-Up Modal (Outside of #app to bypass Vue event/DOM compilation) -->
        <div id="welcome-promo-modal" style="display: none; position: fixed; inset: 0; z-index: 10000; background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px; font-family: 'Poppins', sans-serif;">
            <div style="background: #ffffff; border-radius: 16px; max-width: 500px; width: 100%; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); position: relative; overflow: hidden; animation: modalEntrance 0.4s ease-out;">
                <div style="height: 6px; background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 100%);"></div>
                <div style="padding: 30px; text-align: center;">
                    <div style="width: 60px; height: 60px; background: #e0e7ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 28px; animation: promoPulse 2s infinite;">🎉</div>
                    <h3 style="font-size: 22px; font-weight: 700; color: #1e1b4b; margin: 0 0 10px;">Claim Your Welcome Gift!</h3>
                    <p style="font-size: 14px; color: #4b5563; margin: 0 0 20px; line-height: 1.5;">We're thrilled to have you here. Use coupon code <strong style="color: #4f46e5;">WELCOME1000VIBES</strong> at checkout to get <strong style="color: #10b981;">10% OFF</strong> your order!</p>
                    <div style="display: inline-flex; align-items: center; gap: 10px; background: #f3f4f6; border: 1px dashed #cbd5e1; padding: 10px 20px; border-radius: 8px; font-family: monospace; font-size: 18px; font-weight: 700; color: #1f2937; letter-spacing: 1px; cursor: pointer; margin-bottom: 25px; transition: background 0.2s;" onclick="copyPromoCoupon()" title="Click to copy coupon">
                        <span id="welcome-modal-coupon-badge">WELCOME1000VIBES</span>
                        <span style="font-size: 12px; color: #6b7280; font-family: 'Poppins', sans-serif; font-weight: 500;">(Copy)</span>
                    </div>
                    <div style="background: #faf5ff; border: 1px solid #f3e8ff; border-radius: 12px; padding: 15px; display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 25px;">
                        <span style="font-size: 14px; font-weight: 600; color: #6b21a8;">Offer Expires In:</span>
                        <span id="welcome-modal-timer" style="font-size: 20px; font-weight: 700; color: #7c3aed; font-family: monospace;">60:00</span>
                    </div>
                    <button onclick="dismissPromoModal()" style="width: 100%; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: #ffffff; border: none; padding: 12px; border-radius: 8px; font-weight: 600; font-size: 15px; cursor: pointer; box-shadow: 0 4px 6px rgba(99, 102, 241, 0.2); transition: transform 0.2s, opacity 0.2s;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='none'">Shop Now</button>
                </div>
                <button onclick="dismissPromoModal()" style="position: absolute; top: 15px; right: 15px; background: none; border: none; color: #9ca3af; font-size: 22px; cursor: pointer; line-height: 1; transition: color 0.2s;" onmouseover="this.style.color='#4b5563'" onmouseout="this.style.color='#9ca3af'">&times;</button>
            </div>
        </div>

        <!-- Floating Timer Widget (Bottom Right) (Outside of #app to bypass Vue event/DOM compilation) -->
        <div id="welcome-promo-floating-timer" onclick="showPromoModal()" style="display: none; position: fixed; bottom: 30px; right: 30px; z-index: 9999; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: #ffffff; padding: 10px 18px; border-radius: 30px; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3); cursor: pointer; align-items: center; gap: 8px;">
            <span class="promo-icon" style="animation: promoPulse 1.5s infinite; font-size: 15px; display: inline-block;">⚡</span>
            <span id="welcome-floating-timer-text">00:00</span>
        </div>

        {!! view_render_event('bagisto.shop.layout.body.after') !!}

        @stack('scripts')

        {!! view_render_event('bagisto.shop.layout.vue-app-mount.before') !!}
        <script>
            /**
             * Load event, the purpose of using the event is to mount the application
             * after all of our `Vue` components which is present in blade file have
             * been registered in the app. No matter what `app.mount()` should be
             * called in the last.
             */
            window.addEventListener("load", function (event) {
                app.mount("#app");
                
                if (typeof initWelcomePromoCountdown === "function") {
                    initWelcomePromoCountdown();
                }
            });

            function copyPromoCoupon() {
                const badge = document.getElementById('welcome-modal-coupon-badge');
                if (!badge) return;
                
                const tempInput = document.createElement('input');
                tempInput.value = 'WELCOME1000VIBES';
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                
                const originalText = badge.textContent;
                badge.textContent = 'COPIED!';
                badge.style.backgroundColor = '#10b981';
                badge.style.color = '#ffffff';
                setTimeout(() => {
                    badge.textContent = originalText;
                    badge.style.backgroundColor = '';
                    badge.style.color = '';
                }, 1500);
            }

            function showPromoModal() {
                const modal = document.getElementById('welcome-promo-modal');
                if (modal) {
                    modal.style.display = 'flex';
                }
            }

            function dismissPromoModal() {
                const modal = document.getElementById('welcome-promo-modal');
                if (modal) {
                    modal.style.display = 'none';
                }
            }

            function getPromoCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
            }

            function setPromoCookie(name, value, days) {
                let expires = "";
                if (days) {
                    const date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "")  + expires + "; path=/";
            }

            function initWelcomePromoCountdown() {
                let startTime = getPromoCookie('welcome_promo_start_time');
                if (!startTime) {
                    startTime = Math.floor(Date.now() / 1000).toString();
                    setPromoCookie('welcome_promo_start_time', startTime, 1);
                }

                const modal = document.getElementById('welcome-promo-modal');
                const modalTimerElement = document.getElementById('welcome-modal-timer');
                const floatTimer = document.getElementById('welcome-promo-floating-timer');
                const floatTimerText = document.getElementById('welcome-floating-timer-text');
                if (!modal) return;

                const startTimestamp = parseInt(startTime, 10);
                if (isNaN(startTimestamp)) return;

                function updateTimer() {
                    const nowSeconds = Math.floor(Date.now() / 1000);
                    const elapsed = nowSeconds - startTimestamp;
                    const remainingSeconds = 3600 - elapsed;

                    if (remainingSeconds <= 0 || elapsed < -300) {
                        modal.style.display = 'none';
                        if (floatTimer) floatTimer.style.display = 'none';
                        return;
                    }

                    const minutes = Math.floor(remainingSeconds / 60);
                    const seconds = remainingSeconds % 60;
                    const formattedTime = (minutes < 10 ? '0' + minutes : minutes) + ':' + (seconds < 10 ? '0' + seconds : seconds);
                    
                    if (modalTimerElement) {
                        modalTimerElement.textContent = formattedTime;
                    }
                    if (floatTimerText) {
                        floatTimerText.textContent = formattedTime;
                    }
                    if (floatTimer && floatTimer.style.display === 'none') {
                        floatTimer.style.display = 'flex';
                    }
                }

                updateTimer();
                setInterval(updateTimer, 1000);

                // Timing Triggers: 10s, 1m (60s), 4m (240s), 10m (600s)
                const triggers = [
                    { key: '10s', threshold: 10 },
                    { key: '1m',  threshold: 60 },
                    { key: '4m',  threshold: 240 },
                    { key: '10m', threshold: 600 }
                ];

                let fired = [];
                try {
                    fired = JSON.parse(localStorage.getItem('welcome_promo_fired_triggers') || '[]');
                } catch(e) {
                    fired = [];
                }
                if (!Array.isArray(fired)) fired = [];

                const nowSeconds = Math.floor(Date.now() / 1000);
                const currentElapsed = nowSeconds - startTimestamp;

                triggers.forEach(trigger => {
                    if (fired.includes(trigger.key)) {
                        return;
                    }

                    if (currentElapsed >= trigger.threshold) {
                        if (currentElapsed < 3600) {
                            modal.style.display = 'flex';
                            fired.push(trigger.key);
                            localStorage.setItem('welcome_promo_fired_triggers', JSON.stringify(fired));
                        }
                    } else {
                        const delayMs = (trigger.threshold - currentElapsed) * 1000;
                        setTimeout(() => {
                            let freshFired = [];
                            try {
                                freshFired = JSON.parse(localStorage.getItem('welcome_promo_fired_triggers') || '[]');
                            } catch(e) {
                                freshFired = [];
                            }
                            if (!freshFired.includes(trigger.key)) {
                                modal.style.display = 'flex';
                                freshFired.push(trigger.key);
                                localStorage.setItem('welcome_promo_fired_triggers', JSON.stringify(freshFired));
                            }
                        }, delayMs);
                    }
                });
            }
        </script>

        {!! view_render_event('bagisto.shop.layout.vue-app-mount.after') !!}

        <script type="text/javascript">
            {!! core()->getConfigData('general.content.custom_scripts.custom_javascript') !!}
        </script>
    </body>
</html>
