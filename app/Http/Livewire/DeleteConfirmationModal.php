<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DeleteConfirmationModal extends Component
{
    public $showModal = false;
    public $deleteFormAction; // URL de acción del formulario de eliminación

    protected $listeners = ['confirmDeletion'];

    public function confirmDeletion($deleteFormAction)
    {
        $this->deleteFormAction = $deleteFormAction;
        $this->dispatchBrowserEvent('show-bootstrap-modal');
        /*$this->showModal = true;*/
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.delete-confirmation-modal');
    }
}
