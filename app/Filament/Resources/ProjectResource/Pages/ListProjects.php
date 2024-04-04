<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\Project;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs() : array {
        return[
            'All' => Tab::make(),
            'Ongoing' => Tab::make()
            ->modifyQueryUsing(function($query){
                $query->where('project_status', 'Ongoing')->whereNull('deleted_at');
            })
            ->badge(Project::query()->where('project_status', 'Ongoing')->whereNull('deleted_at')->count())
            ->badgeColor('primary'),
            'Urgent' => Tab::make()
            ->modifyQueryUsing(function($query){
                $query->where('project_status', 'Urgent')->whereNull('deleted_at');
            })
            ->badge(Project::query()->where('project_status', 'Urgent')->whereNull('deleted_at')->count())
            ->badgeColor('danger'),
            'Completed' => Tab::make()->modifyQueryUsing(function($query){
                $query->where('project_status', 'Completed')->whereNull('deleted_at');
            })
            ->badge(Project::query()->where('project_status', 'Completed')->whereNull('deleted_at')->count())
            ->badgeColor('success'),
            'Archived' => Tab::make()
            ->badge(Project::query()->onlyTrashed()->count())
            ->modifyQueryUsing(function($query){
                $query->onlyTrashed();
            })
            ->badgeColor('warning'),
        ];

    }
}
