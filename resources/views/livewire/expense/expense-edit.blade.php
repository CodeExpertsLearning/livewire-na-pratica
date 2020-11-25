<div>
    <x-slot name="header">
        Criar Registro
    </x-slot>

    @include('includes.message')

    <form action="" wire:submit.prevent="updateExpense">

        <p>
            <label>Descrição Registro</label>
            <input type="text" name="description" class="shadow border-t" wire:model="description">

        @error('description')
            <h5>{{$message}}</h5>
        @enderror
        </p>


        <p>
            <label>Valor do Registro</label>
            <input type="text" name="amount" class="shadow border-t" wire:model="amount">
        @error('amount')
        <h5>{{$message}}</h5>
        @enderror
        </p>


        <p>
            <label>Tipo do Registro</label>
            <select name="type" id="" class="shadow border-t" wire:model="type">
                <option value="">Selecione o tipo do registro: Entrada ou Saída...</option>
                <option value="1">Entrada</option>
                <option value="2">Saída</option>
            </select>

        @error('type')
        <h5>{{$message}}</h5>
        @enderror
        </p>

        <button type="submit">Atualizar Registro</button>
    </form>
</div>
