<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 18/09/17
 * Time: 8:40 PM
 */

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App
 */
class Post extends Model
{
    use SoftDeletes;

    /**
     * @var array $fillable
     */
    protected $fillable = ['title','content', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
     * @param $title
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }

    /**
     * @return string
     */
    public function getTitleAttribute($value)
    {
        return strtoupper($value);
    }


}