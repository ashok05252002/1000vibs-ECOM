<div class="container mt-20 mb-20 px-[60px] max-1180:px-5 max-md:mt-12 max-md:mb-12">
    <!-- Header -->
    <div class="text-center mb-12">
        <h2 class="font-dmserif text-4xl font-extrabold text-zinc-900 tracking-tight max-md:text-3xl max-sm:text-2xl">
            What Our Customers Say
        </h2>
        <p class="text-base text-zinc-500 mt-2.5 max-sm:text-sm font-poppins">
            Real feedback from our happy customers
        </p>
    </div>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-3 gap-12 max-lg:grid-cols-1 max-lg:gap-10 max-w-6xl mx-auto">
        <!-- Testimonial 1 -->
        <div class="flex flex-col items-center text-center p-6 rounded-2xl transition-all duration-300 hover:scale-[1.03] group">
            <!-- Stars -->
            <div class="flex items-center gap-1 mb-5">
                @for ($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5 text-[#f59e0b] fill-[#f59e0b] filter drop-shadow-[0_1px_1px_rgba(245,158,11,0.2)]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                @endfor
            </div>
            <!-- Quote -->
            <p class="text-zinc-700 italic text-[17px] leading-relaxed mb-6 font-poppins max-sm:text-base">
                "Excellent service and fast delivery. Product quality is top-notch!"
            </p>
            <!-- Name & Designation -->
            <div class="mt-auto">
                <h4 class="text-[#F85156] font-bold text-lg font-poppins">
                    Rahul S.
                </h4>
                <p class="text-zinc-400 text-xs mt-1 uppercase tracking-wider font-semibold font-poppins">
                    Verified Buyer
                </p>
            </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="flex flex-col items-center text-center p-6 rounded-2xl transition-all duration-300 hover:scale-[1.03] group">
            <!-- Stars -->
            <div class="flex items-center gap-1 mb-5">
                @for ($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5 text-[#f59e0b] fill-[#f59e0b] filter drop-shadow-[0_1px_1px_rgba(245,158,11,0.2)]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                @endfor
            </div>
            <!-- Quote -->
            <p class="text-zinc-700 italic text-[17px] leading-relaxed mb-6 font-poppins max-sm:text-base">
                "Very smooth shopping experience. Support team was super helpful."
            </p>
            <!-- Name & Designation -->
            <div class="mt-auto">
                <h4 class="text-[#F85156] font-bold text-lg font-poppins">
                    Aisha M.
                </h4>
                <p class="text-zinc-400 text-xs mt-1 uppercase tracking-wider font-semibold font-poppins">
                    Regular Customer
                </p>
            </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="flex flex-col items-center text-center p-6 rounded-2xl transition-all duration-300 hover:scale-[1.03] group">
            <!-- Stars -->
            <div class="flex items-center gap-1 mb-5">
                @for ($i = 0; $i < 4; $i++)
                    <svg class="w-5 h-5 text-[#f59e0b] fill-[#f59e0b] filter drop-shadow-[0_1px_1px_rgba(245,158,11,0.2)]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                @endfor
                <!-- Empty Star for 4/5 rating -->
                <svg class="w-5 h-5 text-zinc-300 fill-transparent stroke-zinc-300 stroke-[1.5]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
            </div>
            <!-- Quote -->
            <p class="text-zinc-700 italic text-[17px] leading-relaxed mb-6 font-poppins max-sm:text-base">
                "Delivery was on time and packing was perfect. Will order again."
            </p>
            <!-- Name & Designation -->
            <div class="mt-auto">
                <h4 class="text-[#F85156] font-bold text-lg font-poppins">
                    Karthik R.
                </h4>
                <p class="text-zinc-400 text-xs mt-1 uppercase tracking-wider font-semibold font-poppins">
                    Happy Client
                </p>
            </div>
        </div>
    </div>
</div>
