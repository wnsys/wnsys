<?php
namespace App\Model\Teacher;
use Illuminate\Database\Eloquent\Model;

class TopicModel extends Model
{
    protected $table = "topic";
    protected $fillable = [
        'paper_id', 'type', 'content', 'options', 'answer'
    ];
    protected $hidden = [

    ];
}
