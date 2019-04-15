<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

/**
 * User Controller.
 */
class UserController extends Controller
{
    private $userService;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * List users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = $this->userService->list();

        return response()->json($users);
    }

    /**
     * Create the user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required|max:50',
            'phone' => 'required|max:20|numeric|unique:users'
        ]);

        $user = $this->userService->create($request->all());

        return response()->json($user, 201);
    }

    /**
     * Retrieve the user for the given ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = $this->userService->show($id);

        return response()->json($user);
    }

    /**
     * Update the user for the given ID.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $user = $this->userService->update($id, $request->all());

        return response()->json($user, 200);
    }

    /**
     * Destroy the user for the given ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->userService->delete($id);

        return response('Deleted Successfully', 200);
    }
}
