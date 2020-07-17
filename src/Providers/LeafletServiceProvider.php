<?php namespace Noonenew\LaravelGanttChart\Providers;

use Noonenew\LaravelGanttChart\Builder;
use Illuminate\Support\ServiceProvider;

class GanttChartServiceProvider extends ServiceProvider
{

    /**
     * Array with colours configuration of the chartjs config file
     * @var array
     */
    protected $colours = [];

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'gantt-template');
        $this->colours = config('ganttchart.colours');
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ganttchart', function() {
            return new Builder();
        });
    }
}
