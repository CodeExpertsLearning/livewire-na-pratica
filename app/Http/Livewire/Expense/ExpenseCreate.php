<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use App\Models\Expense;

class ExpenseCreate extends Component
{
    public $amount;
    public $type;
    public $description;

    protected $rules = [
        'amount' => 'required',
        'type'   => 'required',
        'description' => 'required'
    ];

    public function createExpense()
    {
        $this->validate();

        auth()->user()->expenses()->create([
            'amount' => $this->amount,
            'type'   => $this->type,
            'description' => $this->description,
            'user_id'     => 1
        ]);

        session()->flash('message', 'Registro criado com sucesso!');

        $this->amount = $this->type = $this->description = null;
    }

    public function render()
    {
        return view('livewire.expense.expense-create');
    }
}
