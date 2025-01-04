<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Str;

class ModelPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function __call($method, $args)
    {
        $class_name = str_replace('Policy', '', class_basename($this));
        $class_name = Str::plural(strtolower($class_name));
        if ($method === 'viewAny') {
            $method = 'view';
        }
        // parse the method name from camelCase to snake_case with underscores using kebab method
        $ability = $class_name . '.' . Str::kebab($method);
        // dd($ability);
        $user = $args[0];
        if (isset($args[1])) {
            $model = $args[1];
            if ($user->store_id !== $model->store_id) {
                return false;
            }
        }
        return $user->hasAbility($ability);
    }
}
