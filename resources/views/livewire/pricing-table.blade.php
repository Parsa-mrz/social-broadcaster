<div class="subscription-pricing">
    <section id="pricing" class="py-12 lg:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center mb-12 lg:mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Our Pricing Plan
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($plans as $plan)
                    <div class="filament-card relative bg-[#1a191c] rounded-lg shadow-sm border border-primary-500 p-6 text-center transform transition hover:scale-105 hover:shadow-md">
                        <span class="text-sm font-medium text-gray-400 uppercase tracking-wide block mb-2">
                            {{$plan['name']}}
                        </span>
                        <h2 class="text-3xl font-semibold text-white mb-6 font-mono">
                            {{$plan->currency->icon}}{{ $plan->price }}/{{$plan->interval}}
                        </h2>

                        <div class="mb-6 space-y-1.5">
                            @foreach($plan['features'] as $feature)
                                <p class="text-base text-gray-200 leading-relaxed">
                                    {{ $feature }}
                                </p>
                            @endforeach
                        </div>
                        <div class="mb-8 space-y-2 border-t border-gray-700 pt-4">
                            @foreach($plan['limits'] as $limit)
                                <div class="flex items-center justify-center text-base text-gray-200">
                                    <span class="bg-gray-700 text-gray-200 px-2 py-1 rounded-l-md">
                                        {{ $limit['limit_per_post'] ?? 'Unlimited' }} {{ $limit['social'] }} posts
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div>
                            <x-filament::button wire:click="selectPlan({{ $plan }})">
                                @if(!$plan->is_active)
                                    Plan is not available
                                @else
                                    Purchase Now
                                @endif
                            </x-filament::button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
