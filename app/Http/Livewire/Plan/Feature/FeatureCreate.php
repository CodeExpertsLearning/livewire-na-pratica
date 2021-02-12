<?php

namespace App\Http\Livewire\Plan\Feature;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Plan;

class FeatureCreate extends Component
{
    public $feature = [];
    public $plan;
    protected $listeners = [
        'openModal',
    ];

    protected $rules = [
        'feature.name' => 'required',
        'feature.type' => 'required',
        'feature.rule' => 'required',
    ];

    public function openModal($planId)
    {
        $this->plan = Plan::find($planId);
    }

    public function closeModal($message = false)
    {
        $this->plan = null;
        $this->reset('feature');

        $this->emit('closeModal', $message);
    }

    public function addFeature()
    {
        $this->validate();

        $this->feature['slug'] = Str::slug($this->feature['name']);

        $this->plan->features()->create($this->feature);

        $this->closeModal(true);
    }

    public function render()
    {
        return view('livewire.plan.feature.feature-create');
    }
}
