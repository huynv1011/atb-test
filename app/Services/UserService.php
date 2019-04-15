<?php

namespace App\Services;

use App\Models\User;

/**
 * Business logic service of user.
 */
class UserService extends BaseService
{
    /**
     * Get all users.
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function list()
    {
        return User::all();
    }

    /**
     * Create a user.
     * @param array $data Request data.
     * @return User
     */
    public function create($data)
    {
        return User::create($data);
    }

    /**
     * Show a user.
     * @param int $id
     * @return User
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update a user.
     * @param int $id
     * @param array $data
     * @return User
     */
    public function update($id, $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);

        return $user;
    }

    /**
     * Delete a user.
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return User::findOrFail($id)->delete();
    }
}
