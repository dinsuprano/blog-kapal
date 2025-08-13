<?php

namespace App\Filament\Widgets;

use Firefly\FilamentBlog\Models\Post;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class PostsChart extends ChartWidget
{
    protected static ?string $heading = 'Posts Published (Last 12 Months)';
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
        $counts = Post::query()
            ->selectRaw("DATE_FORMAT(published_at, '%Y-%m') as ym, COUNT(*) as total")
            ->where('published_at', '>=', $start)
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
                    'label' => 'Posts',
                    'data' => $data,
                    'backgroundColor' => 'rgba(59,130,246,0.4)',
                    'borderColor' => 'rgb(59,130,246)',
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