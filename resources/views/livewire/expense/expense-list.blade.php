<div>

    <x-slot name="header">
        Meus Registros
    </x-slot>

    @include('includes.message')

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data Registro</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($expenses as $exp)
            <tr>
                <td>{{$exp->id}}</td>
                <td>{{$exp->description}}</td>
                <td>{{$exp->amount}}</td>
                <td>{{$exp->created_at->format('d/m/Y H:i:s')}}</td>
                <td>
                    <a href="{{route('expenses.edit', $exp->id)}}">Editar</a>
                    <a href="#" wire:click.prevent="remove({{$exp->id}})">Remover</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{$expenses->links()}}
</div>
