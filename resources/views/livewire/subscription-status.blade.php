@if($subscribed)
    <h1>You are subscribed</h1>
@else
    <div class="mr-2">
        <a href="{{ route('filament.admin.pages.subscription') }}" class="filament-button inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
            <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
            Purchase Subscription
        </a>
    </div>
@endif
