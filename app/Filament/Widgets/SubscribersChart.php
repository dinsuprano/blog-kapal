<?php

namespace App\Filament\Widgets;

use Firefly\FilamentBlog\Models\NewsLetter;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class SubscribersChart extends ChartWidget
{
    protected static ?string $heading = 'Newsletter Subscribers (Last 12 Months)';
    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $start = now()->subMonths(11)->startOfMonth();

        // Prepare month keys with zero defaults
        $map = [];
        for ($i = 0; $i < 12; $i++) {
            $m = (clone $start)->addMonths($i)->format('Y-m');
            $map[$m] = 0;
        }

        // Fetch counts grouped by month
        $counts = NewsLetter::query()
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as total")
            ->where('created_at', '>=', $start)
            ->where('subscribed', true)
            ->groupBy('ym')
            ->pluck('total', 'ym')
            ->all();

        foreach ($counts as $ym => $total) {
            if (array_key_exists($ym, $map)) {
                $map[$ym] = (int) $total;
            }
        }

        $labels = [];
        $data = [];
        foreach ($map as $ym => $total) {
            $labels[] = Carbon::createFromFormat('Y-m', $ym)->format('M Y');
            $data[] = $total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Subscribers',
                    'data' => $data,
                    'backgroundColor' => 'rgba(16,185,129,0.4)',
                    'borderColor' => 'rgb(16,185,129)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}