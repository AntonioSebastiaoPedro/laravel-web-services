<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name'];

    public function getResults($name = null, $totalPage)
    {
        if(!$name)
            return $this->paginate($totalPage);

        return $this->where('name', 'LIKE', "%{$name}%")->paginate($totalPage);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
