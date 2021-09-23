<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profileImage()
    {
        if (strpos($this->image, 'https') !== false) {
            return ($this->image) ? $this->image : '/storage/profile/D3jZPThHX9FMJY3x2g532TKefhUqP32ClhOGUY3o.png';
        }
        return ($this->image) ? '/storage/' . $this->image : '/storage/profile/D3jZPThHX9FMJY3x2g532TKefhUqP32ClhOGUY3o.png';
    }
}
