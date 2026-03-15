<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{

protected $table = 'tbl_history';

protected $primaryKey = 'historyid';

public $timestamps = false;

protected $fillable = [
'userid',
'actionType',
'timestamp'
];

}