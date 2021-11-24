<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;

class ExpenseMonitor extends Component
{
    public $expenseCount;

    public function mount()
    {
        $this->expenseCount = auth()->user()
                                    ->expenses()
                                    ->whereMonth('expense_date', now())
                                    ->get()
                                    ->groupBy('type')
                                    ->map(function($line) {
                                        return $line->reduce(function($carry, $line){
                                            return $carry + $line->amount;
                                        });
                                    }) //collection -> [1 => total_amount, 2 => total_amount]
                                    ->toArray();
    }

    public function showBalance()
    {
        $income = $this->expenseCount[1]??=0;
        $expense = $this->expenseCount[2]??=0;

        return $income - $expense;
    }

    public function render()
    {
        $showBalance = $this->showBalance();

        return view('livewire.expense.expense-monitor', compact('showBalance'));
    }
}
