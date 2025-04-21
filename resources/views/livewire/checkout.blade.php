<div class="subscription-checkout" xmlns:x-filament="http://www.w3.org/1999/html">
    <section id="checkout" class="py-12 lg:py-24 bg-[#1a191c] min-h-screen text-center">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center mb-12 lg:mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                    Checkout
                </h2>
                <p class="text-gray-400">Complete your purchase for the <span class="font-semibold text-primary-500">{{ $selectedPlan['name'] }}</span> plan.</p>
            </div>


            <div class="max-w-3xl mx-auto bg-[#2a2a2e] p-8 rounded-lg shadow-md border border-primary-500 text-center">
                <div class="mb-6">
                    <h3 class="text-2xl font-semibold text-white mb-2 font-mono">
                        {{ $selectedPlan['currency']['icon'] }}{{ $selectedPlan['price'] }} / {{ $selectedPlan['interval'] }}
                    </h3>
                    <p class="text-gray-300 text-sm">
                        Billed {{ $selectedPlan['interval'] }}. Cancel anytime.
                    </p>
                </div>

                <div class="mb-6 border-t border-gray-700 pt-4">
                    <h4 class="text-lg font-semibold text-gray-300 mb-4">Features Included:</h4>
                    <ul class="space-y-2 text-center">
                        @foreach($selectedPlan['features'] as $feature)
                            <li class="text-base text-gray-200 flex flex-col items-center gap-2">
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-8 border-t border-gray-700 pt-4">
                    <h4 class="text-lg font-semibold text-gray-300 mb-4">Post Limits:</h4>
                    <ul class="space-y-2 text-center">
                        @foreach($selectedPlan['limits'] as $limit)
                            <li class="text-base text-gray-200 flex flex-col items-center gap-2">
                                {{ $limit['limit_per_post'] ?? 'Unlimited' }} {{ $limit['social'] }} posts
                            </li>
                        @endforeach
                    </ul>
                </div>


                <div class="flex flex-col gap-4 justify-center">
                    <x-filament::input.wrapper>
                        <x-filament::input.select
                            wire:model="paymentMethod"
                            placeholder="Select a status"
                        >
                            <option value="">Select Payment Gateway</option>
                            <option value="paypal">PayPal</option>
                            <option value="stripe">Stripe</option>
                            <option value="cod">COD</option>
                        </x-filament::input.select>
                    </x-filament::input.wrapper>

                        <x-filament::button wire:click="subscribe">
                            Confirm Purchase
                        </x-filament::button>
                        <x-filament::button wire:click="cancel">
                            ← Go back to pricing
                        </x-filament::button>
                </div>
            </div>
        </div>
    </section>
</div>
