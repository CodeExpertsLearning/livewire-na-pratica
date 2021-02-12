<?php

namespace App\Http\Livewire\Expense;

use App\Traits\Subscription\SubscriptionTrait;
use Livewire\Component;
use App\Models\Expense;
use Livewire\WithFileUploads;

class ExpenseCreate extends Component
{
    use WithFileUploads, SubscriptionTrait;

    public $expense = [];
    public $categories = [];
//    public $amount;
//    public $type;
//    public $description;
//    public $photo;
//    public $expenseDate;

    protected $rules = [
        'expense.amount' => 'required',
        'expense.type'   => 'required',
        'expense.description' => 'required',
        'expense.photo'       => 'image|nullable'
    ];

    public function createExpense()
    {
        $this->validate();

        if(isset($this->expense['photo']) && $this->expense['photo']) {
            $this->expense['photo'] = $this->expense['photo']->store('expenses-photos', 'public');
        }

//        auth()->user()->expenses()->create([
//            'amount' => $this->amount,
//            'type'   => $this->type,
//            'description' => $this->description,
//            'user_id'     => 1,
//            'photo'       => $this->photo,
//            'expense_date' => $this->expenseDate
//        ]);

        $expense = auth()->user()->expenses()->create($this->expense);

        if(count($this->categories)) {
            $expense->categories()->sync($this->categories);
        }

        session()->flash('message', 'Registro criado com sucesso!');

        $this->reset('expense');
    }

    public function render()
    {
        return view('livewire.expense.expense-create')
            ->with('viewFeatures', $this->loadFeaturesByUserPlan('view'));
    }
}
