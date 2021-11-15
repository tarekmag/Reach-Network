<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['advertiser_id', 'category_id', 'title', 'description', 'type', 'start_date'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'start_date'];

    protected static function booted()
    {
        static::addGlobalScope('advertiser', function (Builder $builder) {
            if(request()->advertiser_id)
            {
                $builder->where('advertiser_id', request()->advertiser_id);
            }
        });
    }

    /**
     * Get Belongs Advertiser
     */
    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }

    /**
     * Get Belongs Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get Related Tags
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'ads_tags');
    }
}
