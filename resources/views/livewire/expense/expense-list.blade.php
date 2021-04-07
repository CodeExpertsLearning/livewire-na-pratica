<div class="max-w-7xl mx-auto py-15 px-4">

    <x-slot name="header">
        Meus Registros
    </x-slot>

    <div class="w-full mx-auto text-right mb-4">
        <a href="{{route('expenses.create')}}" class="flex-shrink-0 bg-green-500 hover:bg-green-900 border-green-700 hover:border-green-900 text-sm border font-bold text-white py-2 px-6 rounded">Criar Registro</a>
    </div>

    @include('includes.message')

    <div class="flex justify-between my-5 pt-5 pb-3 border-b">
        <div class="type">
            <span>Carregar</span>
            <select name="" id="" wire:model="take" class="border rounded py-2 px-4">
                <option value="">Carregar Todos</option>
                <option value="10">10 por página</option>
                <option value="30">30 por página</option>
            </select>
        </div>

        <div class="type">
            <span>Por Tipo</span>
            <select name="" id="" wire:model="type" class="border rounded py-2 px-4">
                <option value="">Todos os Tipos</option>
                <option value="1">Entrada</option>
                <option value="2">Saída</option>
            </select>
        </div>

        <div class="search">
            <span>Buscar</span>
            <input type="text" wire:model="search" class="border rounded py-2 px-4" placeholder="Encontre na tabela...">
        </div>

    </div>


    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <button wire:click="changeOrder('id')">
                                    #

                                    @if($orderByField == 'id')

                                        {!! $orderBy == 'DESC' ? '&uarr;' : '&darr;' !!}
                                    @endif
                                </button>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descrição
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <button wire:click="changeOrder('amount')">
                                    Valor

                                    @if($orderByField == 'amount')

                                        {!! $orderBy == 'DESC' ? '&uarr;' : '&darr;' !!}
                                    @endif
                                </button>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <button wire:click="changeOrder('created_at')">
                                    Criado Em

                                    @if($orderByField == 'created_at')

                                        {!! $orderBy == 'DESC' ? '&uarr;' : '&darr;' !!}
                                    @endif
                                </button>
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">


                        @foreach($expenses as $exp)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{$exp->id}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{$exp->description}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        <span class="{{ $exp->type == 1 ? 'text-green-600' : 'text-red-600'}}" >R$ {{number_format($exp->amount, 2, ',', '.')}}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{
                                        $exp->expense_date ?
                                        $exp->expense_date->format('d/m/Y H:i:s') :
                                        $exp->created_at->format('d/m/Y H:i:s')
                                        }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{route('expenses.edit', $exp->id)}}" class="px-4 py-2 border border-teal-900 hover:bg-teal-300 rounded bg-teal-700 text-white uppercase text-xs font-bold">Editar</a>
                                    <a href="#" wire:click.prevent="remove({{$exp->id}})"
                                       class="px-4 py-2 border border-red-700 rounded bg-red-500 hover:bg-red-300 text-white uppercase text-xs font-bold">Remover</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mx-auto mt-10">
        @if($take)
            {{$expenses->links()}}
        @endif
    </div>
</div>
