<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Expense;

class ExpenseList extends Component
{
    use WithPagination;

    protected $queryString = ['search', 'orderBy', 'orderByField', 'take', 'type'];

    public $search;
    public $type;
    public $take;

    public $orderBy = 'DESC';
    public $orderByField = 'created_at';


    public function render()
    {
        $expenses = auth()->user()->expenses()->orderBy($this->orderByField, $this->orderBy); //... ORDER By created_at DESC

        $expenses->when($this->search, function($queryBuilder){
            return $queryBuilder->where('description', 'LIKE', '%' . $this->search . '%');
        });

        $expenses->when($this->type, function($queryBuilder){
            return $queryBuilder->where('type', $this->type);
        });

        $expenses = $this->take ? $expenses->paginate($this->take) : $expenses->get();

        $expenses = auth()->user()->expenses()->count()
            ? $expenses
            : [];

        return view('livewire.expense.expense-list', compact('expenses'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function remove($expense)
    {
        $exp = auth()->user()->expenses()->find($expense);
        $exp->delete();

        session()->flash('message', 'Registro removido com sucesso!');
    }

    public function changeOrder($orderField, $orderBy = null)
    {
        $this->orderByField = $orderField;
        $this->orderBy = $this->orderBy == 'DESC' ? 'ASC' : 'DESC';
    }
}
