<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 *
 * @package App\Models
 * @property int                                                                  $id
 * @property int                                                                  $user_id
 * @property string                                                               $name
 * @property string|null                                                          $description
 * @property int|null                                                             $parent_category
 * @property int                                                                  $is_private
 * @property \Carbon\Carbon|null                                                  $created_at
 * @property \Carbon\Carbon|null                                                  $updated_at
 * @property string|null                                                          $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $childCategories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Link[]     $links
 * @property-read \App\Models\User                                                $user
 */
class Category extends Model
{
    use SoftDeletes;

    public $table = 'categories';

    public $fillable = [
        'user_id',
        'name',
        'description',
        'parent_category',
        'is_private',
    ];

    /*
     | ========================================================================
     | SCOPES
     */

    /**
     * Scope for the user relation
     *
     * @param     $query
     * @param int $user_id
     * @return mixed
     */
    public function scopeByUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeParentOnly($query)
    {
        return $query->where('parent_category', null);
    }

    /*
     | ========================================================================
     | RELATIONSHIPS
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany('App\Models\Link', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childCategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_category');
    }
}