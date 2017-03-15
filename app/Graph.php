<?php

namespace Library;

use DB;
use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{

    public function products()
    {
        return $this->hasMany(Products::class);
    }

    public function getAllOrders()
    {
        return DB::table('clients AS c')
            ->leftJoin('products AS p', 'c.id', '=', 'p.products_client_id')
            ->select('p.products_id', 'c.name', 'p.products_name', 'products_total', 'products_date')
            ->orderBy('c.name')
            ->paginate(5);
    }

    public function getSortOrders($column, $direction)
    {
        return DB::table('clients AS c')
            ->leftJoin('products AS p', 'c.id', '=', 'p.products_client_id')
            ->select('p.products_id', 'c.name', 'p.products_name', 'products_total', 'products_date')
            ->orderBy($column, $direction)
            ->paginate(5);
    }

    public function getSearchOrders($params, $paramWhere)
    {

        return DB::table('clients AS c')
            ->leftJoin('products AS p', 'c.id', '=', 'p.products_client_id')
            ->select('p.products_id', 'c.name', 'p.products_name', 'p.products_total', 'p.products_date')
            ->where($paramWhere, 'LIKE', '%' . $params . '%')
            ->orderBy('c.name')
            ->paginate(5);
    }

    public function getSearchClients($params)
    {
        return DB::table('clients AS c')
            ->leftJoin('products AS p', 'c.id', '=', 'p.products_client_id')
            ->select('p.products_id', 'c.name', 'p.products_name', 'p.products_total', 'p.products_date')
            ->whereRaw("MATCH(c.name) AGAINST ('" . $params . "' IN BOOLEAN MODE) 
        OR MATCH(p.products_name) AGAINST ('" . $params . "' IN BOOLEAN MODE) 
        OR MATCH(p.products_total) AGAINST ('" . $params . "' IN BOOLEAN MODE)
        OR MATCH(p.products_date) AGAINST ('" . $params . "' IN BOOLEAN MODE)")
            //->orderBy('c.name')
            ->paginate(5);
    }

    public function updateOrderDatas($data)
    {
        return DB::table('products')
            ->where('products_id', $data['id'])
            ->limit(1)
            ->update(['products_name' => $data['product'],
                'products_total' => $data['total'],
                'products_date' => $data['date']]);
    }

    public function deleteSelectedOrder($id)
    {
        return DB::table('products')->where(['products_id' => $id])->delete();
    }

}
