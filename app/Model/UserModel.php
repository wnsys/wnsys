<?php
namespace App\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class UserModel extends User
{
    use Authenticatable;
    protected $table = "user";
    protected $fillable = [
        'user_name', 'password'
    ];
    protected $hidden = [

    ];
}
