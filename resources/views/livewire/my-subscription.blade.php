<div>
    <x-jet-action-section>

        <x-slot name="title">
            Minha Assinatura
        </x-slot>

        <x-slot name="description">
            Configurações de sua assinatura
        </x-slot>

        <x-slot name="content">
            @livewire('subscription.actions.list-orders')
        </x-slot>

    </x-jet-action-section>
</div>
