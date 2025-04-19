<div class="subscription-checkout">
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

                <form>
                    @csrf
                    <div class="flex flex-col gap-4 justify-center">
                        <button
                            wire:click="subscribe"
                            class="filament-button mt-3 inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white bg-primary-600 rounded-lg hover:bg-gradient-to-r hover:from-primary-600 hover:to-primary-800 transition focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                        >
                            Confirm Purchase
                        </button>
                        <button
                            type="button"
                            wire:click="cancel"
                            class="filament-button inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white bg-primary-600 rounded-lg hover:bg-gradient-to-r hover:from-primary-600 hover:to-primary-800 transition focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                        >
                            ← Go back to pricing
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
