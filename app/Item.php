<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Item extends Model
{
    //
    use Searchable;
    private $description;
    private $user_id;
    private $name;
    private $price;
    private $details;
    /**
     * @var bool
     */
    private $is_new;
    private $category_id;



    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'name';
    }


    public function user() {
        return $this->belongsTo('App\User');
    }
}
