<?php

namespace app\Filters;

use App\Filters\Filters;
use App\User;

class ThreadFilters extends Filters
{
    protected $filters = ['by', 'popular'];

    /**
     * @param $username
     * @return mixed
     */
    public function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     *  Filter according to most popular thread
     * @return $this
     */

    public function popular()
    {
        $this->builder->getQuery()->orders  = [];
       return $this->builder->orderBy('replies_count', 'desc');
    }
}