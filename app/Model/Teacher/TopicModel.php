<?php
namespace App\Model\Teacher;
use App\Model\AppModel;
use Illuminate\Database\Eloquent\Model;

class TopicModel extends AppModel
{
    protected $table = "topic";
    protected $fillable = [
        'paper_id', 'type', 'content', 'options', 'answer'
    ];
    protected $hidden = [

    ];
}
