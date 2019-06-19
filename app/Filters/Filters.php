<?php
namespace App\Filters;

use Illuminate\Http\Request;
use mysql_xdevapi\Collection;

/**
 * Class Filters
 * @package App\Filters
 */
abstract class Filters
{
    /**
     * @var Request
     */
    protected $request, $builder;

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * ThreadFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        $this->getFilters()
            ->filter(function($filter) {
                return method_exists($this, $filter);
            })
            ->each(function($filter, $value) {
                $this->$filter($value);
            });

        return $this->builder;
    }

    /**
     * @return Collection
     */
    protected function getFilters()
    {
        return collect($this->request->only($this->filters))->flip();
    }
}
