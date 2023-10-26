<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','category_id','is_active','is_featured','slug','long_description'];
    protected $appends = ['image_url'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function image(){
        return $this->morphOne(File::class,'fileable');
    }
    public function detailImage(){
        return $this->hasOne(File::class,'fileable_id')->where('table_name', 'blogs_detail');
    }
    public function getImageUrlAttribute(){
        if($this->image){
            return $this->image->full_url;
        }else{
            return 'https://randomuser.me/api/portraits/men/85.jpg';
        }
    }
}
