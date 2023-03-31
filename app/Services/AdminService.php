<?php

namespace App\Services;

use App\Repositories\AdminRepositoryInterface;
use stdClass;

class AdminService
{
    private $repository;

    public function __construct(AdminRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(string $filter = ''): array
    {
        $admins = $this->repository->getAll($filter);

        return convertItemsOfArrayToObject($admins);
    }

    public function findById(string $id): ?object
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): object
    {
        return $this->repository->create($data);
    }

    public function update(string $id, array $data): ?object
    {
        return $this->repository->update($id, $data);
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
