<?php

namespace App\Livewire\Industries;

use Livewire\Component;

class SearchModal extends Component
{
    public $filters = [];

    public function search()
    {
        $this->dispatch('refreshDatatable', $this->filters);
    }
    public function resetfields()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.industries.search-modal');
    }
}
