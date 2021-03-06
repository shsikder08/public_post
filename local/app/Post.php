<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    
    protected $table = 'posts';

    protected $fillable = ['title','sub_title','content','featured','featured_b','status','featured_text','views','featured_b','caption','category_id','user_id','slug','likes','shares','points'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function category(){
    	
    	return $this->belongsTo('App\Category');
    }
    public function post_category(){
        return $this->hasOne('App\Category','id','category_id');
    }
    public function views(){
        
        return $this->hasMany('App\Views');
    } 
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function user(){
    	
    	return $this->belongsTo('App\User');
    } 
    public function images(){
    	
    	return $this->hasMany('App\Image');
    }  
    public function tags(){
    	
    	return $this->belongsToMany('App\Tag')->withTimestamps();
    }     
    public function favorites(){
        
        return $this->hasMany('App\Favorite');
    }      
    public function newsletters(){
    	
    	return $this->hasMany('App\Newsletter');
    } 
    public function scopeSearch($query, $title){
        $thequery=$query->where('title','like','%'.$title.'%');
        $thequery2= $query->where('title','!=',' ');
        if(count($thequery) > 0){
            return $thequery;
        }else{
            return $thequery2;
        }
    }
}
