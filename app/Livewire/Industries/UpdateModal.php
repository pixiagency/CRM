<?php

namespace App\Livewire\Industries;

use App\DTO\Industry\IndustryDTO;
use App\Services\IndustryService;
use Livewire\Component;

class UpdateModal extends Component
{

    public $name;

    public function mount()
    {

    }

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

        // Reset form fields
        $this->reset();


        // Close the modal
        $this->dispatch('close-modal', ['message' => 'New Industy added!']);
    }
    public function render()
    {
        return view('livewire.industries.create-modal');
    }
}
