<?php

namespace App\Policies;

use App\Models\Stu_Marks_T3;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StuMarksT3Policy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Stu_Marks_T3 $stuMarksT3): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Stu_Marks_T3 $stuMarksT3): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Stu_Marks_T3 $stuMarksT3): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Stu_Marks_T3 $stuMarksT3): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Stu_Marks_T3 $stuMarksT3): bool
    {
        return false;
    }
}
