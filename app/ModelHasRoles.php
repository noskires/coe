<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use DB;

class ModelHasRoles extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $primaryKey = 'id';
    protected $table = "model_has_roles";

}
