<!-- Header -->
<h1 class="text-2xl font-medium max-md:py-4 max-md:text-base">
    @lang('shop::app.checkout.onepage.summary.cart-summary')
</h1>

<!-- Cart Items -->
<div class="mt-10 grid border-b border-zinc-200 max-md:mt-3 max-sm:mt-0">
    <div
        class="flex gap-x-4 pb-5 max-md:gap-x-3 max-md:pb-4"
        v-for="item in cart.items"
    >
        {!! view_render_event('bagisto.shop.checkout.onepage.summary.item_image.before') !!}

        <img
            class="h-[90px] max-h-[90px] w-[90px] max-w-[90px] rounded-xl max-md:h-20 max-md:max-h-20 max-md:max-w-20 max-md:rounded-lg"
            :src="item.base_image.small_image_url"
            :alt="item.name"
            width="110"
            height="110"
        />

        {!! view_render_event('bagisto.shop.checkout.onepage.summary.item_image.after') !!}

        <div>
            {!! view_render_event('bagisto.shop.checkout.onepage.summary.item_name.before') !!}

            <p class="text-base text-navyBlue max-md:text-sm max-md:font-medium">
                @{{ item.name }}
            </p>

            {!! view_render_event('bagisto.shop.checkout.onepage.summary.item_name.after') !!}

            <p class="mt-2.5 flex flex-col text-lg font-medium max-md:mt-1 max-md:text-base max-md:font-normal max-sm:text-sm">
                <template v-if="displayTax.prices == 'including_tax'">
                    @lang('shop::app.checkout.onepage.summary.price_&_qty', ['price' => '@{{ item.formatted_price_incl_tax }}', 'qty' => '@{{ item.quantity }}'])
                </template>

                <template v-else-if="displayTax.prices == 'both'">
                    @lang('shop::app.checkout.onepage.summary.price_&_qty', ['price' => '@{{ item.formatted_price_incl_tax }}', 'qty' => '@{{ item.quantity }}'])

                    <span class="text-xs font-normal">
                        @lang('shop::app.checkout.onepage.summary.excl-tax')

                        <span class="font-medium">@{{ item.formatted_total }}</span>
                    </span>
                </template>

                <template v-else>
                    @lang('shop::app.checkout.onepage.summary.price_&_qty', ['price' => '@{{ item.formatted_price }}', 'qty' => '@{{ item.quantity }}'])
                </template>
            </p>
        </div>
    </div>
</div>

