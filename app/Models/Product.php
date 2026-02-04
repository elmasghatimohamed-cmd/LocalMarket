<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'seller_id',
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'stock'
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('is_visible', true); // to get only visible comments
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedByUser() {
    return $this->likes()->where('user_id', auth()->id())->exists();
}




public function getImageUrlAttribute()
{

if (filter_var($this->image, FILTER_VALIDATE_URL)) {
        return $this->image;
    }

    return $this->image 
        ? asset('storage/' . $this->image) 
        : 'https://via.placeholder.com/400';
}


}
