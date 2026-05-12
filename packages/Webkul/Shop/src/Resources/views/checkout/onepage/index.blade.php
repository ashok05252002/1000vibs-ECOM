<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('shop::app.checkout.onepage.index.checkout')"/>

    <meta name="keywords" content="@lang('shop::app.checkout.onepage.index.checkout')"/>
@endPush

<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.checkout.onepage.index.checkout')
    </x-slot>

    {!! view_render_event('bagisto.shop.checkout.onepage.header.before') !!}

    <!-- Page Header -->
    <div class="flex-wrap">
        <div class="flex w-full justify-between border border-b border-l-0 border-r-0 border-t-0 px-[60px] py-4 max-lg:px-8 max-sm:px-4">
            <div class="flex items-center gap-x-14 max-[1180px]:gap-x-9">
                <a
                    href="{{ route('shop.home.index') }}"
                    class="flex min-h-[30px]"
                    aria-label="@lang('shop::checkout.onepage.index.bagisto')"
                >
                    <img
                        src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                        alt="{{ config('app.name') }}"
                        width="131"
                        height="29"
                    >
                </a>
            </div>

            @guest('customer')
                @include('shop::checkout.login')
            @endguest
        </div>
    </div>

    {!! view_render_event('bagisto.shop.checkout.onepage.header.after') !!}

    <!-- Page Content -->
    <div class="container px-[60px] max-lg:px-8 max-sm:px-4">

        {!! view_render_event('bagisto.shop.checkout.onepage.breadcrumbs.before') !!}

        <!-- Breadcrumbs -->
        @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
            <x-shop::breadcrumbs name="checkout" />
        @endif

        {!! view_render_event('bagisto.shop.checkout.onepage.breadcrumbs.after') !!}

        <!-- Checkout Vue Component -->
        <v-checkout>
            <!-- Shimmer Effect -->
            <x-shop::shimmer.checkout.onepage />
        </v-checkout>
    </div>

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-checkout-template"
        >
            <template v-if="! cart">
                <!-- Shimmer Effect -->
                <x-shop::shimmer.checkout.onepage />
            </template>

            <template v-else>
                <div class="grid grid-cols-[1fr_auto] gap-8 max-lg:grid-cols-[1fr] max-md:gap-5">
                    <!-- Included Checkout Summary Blade File For Mobile view -->
                    <div class="hidden max-md:block">
                        @include('shop::checkout.onepage.summary')
                    </div>

                    <div
                        class="overflow-y-auto max-md:grid max-md:gap-4"
                        id="steps-container"
                    >
                        <!-- Included Addresses Blade File -->
                        <template v-if="['address', 'shipping', 'payment', 'review'].includes(currentStep)">
                            @include('shop::checkout.onepage.address')
                        </template>

                        <!-- Included Shipping Methods Blade File -->
                        <template v-if="cart.have_stockable_items && ['shipping', 'payment', 'review'].includes(currentStep)">
                            @include('shop::checkout.onepage.shipping')
                        </template>

                        <!-- Included Payment Methods Blade File -->
                        <template v-if="['payment', 'review'].includes(currentStep)">
                            @include('shop::checkout.onepage.payment')
                        </template>
                    </div>

                    <!-- Included Checkout Summary Blade File For Desktop view -->
                    <div class="sticky top-8 block h-max w-[442px] max-w-full max-lg:w-auto max-lg:max-w-[442px] ltr:pl-8 max-lg:ltr:pl-0 rtl:pr-8 max-lg:rtl:pr-0">
                        <div class="block max-md:hidden">
                            @include('shop::checkout.onepage.summary')
                        </div>

                        <div
                            class="flex justify-end"
                            v-if="canPlaceOrder"
                        >
                            <template v-if="cart.payment_method == 'paypal_smart_button'">
                                {!! view_render_event('bagisto.shop.checkout.onepage.summary.paypal_smart_button.before') !!}

                                <!-- Paypal Smart Button Vue Component -->
                                <v-paypal-smart-button></v-paypal-smart-button>

                                {!! view_render_event('bagisto.shop.checkout.onepage.summary.paypal_smart_button.after') !!}
                            </template>

                            <template v-else>
                                <x-shop::button
                                    type="button"
                                    class="primary-button w-max rounded-2xl bg-navyBlue px-11 py-3 max-md:mb-4 max-md:w-full max-md:max-w-full max-md:rounded-lg max-sm:py-1.5"
                                    :title="trans('shop::app.checkout.onepage.summary.place-order')"
                                    ::disabled="isPlacingOrder"
                                    ::loading="isPlacingOrder"
                                    @click="placeOrder"
                                />
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Exit Intent Popup -->
                <v-exit-intent-popup :cart="cart"></v-exit-intent-popup>
            </template>
        </script>

        <script
            type="text/x-template"
            id="v-exit-intent-popup-template"
        >
            <x-shop::modal ref="exitIntentModal">
                <x-slot:header>
                    <div class="flex flex-col items-center text-center p-4">
                        <h2 class="text-3xl font-bold text-navyBlue mb-2">Wait! Don't Leave Yet!</h2>
                        <p class="text-lg text-gray-600">We have a special gift for you.</p>
                    </div>
                </x-slot>

                <x-slot:content>
                    <div class="flex flex-col items-center text-center p-6 bg-blue-50 rounded-2xl">
                        <div class="mb-4">
                            <span class="text-5xl">🎁</span>
                        </div>
                        <p class="text-xl font-medium mb-4">
                            Apply coupon <span class="bg-navyBlue text-white px-3 py-1 rounded font-bold">VIBE1000</span> and get 
                            <span class="text-2xl font-bold text-red-600 block my-2">5% OFF EXTRA!</span>
                            <span class="text-sm text-navyBlue font-semibold" v-if="discountAmount > 0">
                                (You save approx. @{{ formattedDiscountAmount }})
                            </span>
                        </p>
                        <p class="text-sm text-gray-500 italic">This exclusive offer is only available right now!</p>
                    </div>
                </x-slot>

                <x-slot:footer>
                    <div class="flex flex-col w-full gap-4 items-center">
                        <x-shop::button
                            class="primary-button w-full rounded-2xl py-4 text-xl font-bold uppercase tracking-wider"
                            title="Apply Discount Now"
                            @click="applyAndClose"
                        />
                        
                        <button 
                            type="button"
                            class="text-gray-400 hover:text-gray-600 transition-colors underline text-sm"
                            @click="$refs.exitIntentModal.toggle()"
                        >
                            No thanks, I'll pay full price
                        </button>
                    </div>
                </x-slot>
            </x-shop::modal>
        </script>

        <script type="module">
            app.component('v-checkout', {
                template: '#v-checkout-template',

                data() {
                    return {
                        cart: null,

                        displayTax: {
                            prices: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_prices') }}",

                            subtotal: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_subtotal') }}",
                            
                            shipping: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_shipping_amount') }}",
                        },

                        isPlacingOrder: false,

                        currentStep: 'address',

                        shippingMethods: null,

                        paymentMethods: null,

                        canPlaceOrder: false,
                    }
                },

                mounted() {
                    this.getCart();
                },

                methods: {
                    getCart() {
                        this.$axios.get("{{ route('shop.checkout.onepage.summary') }}")
                            .then(response => {
                                this.cart = response.data.data;

                                this.scrollToCurrentStep();
                            })
                            .catch(error => {});
                    },

                    stepForward(step) {
                        this.currentStep = step;

                        if (step == 'review') {
                            this.canPlaceOrder = true;

                            return;
                        }

                        this.canPlaceOrder = false;

                        if (this.currentStep == 'shipping') {
                            this.shippingMethods = null;
                        } else if (this.currentStep == 'payment') {
                            this.paymentMethods = null;
                        }
                    },

                    stepProcessed(data) {
                        if (this.currentStep == 'shipping') {
                            this.shippingMethods = data;
                        } else if (this.currentStep == 'payment') {
                            this.paymentMethods = data;
                        }

                        this.getCart();
                    },

                    scrollToCurrentStep() {
                        let container = document.getElementById('steps-container');

                        if (! container) {
                            return;
                        }

                        container.scrollIntoView({
                            behavior: 'smooth',
                            block: 'end'
                        });
                    },

                    placeOrder() {
                        this.isPlacingOrder = true;

                        this.$axios.post('{{ route('shop.checkout.onepage.orders.store') }}')
                            .then(response => {
                                if (response.data.data.redirect) {
                                    window.location.href = response.data.data.redirect_url;
                                } else {
                                    window.location.href = '{{ route('shop.checkout.onepage.success') }}';
                                }

                                this.isPlacingOrder = false;
                            })
                            .catch(error => {
                                this.isPlacingOrder = false

                                this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message });
                            });
                    }
                },
            });

            app.component('v-exit-intent-popup', {
                template: '#v-exit-intent-popup-template',

                props: ['cart'],

                data() {
                    return {
                        shown: false,

                        lastScrollTop: 0,
                    }
                },

                computed: {
                    discountAmount() {
                        if (! this.cart || ! this.cart.sub_total) return 0;

                        return (parseFloat(this.cart.sub_total) * 0.05);
                    },

                    formattedDiscountAmount() {
                        if (! this.discountAmount) return '';

                        // Simple formatting, ideally use a currency helper if available
                        let symbol = this.cart.formatted_sub_total.replace(/[0-9.,\s]/g, '');
                        return symbol + this.discountAmount.toFixed(2);
                    }
                },

                mounted() {
                    /**
                     * Mouse leave top detection (Desktop)
                     */
                    document.addEventListener('mouseleave', this.handleMouseLeave);

                    /**
                     * Back button detection (Mobile/Desktop)
                     */
                    history.pushState(null, null, window.location.href);
                    window.addEventListener('popstate', this.handlePopState);

                    /**
                     * Visibility change (Mobile/Desktop - Tab switching)
                     */
                    document.addEventListener('visibilitychange', this.handleVisibilityChange);

                    /**
                     * Rapid scroll up detection (Mobile)
                     */
                    window.addEventListener('scroll', this.handleScroll);
                },

                beforeUnmount() {
                    document.removeEventListener('mouseleave', this.handleMouseLeave);
                    window.removeEventListener('popstate', this.handlePopState);
                    document.removeEventListener('visibilitychange', this.handleVisibilityChange);
                    window.removeEventListener('scroll', this.handleScroll);
                },

                methods: {
                    handleMouseLeave(e) {
                        if (this.shown || (this.cart && this.cart.coupon_code)) return;

                        if (e.clientY <= 0) {
                            this.showPopup();
                        }
                    },

                    handlePopState() {
                        if (this.shown || (this.cart && this.cart.coupon_code)) return;

                        this.showPopup();
                        
                        // Push state again so they stay on the page
                        history.pushState(null, null, window.location.href);
                    },

                    handleVisibilityChange() {
                        if (document.visibilityState === 'visible') {
                            if (this.shown || (this.cart && this.cart.coupon_code)) return;
                            
                            // Optional: delay slightly to let the user settle back
                            setTimeout(() => {
                                if (document.visibilityState === 'visible') {
                                    this.showPopup();
                                }
                            }, 500);
                        }
                    },

                    handleScroll() {
                        let st = window.pageYOffset || document.documentElement.scrollTop;
                        
                        // Detect rapid scroll up near the top (within 100px of top)
                        if (st < this.lastScrollTop && st < 100) {
                            let diff = this.lastScrollTop - st;
                            
                            if (diff > 25) { // Rapid scroll threshold
                                if (! this.shown && ! (this.cart && this.cart.coupon_code)) {
                                    this.showPopup();
                                }
                            }
                        }
                        
                        this.lastScrollTop = st <= 0 ? 0 : st;
                    },

                    showPopup() {
                        this.shown = true;
                        this.$refs.exitIntentModal.toggle();
                    },

                    applyAndClose() {
                        this.$emitter.emit('apply-coupon', 'VIBE1000');
                        this.$refs.exitIntentModal.toggle();
                    }
                }
            });
        </script>
    @endPushOnce
</x-shop::layouts>
