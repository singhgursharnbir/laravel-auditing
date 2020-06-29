<?php

namespace OwenIt\Auditing\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Audit extends Model implements \OwenIt\Auditing\Contracts\Audit
{
      use Searchable;

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'audits';
    }
    
    use \OwenIt\Auditing\Audit;

    /**
     * {@inheritdoc}
     */
    protected $guarded = [];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'old_values'   => 'json',
        'new_values'   => 'json',
        // Note: Please do not add 'auditable_id' in here, as it will break non-integer PK models
    ];
    
    
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->searchable();
        });
    }
}
