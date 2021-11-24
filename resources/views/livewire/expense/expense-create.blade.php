<div class="max-w-7xl mx-auto py-15 px-4">

    <x-slot name="header">
        Criar Registro
    </x-slot>

    @include('includes.message')

    <form action="" wire:submit.prevent="createExpense" class="w-full max-w-7xl mx-auto">
        <div class="flex flex-wrap -mx-3 mb-6">

            <p class="w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Descrição Registro</label>
                <input type="text" name="description" wire:model="expense.description"
                       class="block appearance-none w-full bg-gray-200 border @error('expense.description') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            @error('expense.description')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror
            </p>


            <p class="w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Valor do Registro</label>
                <input type="text" name="amount" wire:model="expense.amount"
                       class="block appearance-none w-full bg-gray-200 border @error('expense.amount') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            @error('expense.amount')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror

            </p>


            <p class="w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tipo do Registro</label>
                <select name="type" id="" wire:model="expense.type" class="block appearance-none w-full bg-gray-200 border @error('expense.type') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Selecione o tipo do registro: Entrada ou Saída...</option>
                    <option value="1">Entrada</option>
                    <option value="2">Saída</option>
                </select>

            @error('expense.type')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror
            </p>

            <p
                class="w-full px-3 mb-6"
                x-data
                x-init="Inputmask({'mask': '99/99/9999 99:99:99'}).mask($refs.input)"
            >

                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Data do Comprovante, pode deixar em branco se o dia for hoje.</label>

                <input type="text" name="expense_date" x-ref="input" x-on:change="$dispatch('input', $event.target.value)"
                       class="date block appearance-none w-full bg-gray-200 border border-gray-200  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="expense.expense_date">
            </p>


            <p class="w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Foto Comprovante</label>

                <input type="file" name="photo" wire:model="expense.photo"
                       class="block appearance-none w-full bg-gray-200 border @error('expense.photo') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

                @if(isset($expense['photo']) && $expense['photo'] && !$errors->has('expense.photo'))
                    <img src="{{$expense['photo']->temporaryUrl()}}" alt="" width="150" class="my-3">
                @endif


                @error('expense.photo')
                    <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
                @enderror
            </p>


            @foreach($viewFeatures as $feature)
                @include('plan-features.' . $feature->rule['view'])
            @endforeach

        </div>

        <div class="w-full py-4 px-3 mb-6 md:mb-0">

            <button type="submit"
                    class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Criar Registro</button>

            <div wire:loading wire:target="expense.amount">
                Atualizando valor do registro...
            </div>

            <div wire:loading wire:target="createExpense">
                Salvando Dados...
            </div>

            <div wire:loading.remove>
                Este conteúdo vai sumir quando existir um loading/requisição...
            </div>
        </div>

    </form>

    @push('scripts')
            <script>
                Livewire.hook('element.updated', () => Inputmask({'mask': '99/99/9999 99:99:99'}).mask(document.querySelector('input.date')))
            </script>
{{--        <script>--}}
{{--               elDateInput = document.querySelector('input.date');--}}
{{--               let im = new Inputmask('99/99/9999 99:99:99');--}}
{{--               im.mask(elDateInput);--}}
{{--        </script>--}}
    @endpush
</div>
