<?php
namespace App\Model\Teacher;
use App\Model\WnModel;
use Illuminate\Database\Eloquent\Model;

class TopicModel extends WnModel
{
    protected $table = "topic";
    protected $fillable = [
        'paper_id', 'type', 'content', 'options', 'answer'
    ];
    protected $hidden = [

    ];
}
