<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image',
    ];

    public function getResults($data, $totalPage)
    {
        if(!isset($data['filter']) && !isset($data['name']) && !isset($data['description']))
            return $this->paginate($totalPage);

        return $this->where(function($query) use ($data){
                    if(isset($data['filter'])){
                        $filter = $data['filter'];
                        $query->where('name', 'LIKE', $filter);
                        $query->orWhere('description', 'LIKE', "%{$filter}%");
                    }

                    if(isset($data['description'])){
                        $description = $data['description'];
                        $query->where('description', 'LIKE', "%{$description}%");
                    }

                    if(isset($data['name'])){
                        $name = $data['name'];
                        $query->where('name', 'LIKE', "%{$name}%");
                    }
                })->paginate();
    }
}
