<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\GuestStoreRequest;
use App\Http\Requests\GuestUpdateRequest;
use App\Repositories\GuestRepository;
use Illuminate\Http\JsonResponse;

class GuestController extends BaseController
{
    public function __construct(
        readonly private GuestRepository $repository,
    ) {
    }

    public function index(): JsonResponse
    {
        return $this->success($this->repository->getGuests());
    }

    /**
     * @throws ApiException
     */
    public function show($id): JsonResponse
    {
        return $this->success($this->repository->getGuest((int) $id));
    }

    public function store(GuestStoreRequest $request): JsonResponse
    {
        $guest = $this->repository->createGuest($request->input());

        return $this->success($guest);
    }

    /**
     * @throws ApiException
     */
    public function update(GuestUpdateRequest $request, $id): JsonResponse
    {
        $this->repository->updateGuest((int)$id, $request->input());

        return $this->success([]);
    }

    /**
     * @throws ApiException
     */
    public function destroy($id): JsonResponse
    {
        $this->repository->deleteGuest((int)$id);

        return $this->success([]);
    }
}
