<?php

namespace App\Livewire\Recruits;

use App\Models\Recruit;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $mentorFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'mentorFilter' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingMentorFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->mentorFilter = '';
        $this->resetPage();
    }

    public function render()
    {
        $recruits = Recruit::query()
            ->with(['mentor', 'createdBy'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->mentorFilter, function ($query) {
                $query->where('mentor_id', $this->mentorFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $mentors = \App\Models\User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['mentor', 'admin', 'owner']);
        })->get(['id', 'name']);

        return view('livewire.recruits.index', [
            'recruits' => $recruits,
            'mentors' => $mentors,
        ])->layout('layouts.app');
    }
}
