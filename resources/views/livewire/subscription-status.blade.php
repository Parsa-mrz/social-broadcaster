@php use Carbon\Carbon; @endphp
@if ($plan)
    <x-filament::dropdown class="w-56">
        <x-slot name="trigger">
            <x-filament::button color="primary" class="w-56 justify-between">
                Active plan : {{ $plan->subscriptionPlan->name }}
            </x-filament::button>
        </x-slot>

        <x-filament::dropdown.list class="w-56">
            <x-filament::dropdown.list.item disabled>
                <strong>Expire time:</strong> {{ Carbon::parse ($plan->end_at)->format ('Y-m-d') }}
            </x-filament::dropdown.list.item>
            <x-filament::dropdown.list.item disabled>
                <ul>
                    @foreach($plan->subscriptionUsages as $usage)
                        <li>
                            <strong>{{ucfirst ($usage->platform)}} : </strong>{{$usage->limit}} post remain
                        </li>
                    @endforeach
                </ul>
            </x-filament::dropdown.list.item>
        </x-filament::dropdown.list>
    </x-filament::dropdown>
@else
        <x-filament::link
            :href="route('filament.admin.pages.subscription')"
            icon="heroicon-m-sparkles"
        >
            Purchase Subscription
        </x-filament::link>
@endif
