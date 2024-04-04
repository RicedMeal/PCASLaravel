<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ProjectsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Projects Chart (Monthly)';

    protected static ?string $maxHeight = '500px';

    protected static ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        $data = Trend::model(Project::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
     
        return [
            'datasets' => [
                [
                    'label' => 'Projects per Month',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public function getDescription(): ?string
    {
    return 'This chart shows the number of projects per month.';
    }
}
