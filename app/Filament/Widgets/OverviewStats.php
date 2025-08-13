<?php


namespace App\Filament\Widgets;

use App\Models\User;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\NewsLetter;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class OverviewStats extends BaseWidget
{
    // protected int|string|array $columnSpan = 1;

    protected function getCards(): array
    {
        return [
            Card::make('Total Users', User::query()->count())
                ->description('All registered users')
                ->icon('heroicon-o-user-group'),
            Card::make('Total Posts', Post::query()->count())
                ->description('All published blog posts')
                ->icon('heroicon-o-document-text'),
            Card::make('Total Subscribers', NewsLetter::query()->count())
                ->description('All total subscribers')
                ->icon('heroicon-o-bell'),
        ];
    }
}