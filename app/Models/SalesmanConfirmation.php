<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesmanConfirmation extends Model
{
    use HasFactory;
    protected $guarded = [];   

    public function changeStatus($value)
    {
        $this->status_id = $value;
        $this->save();
    }
    public function owner()
    {
        return User::where('id', $this->user_id)->get()->first();
    }

}
