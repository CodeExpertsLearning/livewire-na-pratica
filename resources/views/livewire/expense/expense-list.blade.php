<div class="max-w-7xl mx-auto py-15 px-4">

    <x-slot name="header">
        Meus Registros
    </x-slot>

    <div class="w-full mx-auto text-right mb-4">
        <a href="{{route('expenses.create')}}" class="flex-shrink-0 bg-green-700 hover:bg-green-900 border-green-700 hover:border-green-900 text-sm border-4 text-white py-2 px-6 rounded">Criar Registro</a>
    </div>

    @include('includes.message')

    <table class="table-auto w-full mx-auto">
        <thead>
        <tr class="text-left">
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Descrição</th>
            <th class="px-4 py-2">Valor</th>
            <th class="px-4 py-2">Data Registro</th>
            <th class="px-4 py-2">Ações</th>
        </tr>
        </thead>

        <tbody>
        @forelse($expenses as $exp)
            <tr>
                <td class="px-4 py-2 border">{{$exp->id}}</td>
                <td class="px-4 py-2 border">{{$exp->description}}</td>
                <td class="px-4 py-2 border">
                    <span class="{{ $exp->type == 1 ? 'text-green-600' : 'text-red-600'}}" >R$ {{number_format($exp->amount, 2, ',', '.')}}</span>
                </td>
                <td class="px-4 py-2 border">{{$exp->expense_date ?
                            $exp->expense_date->format('d/m/Y H:i:s') :
                            $exp->created_at->format('d/m/Y H:i:s')}}</td>

                <td class="px-4 py-4 border">
                    <a href="{{route('expenses.edit', $exp->id)}}" class="px-4 py-2 border rounded bg-teal-700 text-white">Editar</a>
                    <a href="#" wire:click.prevent="remove({{$exp->id}})"
                       class="px-4 py-2 border rounded bg-red-500 text-white">Remover</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Nenhum registro encontrado!!!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="w-full mx-auto mt-10">
        @if(count($expenses))
            {{$expenses->links()}}
        @endif
    </div>
</div>
