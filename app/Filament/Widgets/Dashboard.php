<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Dashboard extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            #Change the values depends on the on going projects and completed projects
            Stat::make('Ongoing Projects', value(999))
                ->description('Total number of ongoing projects')
                ->color('orange'),
            Stat::make('Completed Projects', value(999))
                ->description('Total number of completed projects')
                ->color('success'),
            Stat::make('Urgent Deadline', value(999))
                ->description('Urgent project document submission deadline')
                ->color('danger'),
        ];
    }
}
