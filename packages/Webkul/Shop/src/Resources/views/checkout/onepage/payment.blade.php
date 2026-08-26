{!! view_render_event('bagisto.shop.checkout.onepage.payment_methods.before') !!}

<v-payment-methods
    :methods="paymentMethods"
    :cart="cart"
    @processing="stepForward"
    @processed="stepProcessed"
>
    <x-shop::shimmer.checkout.onepage.payment-method />
</v-payment-methods>

{!! view_render_event('bagisto.shop.checkout.onepage.payment_methods.after') !!}

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-payment-methods-template"
    >
        <div class="mb-7 max-md:last:!mb-0">
            <template v-if="! methods">
                <!-- Payment Method shimmer Effect -->
                <x-shop::shimmer.checkout.onepage.payment-method />
            </template>
    
            <template v-else>
                {!! view_render_event('bagisto.shop.checkout.onepage.payment_method.accordion.before') !!}

                <!-- Accordion Blade Component -->
                <x-shop::accordion class="overflow-hidden !border-b-0 max-md:rounded-lg max-md:!border-none max-md:!bg-gray-100">
                    <!-- Accordion Blade Component Header -->
                    <x-slot:header class="px-0 py-4 max-md:p-3 max-md:text-sm max-md:font-medium max-sm:p-2">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-medium max-md:text-base">
                                @lang('shop::app.checkout.onepage.payment.payment-method')
                            </h2>
                        </div>
                    </x-slot>
    
                    <!-- Accordion Blade Component Content -->
                    <x-slot:content class="mt-6 !p-0 max-md:mt-0 max-md:rounded-t-none max-md:border max-md:border-t-0 max-md:!p-3 sm:max-md:!p-4">
                        <div class="grid grid-cols-1 gap-3 sm:gap-4 md:grid-cols-2">
                            <div 
                                class="relative w-full select-none"
                                v-for="(payment, index) in methods"
                                :key="payment.method"
                            >
                                {!! view_render_event('bagisto.shop.checkout.payment-method.before') !!}

                                <!-- Hidden Native Radio Input -->
                                <input 
                                    type="radio" 
                                    name="payment[method]" 
                                    :value="payment.payment"
                                    :id="payment.method"
                                    :checked="selectedMethod === payment.method"
                                    class="peer sr-only hidden"
                                    style="display: none !important; position: absolute; opacity: 0; pointer-events: none;"
                                    @change="store(payment)"
                                >

                                <label 
                                    :for="payment.method" 
                                    class="relative flex items-center justify-between w-full h-full cursor-pointer rounded-xl sm:rounded-2xl border-2 p-3.5 sm:p-4 transition-all duration-200"
                                    :class="selectedMethod === payment.method ? 'border-navyBlue bg-blue-50/25 shadow-sm ring-1 ring-navyBlue/20' : 'border-zinc-200 bg-white hover:border-zinc-300 hover:bg-zinc-50/40'"
                                    @click="selectMethod(payment)"
                                >
                                    <!-- Left: Image & Titles -->
                                    <div class="flex items-center gap-3 sm:gap-3.5 flex-1 min-w-0 pr-2">
                                        {!! view_render_event('bagisto.shop.checkout.onepage.payment-method.image.before') !!}

                                        <div class="w-12 h-12 sm:w-14 sm:h-14 flex-shrink-0 rounded-xl bg-white border border-zinc-200 p-1.5 flex items-center justify-center shadow-xs overflow-hidden">
                                            <template v-if="payment.method === 'razorpay'">
                                                <div class="w-full h-full flex items-center justify-center bg-[#0c2340] rounded-lg">
                                                    <svg class="w-6 h-6 sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.5 3L7 14H12.5L10 21L18.5 10H13L14.5 3Z" fill="#0ea5e9"/>
                                                    </svg>
                                                </div>
                                            </template>
                                            <template v-else>
                                                <img
                                                    class="max-h-full max-w-full object-contain"
                                                    :src="payment.image"
                                                    :alt="payment.method_title"
                                                    :title="payment.method_title"
                                                />
                                            </template>
                                        </div>

                                        {!! view_render_event('bagisto.shop.checkout.onepage.payment-method.image.after') !!}

                                        <div class="flex-1 min-w-0">
                                            {!! view_render_event('bagisto.shop.checkout.onepage.payment-method.title.before') !!}

                                            <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                                                <h3 class="text-sm sm:text-base font-bold text-gray-900 leading-tight">
                                                    @{{ payment.method_title }}
                                                </h3>

                                                <!-- Prepaid Free Shipping Badge -->
                                                <span 
                                                    v-if="payment.method === 'razorpay'"
                                                    class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-semibold text-emerald-800 border border-emerald-300 shadow-xs"
                                                >
                                                    ⚡ Save ₹120 on Prepaid
                                                </span>

                                                <!-- Partial COD Badge -->
                                                <span 
                                                    v-if="payment.method === 'cashondelivery'"
                                                    class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-semibold text-amber-900 border border-amber-300 shadow-xs"
                                                >
                                                    💳 ₹120 delivery charge to be paid now
                                                </span>
                                            </div>
                                            
                                            {!! view_render_event('bagisto.shop.checkout.onepage.payment-method.title.after') !!}

                                            {!! view_render_event('bagisto.shop.checkout.onepage.payment-method.description.before') !!}

                                            <p class="mt-1 text-xs text-zinc-500 leading-normal line-clamp-1">
                                                <template v-if="payment.method === 'razorpay'">
                                                    UPI, Google Pay, PhonePe, Cards & Netbanking
                                                </template>
                                                <template v-else-if="payment.method === 'cashondelivery'">
                                                    Pay ₹120 delivery charge now to confirm COD
                                                </template>
                                                <template v-else>
                                                    @{{ payment.description }}
                                                </template>
                                            </p> 

                                            {!! view_render_event('bagisto.shop.checkout.onepage.payment-method.description.after') !!}
                                        </div>
                                    </div>

                                    <!-- Right: Custom Radio Selection Indicator -->
                                    <div class="flex-shrink-0 pl-1 pointer-events-none">
                                        <div 
                                            class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-all duration-200"
                                            :class="selectedMethod === payment.method ? 'border-navyBlue bg-navyBlue' : 'border-zinc-300 bg-white'"
                                        >
                                            <span 
                                                v-show="selectedMethod === payment.method"
                                                class="w-2 h-2 rounded-full bg-white block"
                                            ></span>
                                        </div>
                                    </div>
                                </label>

                                {!! view_render_event('bagisto.shop.checkout.payment-method.after') !!}
                            </div>
                        </div>
                    </x-slot>
                </x-shop::accordion>

                {!! view_render_event('bagisto.shop.checkout.onepage.payment_method.accordion.after') !!}
            </template>
        </div>
    </script>

    <script type="module">
        app.component('v-payment-methods', {
            template: '#v-payment-methods-template',

            props: {
                methods: {
                    type: Object,
                    required: true,
                    default: () => null,
                },
                cart: {
                    type: Object,
                    default: () => null,
                },
            },

            emits: ['processing', 'processed'],

            data() {
                return {
                    selectedMethod: this.cart?.payment_method || null,
                };
            },

            watch: {
                cart: {
                    immediate: true,
                    handler(newCart) {
                        if (newCart?.payment_method) {
                            this.selectedMethod = newCart.payment_method;
                        }
                    },
                },
            },

            methods: {
                selectMethod(payment) {
                    this.selectedMethod = payment.method;
                    this.store(payment);
                },

                store(selectedMethod) {
                    this.selectedMethod = selectedMethod.method;

                    this.$emit('processing', 'review');

                    this.$axios.post("{{ route('shop.checkout.onepage.payment_methods.store') }}", {
                            payment: selectedMethod
                        })
                        .then(response => {
                            this.$emit('processed', response.data.cart);

                            // Used in mobile view. 
                            if (window.innerWidth <= 768) {
                                window.scrollTo({
                                    top: document.body.scrollHeight,
                                    behavior: 'smooth'
                                });
                            }
                        })
                        .catch(error => {
                            this.$emit('processing', 'payment');

                            if (error.response?.data?.redirect_url) {
                                window.location.href = error.response.data.redirect_url;
                            }
                        });
                },
            },
        });
    </script>
@endPushOnce
