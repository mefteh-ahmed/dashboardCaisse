<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Route;


class HeaderComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
{
    // Title
    $title = config('titles.' . Route::currentRouteName());
    $title = __('admin.titles.' . $title);
    $view->with(compact('breadcrumbs', 'title', 'countNotifications'));
}
}