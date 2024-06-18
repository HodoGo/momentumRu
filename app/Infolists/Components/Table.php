<?php

namespace App\Infolists\Components;

use Filament\Infolists\Components\Component;

class Table extends Component
{
    protected string $view = 'infolists.components.table';

    public static function make(): static
    {
        return app(static::class);
    }
}
