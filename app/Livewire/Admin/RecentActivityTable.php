<?php

namespace App\Livewire\Admin;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ActivityLog;

class RecentActivityTable extends DataTableComponent
{
    protected $model = ActivityLog::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDisabled();
        $this->setPaginationDisabled();
        $this->setPerPage(10);
        $this->setEagerLoadAllRelationsEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }
}
