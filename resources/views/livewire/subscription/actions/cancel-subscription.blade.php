<div>

    <div class="block mb-5">
        <a href="" wire:click.prevent="showModal" class="px-5 py-2 bg-red-600 text-white rounded">
            Cancelar Assinatura
        </a>

    </div>

    @include('includes.message')


    <x-jet-confirmation-modal wire:model="showJetstreamModal">
        <x-slot name="title">Confirmar Cancelamento</x-slot>
        <x-slot name="content">Você deseja realmente cancelar sua assinatura?</x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showJetstreamModal')">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click.prevent="cancelSubscription" wire:loading.attr="disabled">
                Confirmar Cancelamento
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
