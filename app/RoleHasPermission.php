<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use DB;

class RoleHasPermission extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = "role_has_permissions";

}
