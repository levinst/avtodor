<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContrCatDoc extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contents()
    {
      return $this->hasMany(ContrDoc::class);
    }
}
