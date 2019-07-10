<?php


namespace App\Filters;


use App\User;
use Illuminate\Http\Request;

abstract class Filters
{

    protected $request, $builder;
    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) { //filter =>by
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
//        return array_filter($this->request->only(is_array($this->filters) ? $this->filters : func_get_args())) ;
        return array_filter($this->request->only(is_array($this->filters) ? $this->filters : func_get_args()));
    }


}


//        collect($this->getFilters())->flip()
//            ->filter(function ($filter) {
//                return method_exists($this,$filter);
//            })
//            ->each(function ($filter , $value) {
//                $this->$filter($value);
//            });