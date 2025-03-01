<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ActionHistory;

class ActionHistoryComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $selectedData = null;
    public $isModalOpen = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showDetails($id)
    {
        $this->selectedData = ActionHistory::find($id);
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->selectedData = null;
        $this->isModalOpen = false;
    }

    public function render()
    {
        $histories = ActionHistory::with(['user', 'actionable'])
            ->where(function ($query) {
                if (!empty($this->search)) {
                    $query->where('action', 'like', '%' . $this->search . '%')
                          ->orWhere('actionable_type', 'like', '%' . $this->search . '%');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.action-history-component', compact('histories'));
    }
}
