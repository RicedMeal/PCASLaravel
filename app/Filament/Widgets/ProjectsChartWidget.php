<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class ProjectsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Projects Chart (Quarterly)';

    protected static ?string $maxHeight = '500px';

    protected static ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Projects',
                    'data' => [0, 10, 5, 2, 21, 30],
                    'backgroundColor' => '#2D349A',
                    'borderColor' => '#9BD0F5',
                ],
                
            ],
            'labels' => ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public function getDescription(): ?string
    {
    return 'This chart shows the number of projects per quarter.';
    }
}
