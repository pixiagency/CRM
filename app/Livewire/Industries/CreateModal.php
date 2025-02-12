<?php

namespace App\Livewire\Industries;

use App\DTO\Industry\IndustryDTO;
use App\Models\Industry;
use App\Services\IndustryService;
use Livewire\Component;

class CreateModal extends Component
{

    public $name;

    protected $rule = [
        'name' => 'required'
    ];

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
        ];
    }

    public function save()
    {
        $this->validate();
        $industryDTO = IndustryDTO::fromArray($this->validate());
        app()->make(IndustryService::class)->store($industryDTO);

        $this->reset();

        $this->dispatch('close-modal', ['message' => 'New Industy added!', 'modal' => 'createModal']);
    }
    public function render()
    {
        return view('livewire.industries.create-modal');
    }
}
