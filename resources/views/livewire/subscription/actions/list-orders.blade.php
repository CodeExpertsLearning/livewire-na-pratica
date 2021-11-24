<div>
    <div class="mb-4 border-b border-gray-100">
        Cobranças Realizadas -
        @if(auth()->user()->plan)
            Assinatura Status: <strong class="{{auth()->user()->plan->status != 'ACTIVE' ? 'text-red-600' : 'text-green-600'}}">
                {{auth()->user()->plan->status != 'ACTIVE' ? 'INATIVA' : 'ATIVA'}}
            </strong>
        @endif
    </div>
    <div class="mb-10 border-b border-gray-100">
        <table>
            <thead>
                <tr class="text-left border-b border-gray-200">
                    <th>Código Transação</th>
                    <th>Data Cobrança</th>
                    <th>Valor Cobrado</th>
                </tr>
            </thead>
            <tbody>
            @foreach($listOrders as $order)
                <tr class="text-left border-b border-gray-200">
                    <td class="px-4 py-2">{{$order['code']}}</td>
                    <td class="px-4 py-2">{{date('d/m/Y H:i:s', strtotime($order['lastEventDate']))}}</td>
                    <td class="px-4 py-2">R$ {{number_format($order['amount'], 2, ',', '.')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <div>
        @livewire('subscription.actions.cancel-subscription')
    </div>
</div>
