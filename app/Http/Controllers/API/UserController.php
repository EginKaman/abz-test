<?php

namespace App\Http\Controllers\API;

use App\Actions\Users\CreateUser;
use App\Actions\Users\ResizeAvatar;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return UserCollection
     */
    public function index(Request $request): UserCollection
    {
        return new UserCollection(
            User::query()
                ->with('position')
                ->paginate(perPage: $request->get('count'))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('public/images/users');
            app(ResizeAvatar::class)->resize($photo);
        }
        app(CreateUser::class)->create(array_merge($request->validated(), [
            'photo' => $photo
        ]));

        return response()->json([
            'success' => true
        ]);
    }

    public function show(Request $request, User $user)
    {
        return new UserResource($user->load('position'));
    }
}
