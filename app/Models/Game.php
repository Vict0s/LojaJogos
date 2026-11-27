<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    protected $fillable = ['category_id', 'title', 'slug', 'description', 'platform', 'format', 'price', 'image_url', 'source_url', 'release_date'];
    protected $casts = ['price' => 'decimal:2', 'release_date' => 'date'];
    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function favoritedBy(): BelongsToMany { return $this->belongsToMany(User::class, 'game_user_favorites')->withTimestamps(); }
}