<!-- Cart Totals -->
<div class="mb-8 mt-6 grid gap-4 max-md:mb-0 max-sm:mt-4 max-sm:gap-2.5">
    <!-- Sub Total -->
    {!! view_render_event('bagisto.shop.checkout.onepage.summary.sub_total.before') !!}

    <template v-if="displayTax.subtotal == 'including_tax'">
        <div class="flex justify-between text-right">
            <p class="text-base max-sm:text-sm">
                @lang('shop::app.checkout.onepage.summary.sub-total')
            </p>

            <p class="text-base font-medium max-sm:text-sm">
                @{{ cart.formatted_sub_total_incl_tax }}
            </p>
        </div>
    </template>

    <template v-else-if="displayTax.subtotal == 'both'">
        <div class="flex justify-between text-right">
            <p class="text-base max-sm:text-sm">
                @lang('shop::app.checkout.onepage.summary.sub-total-excl-tax')
            </p>

            <p class="text-base font-medium max-sm:text-sm">
                @{{ cart.formatted_sub_total }}
            </p>
        </div>
        
        <div class="flex justify-between text-right">
            <p class="text-base max-sm:text-sm">
                @lang('shop::app.checkout.onepage.summary.sub-total-incl-tax')
            </p>

            <p class="text-base font-medium max-sm:text-sm">
                @{{ cart.formatted_sub_total_incl_tax }}
            </p>
        </div>
    </template>

    <template v-else>
        <div class="flex justify-between text-right">
            <p class="text-base max-sm:text-sm">
                @lang('shop::app.checkout.onepage.summary.sub-total')
            </p>

            <p class="text-base font-medium max-sm:text-sm">
                @{{ cart.formatted_sub_total }}
            </p>
        </div>
    </template>

    {!! view_render_event('bagisto.shop.checkout.onepage.summary.sub_total.after') !!}

    <!-- Discount -->
    {!! view_render_event('bagisto.shop.checkout.onepage.summary.discount_amount.before') !!}

    <div
        class="flex justify-between text-right"
        v-if="cart.discount_amount && parseFloat(cart.discount_amount) > 0"
    >
        <p class="text-base max-sm:text-sm">
            @lang('shop::app.checkout.onepage.summary.discount-amount')
        </p>

        <p class="text-base font-medium max-sm:text-sm">
            @{{ cart.formatted_discount_amount }}
        </p>
    </div>

    {!! view_render_event('bagisto.shop.checkout.onepage.summary.discount_amount.after') !!}

    <!-- Apply Coupon -->
    {!! view_render_event('bagisto.shop.checkout.onepage.summary.coupon.before') !!}

    @include('shop::checkout.coupon')

    {!! view_render_event('bagisto.shop.checkout.onepage.summary.coupon.after') !!}

    <!-- Shipping Rates -->
    {!! view_render_event('bagisto.shop.checkout.onepage.summary.delivery_charges.before') !!}
        
    <div class="flex justify-between text-right">
        <p class="text-base max-sm:text-sm">
            @lang('shop::app.checkout.onepage.summary.delivery-charges')
        </p>

        <p class="text-base font-medium max-sm:text-sm">
            <template v-if="cart.payment_method === 'razorpay'">
                <span class="text-emerald-600 font-bold">FREE (Saved ₹@{{ cart.cod_advance_amount || 120 }} on Prepaid)</span>
            </template>

            <template v-else-if="cart.payment_method === 'cashondelivery' && cart.is_partial_cod">
                <span class="text-amber-800 font-bold">+ @{{ cart.formatted_cod_advance_amount }} (Delivery charge to be paid now)</span>
            </template>

            <template v-else>
                @{{ cart.formatted_shipping_amount }}
            </template>
        </p>
    </div>

    {!! view_render_event('bagisto.shop.checkout.onepage.summary.delivery_charges.after') !!}


    <!-- Taxes -->
    {!! view_render_event('bagisto.shop.checkout.onepage.summary.tax.before') !!}

    <div
        class="flex justify-between text-right"
        v-if="! cart.tax_total"
    >
        <p class="text-base max-md:font-normal max-sm:text-sm">
            @lang('shop::app.checkout.onepage.summary.tax')
        </p>

        <p class="text-lg font-semibold max-sm:text-sm">
            @{{ cart.formatted_tax_total }}
        </p>
    </div>

    <div
        class="flex flex-col gap-2 border-y py-2"
        v-else
    >
        <div
            class="flex cursor-pointer justify-between text-right"
            @click="cart.show_taxes = ! cart.show_taxes"
        >
            <p class="text-base max-md:font-normal max-sm:text-sm">
                @lang('shop::app.checkout.onepage.summary.tax')
            </p>

            <p class="flex items-center gap-1 text-base font-medium max-sm:text-sm">
                @{{ cart.formatted_tax_total }}
                
                <span
                    class="text-xl"
                    :class="{'icon-arrow-up': cart.show_taxes, 'icon-arrow-down': ! cart.show_taxes}"
                ></span>
            </p>
        </div>

        <div
            class="flex flex-col gap-1"
            v-show="cart.show_taxes"
        >
            <div
                class="flex justify-between gap-1 text-right"
                v-for="(amount, index) in cart.applied_taxes"
            >
                <p class="text-sm max-md:font-normal">
                    @{{ index }}
                </p>

                <p class="text-sm font-medium">
                    @{{ amount }}
                </p>
            </div>
        </div>
    </div>

    {!! view_render_event('bagisto.shop.checkout.onepage.summary.tax.after') !!}

    <!-- Cart Grand Total -->
    {!! view_render_event('bagisto.shop.checkout.onepage.summary.grand_total.before') !!}

    <div class="flex justify-between text-right">
        <p class="text-lg font-semibold max-sm:text-sm">
            @lang('shop::app.checkout.onepage.summary.grand-total')
        </p>

        <p class="text-lg font-semibold max-sm:text-sm">
            <template v-if="cart.payment_method === 'cashondelivery' && cart.is_partial_cod">
                @{{ cart.formatted_cod_total_amount }}
            </template>
            <template v-else>
                @{{ cart.formatted_grand_total }}
            </template>
        </p>
    </div>

    {!! view_render_event('bagisto.shop.checkout.onepage.summary.grand_total.after') !!}

    <!-- COD vs Prepaid Breakdown Callout -->
    <div
        v-if="cart.payment_method === 'cashondelivery' && cart.is_partial_cod"
        class="mt-4 rounded-2xl bg-amber-50/90 border-2 border-amber-200 p-3.5 sm:p-4 text-left shadow-sm"
    >
        <div class="flex items-center justify-between text-amber-950 border-b border-amber-200/80 pb-2 mb-2.5">
            <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-1.5">
                <span>🚚</span> COD Payment Summary
            </span>
            <span class="text-xs font-extrabold text-amber-900 bg-amber-100 px-2 py-0.5 rounded-full border border-amber-200">
                Total: @{{ cart.formatted_cod_total_amount }}
            </span>
        </div>
        
        <div class="space-y-2 text-xs sm:text-sm">
            <div class="flex items-center justify-between text-blue-900 bg-blue-50 px-3 py-2 rounded-xl font-bold border border-blue-100 shadow-xs">
                <span class="flex items-center gap-1.5">
                    <span>💳</span> Pay Online Advance Now:
                </span>
                <span class="text-sm sm:text-base font-extrabold text-blue-700">@{{ cart.formatted_cod_advance_amount }}</span>
            </div>

            <div class="flex items-center justify-between text-gray-800 bg-white px-3 py-2 rounded-xl border border-amber-200/70 shadow-xs">
                <span class="flex items-center gap-1.5 font-medium">
                    <span>💵</span> Cash on Delivery at Doorstep:
                </span>
                <span class="font-bold text-gray-950 text-sm sm:text-base">@{{ cart.formatted_cod_balance_amount }}</span>
            </div>
        </div>

        <p class="text-[11px] text-amber-900 mt-2.5 pt-2 border-t border-amber-200/80 leading-relaxed font-medium">
            ℹ️ <strong>@{{ cart.formatted_cod_advance_amount }}</strong> is an extra delivery fee for COD orders paid in advance online now. Pay remaining <strong>@{{ cart.formatted_cod_balance_amount }}</strong> in cash at your doorstep upon arrival.
        </p>
    </div>

    <!-- Prepaid Free Delivery Reward Callout -->
    <div
        v-else-if="cart.payment_method === 'razorpay'"
        class="mt-4 rounded-2xl bg-emerald-50/90 border-2 border-emerald-200 p-3.5 sm:p-4 text-center text-emerald-900 shadow-sm"
    >
        <p class="text-xs sm:text-sm font-bold flex items-center justify-center gap-1 text-emerald-800">
            <span>🎉</span> You're saving ₹@{{ cart.cod_advance_amount || 120 }} with Free Delivery!
        </p>
        <p class="text-[11px] sm:text-xs text-emerald-700 mt-1">
            Zero extra delivery charges. 100% Secure UPI / Card Payment.
        </p>
    </div>
</div>
