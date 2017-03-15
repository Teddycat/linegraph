<?php

namespace Library;

use DB;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    public function graph()
    {
        return $this->hasMany(Graph::class);
    }

}
