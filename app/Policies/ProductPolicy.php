<?php

namespace App\Policies;

use App\Models\Product;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before($user, $ability)
    {
        // if ($user->super_admin) {
        //     return true;
        // }
    }


    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return  $user->hasAbility('products.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Product $product): bool
    {
        return $user->hasAbility('products.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return  $user->hasAbility('products.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Product $product): bool
    {
        return $user->hasAbility('products.update');// && $product->store_id == $user->store_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Product $product): bool
    {
        return  $user->hasAbility('products.delete') && $product->store_id == $user->store_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Product $product): bool
    {
        return  $user->hasAbility('products.restore') && $product->store_id == $user->store_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Product $product): bool
    {
        return  $user->hasAbility('products.forceDelete') && $product->store_id == $user->store_id;
    }
}
