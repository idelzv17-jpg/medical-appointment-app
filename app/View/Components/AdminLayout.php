<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    public function __construct(
        public string $title = '',
        public $breadcrumbs = [],
    ) {
        if ($this->title === '') {
            $this->title = config('app.name', 'Laravel');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.admin', [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }
}