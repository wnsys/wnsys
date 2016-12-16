<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class TopicModel extends Model
{
    protected $table = "user";
    protected $fillable = [
        'user_name', 'password'
    ];
    protected $hidden = [

    ];
}
