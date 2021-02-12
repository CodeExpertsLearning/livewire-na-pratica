<?php

namespace App\Http\Livewire\Plan;

use Livewire\Component;
use App\Models\Plan;

class PlanList extends Component
{
    public $showModal = false;

    protected $listeners = [
        'closeModal'
    ];

    public function openModal($planId)
    {
        $this->emit('openModal', $planId);
        $this->showModal = true;
    }

    public function closeModal($message)
    {
        $this->showModal = false;

        if($message) session()->flash('message', 'Feature criada com sucesso!');
    }

    public function render()
    {
        $plans = Plan::all(['id', 'name', 'price', 'created_at']);

        return view('livewire.plan.plan-list', compact('plans'));
    }
}
