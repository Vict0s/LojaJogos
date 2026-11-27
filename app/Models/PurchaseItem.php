<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseItem extends Model
{
    protected $fillable = ['purchase_id', 'game_id', 'title', 'unit_price', 'quantity'];

    protected function casts(): array
    {
        return ['unit_price' => 'decimal:2'];
    }

    public function purchase(): BelongsTo { return $this->belongsTo(Purchase::class); }
    public function game(): BelongsTo { return $this->belongsTo(Game::class); }
}
