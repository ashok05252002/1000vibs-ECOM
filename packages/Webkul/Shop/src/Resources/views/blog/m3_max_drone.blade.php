<x-shop::layouts>
    <x-slot:title>
        M3 Max Drone - My Honest Review & Guide
    </x-slot>

    @push('styles')
    <style>
        .blog-wrapper {
            background-color: #f7f9fa;
            padding: 60px 20px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .blog-container {
            max-width: 850px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 60px 70px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            color: #333;
            line-height: 1.8;
            font-size: 18px;
        }
        .blog-title {
            font-size: 42px;
            font-weight: 800;
            color: #111;
            margin-bottom: 15px;
            line-height: 1.2;
            text-align: center;
        }
        .blog-meta {
            text-align: center;
            color: #666;
            font-size: 15px;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 1px solid #eaeaea;
        }
        .blog-h2 {
            font-size: 28px;
            font-weight: 700;
            color: #222;
            margin-top: 50px;
            margin-bottom: 25px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }
        .blog-h3 {
            font-size: 22px;
            font-weight: 600;
            color: #333;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .blog-text {
            margin-bottom: 25px;
            color: #444;
        }
        .blog-list {
            margin-bottom: 25px;
            padding-left: 20px;
        }
        .blog-list li {
            margin-bottom: 12px;
        }
        
        /* Floating Image Classes - This ensures Text on Left, Image on Right */
        .blog-img-right {
            float: right;
            margin: 10px 0 25px 40px;
            max-width: 320px; /* Restricts the image width perfectly */
            height: auto;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .blog-img-right-large {
            float: right;
            margin: 10px 0 25px 40px;
            max-width: 380px; 
            height: auto;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        /* Clearfix to prevent text wrapping issues below the image */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Special Content Boxes */
        .specs-box {
            background-color: #f8fafc;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
        }
        .pros-cons-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 30px;
        }
        .pro-box {
            background-color: #f0fdf4;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #bbf7d0;
        }
        .con-box {
            background-color: #fef2f2;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #fecaca;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .blog-container {
                padding: 40px 25px;
            }
            .blog-title {
                font-size: 32px;
            }
            /* Stack images on mobile instead of floating */
            .blog-img-right, .blog-img-right-large {
                float: none;
                margin: 20px auto 30px auto;
                display: block;
                max-width: 100%;
            }
            .pros-cons-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @endPush

    <div class="blog-wrapper">
        <div class="blog-container">
            
            <h1 class="blog-title">The Truth About the M3 Max Drone: Is It Worth It?</h1>
            <div class="blog-meta">By Your Friendly Drone Enthusiast • Reading Time: 5 mins</div>

            <!-- First Section: Text wraps on left, Drone Image floats right -->
            <div class="clearfix">
                <img src="{{ asset('images/blog/m3-max-drone/drone.jpg') }}" alt="M3 Max Drone" class="blog-img-right">
                
                <p class="blog-text">If you’ve been browsing online for a budget-friendly drone, you've probably stumbled across the <strong>M3 Max Drone</strong>. With its sleek, foldable design and striking resemblance to some of DJI’s premium models, it's easy to see why it catches so many eyes.</p>
                <p class="blog-text">But before you hit that "Buy Now" button, we need to clear something up: <em>this is not an official DJI drone</em>. In fact, "M3 Max" isn’t even a single official model from one brand. It's a generic name used by several manufacturers to sell highly affordable, entry-level quadcopters.</p>
                
                <h2 class="blog-h2" style="margin-top: 30px;">What’s Actually Under the Hood?</h2>
                <p class="blog-text">When you take it out of the box, the first thing you'll notice is how compact it is. The foldable arms make it incredibly easy to toss into a backpack, and since it usually weighs well under 250 grams, you won't have to worry about heavy regulations in most places.</p>
                
                <ul class="blog-list">
                    <li><strong>Dual Cameras:</strong> Front and bottom camera on many models.</li>
                    <li><strong>Wi-Fi FPV:</strong> Live feed directly to your smartphone.</li>
                    <li><strong>Optical Flow:</strong> Helps hover steadily indoors.</li>
                    <li><strong>Fun Modes:</strong> 360° flips and headless mode.</li>
                </ul>
            </div>

            <!-- Second Section: Specs & Drone 2 Image -->
            <div class="clearfix" style="margin-top: 40px;">
                <img src="{{ asset('images/blog/m3-max-drone/drone 2.jpg') }}" alt="M3 Max Drone Specs" class="blog-img-right-large">

                <h2 class="blog-h2" style="margin-top: 0;">Let’s Talk Specs (And Marketing Fluff)</h2>
                <p class="blog-text">You’re going to see some wild claims on the box. Things like "45-minute flight time" or "8K Camera." Let me give it to you straight:</p>
                
                <div class="specs-box">
                    <h3 class="blog-h3" style="margin-top: 0;">⏱️ Flight Time</h3>
                    <p class="blog-text" style="font-size: 16px; margin-bottom: 25px;">Expect about 12 to 25 minutes per battery. When they say 45 minutes, they usually mean using all included batteries combined.</p>
                    
                    <h3 class="blog-h3">📷 Camera Quality</h3>
                    <p class="blog-text" style="font-size: 16px; margin-bottom: 25px;">That "4K" sticker is digitally interpolated. The native resolution is closer to 720p or 1080p—fine for social media, but not for cinematic shots.</p>
                    
                    <h3 class="blog-h3">📡 Control Range</h3>
                    <p class="blog-text" style="font-size: 16px; margin-bottom: 0;">Keep it close. You’ll get a solid connection for about 80 to 150 meters in a completely open area before it cuts out.</p>
                </div>
            </div>

            <h2 class="blog-h2">Pros & Cons</h2>
            <div class="pros-cons-grid">
                <div class="pro-box">
                    <h3 class="blog-h3" style="margin-top: 0; color: #166534;">👍 What I Loved</h3>
                    <ul class="blog-list" style="color: #166534; font-size: 16px; margin-bottom: 0;">
                        <li>Super affordable (₹2,500 – ₹5,000)</li>
                        <li>Incredibly easy for total beginners</li>
                        <li>Highly portable foldable design</li>
                        <li>Great "crash course" drone to learn on</li>
                    </ul>
                </div>
                <div class="con-box">
                    <h3 class="blog-h3" style="margin-top: 0; color: #991b1b;">👎 The Dealbreakers</h3>
                    <ul class="blog-list" style="color: #991b1b; font-size: 16px; margin-bottom: 0;">
                        <li>No GPS means no reliable "Return-to-Home"</li>
                        <li>Struggles significantly in even light winds</li>
                        <li>Digital stabilization means shaky video</li>
                        <li>Cheaper brushed motors on some variants</li>
                    </ul>
                </div>
            </div>

            <h2 class="blog-h2">My Final Verdict: Should You Buy It?</h2>
            <p class="blog-text">If you've got a budget under ₹5,000 and you're buying your very first drone, <strong>yes, the M3 Max is a reasonable buy.</strong> It’s a fantastic, low-stress way to learn how to fly, master the controls, and have some fun in your backyard without worrying about crashing a ₹50,000 investment.</p>
            <p class="blog-text">However, if you're an aspiring photographer, looking to do commercial work, or want a drone that handles windy conditions at high altitudes, save your money. You'll want to invest in a GPS-enabled drone with a true mechanical gimbal from a recognized brand.</p>

        </div>
    </div>
</x-shop::layouts>
