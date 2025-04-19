<div>
    @if (!$selectedPlan)
        <livewire:pricing-table />
    @else
        <livewire:checkout :selected-plan="$selectedPlan" />
    @endif
</div>
