<?php

namespace App\Http\Controllers\API;

use App\Entities\User as UserEntity;
use App\Enums\User\UserType;
use App\Exceptions\EntityException;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Return specific user.
     *
     * @param  User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $user = $this->userRepository->findById($id);
        return response()->json(new UserResource($user), Response::HTTP_OK);
    }

    /**
     * Store a newly user
     *
     * @param  App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $this->userRepository->store($data);
        return response()->json(new UserResource($user), Response::HTTP_CREATED);
    }
}
