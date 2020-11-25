<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use App\Models\Expense;

class ExpenseList extends Component
{
    public function render()
    {
        $expenses = Expense::paginate(3);

        return view('livewire.expense.expense-list', compact('expenses'));
    }

    public function remove($expense)
    {
        $exp = Expense::find($expense);
        $exp->delete();

        session()->flash('message', 'Registro removido com sucesso!');
    }
}
