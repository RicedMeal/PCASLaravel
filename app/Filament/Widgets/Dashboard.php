<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Project;
use Filament\Support\Enums\IconPosition;

class Dashboard extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        $ongoingProjectsCount = Project::where('project_status', 'Ongoing')->count();
        $completedProjectsCount = Project::where('project_status', 'Completed')->count();
        $urgentDeadlineCount = Project::where('project_status', 'Urgent', now())->count();

        return [
            #Change the values depends on the on going projects and completed projects
            Stat::make('Ongoing Projects', value($ongoingProjectsCount))
                ->description('Total number of ongoing projects')
                ->descriptionIcon('heroicon-o-arrow-path-rounded-square', IconPosition::Before)
                ->chart([7, 7, 7, 7, 7, 7, 7, 7])
                ->color('warning'),
            Stat::make('Completed Projects', value($completedProjectsCount))
                ->description('Total number of completed projects')
                ->descriptionIcon('heroicon-o-check-circle', IconPosition::Before)
                ->chart([7, 7, 7, 7, 7, 7, 7, 7])
                ->color('success'),
            Stat::make('Urgent Projects', value($urgentDeadlineCount))
                ->description('Urgent project document submission deadline')
                ->descriptionIcon('heroicon-o-shield-exclamation', IconPosition::Before)
                ->chart([7, 7, 7, 7, 7, 7, 7, 7])
                ->color('danger'),        
        ];
    }
}
