<?php

namespace App\Services;

use App\DTO\User\UserDTO;
use App\Enums\AttachmentsType;
use App\Models\Tenant\User;
use App\QueryFilters\UsersFilters;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class UserService extends BaseService
{
    public function __construct(private User $model) {}

    public function getModel(): Model
    {
        return $this->model;
    }

    public function listing(array $filters = [], array $withRelations = [], $perPage = 10): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function queryGet(array $filters = [], array $withRelations = []): builder
    {
        $users = $this->getQuery()->with($withRelations);
        return $users->filter(new UsersFilters($filters));
    }

    public function datatable(array $filters = [], array $withRelations = []): Builder
    {
        return $this->queryGet(filters: $filters, withRelations: $withRelations);
    }

    public function getUsersForSelectDropDown(array $filters = []): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->queryGet(filters: $filters)->select(['id', 'name'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return true
     */
    public function store(UserDTO $userDTO)
    {
        $data = $userDTO->toArray();
        $this->getModel()->create($data);
        return true;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return true
     */
    public function update(UserDTO $userDTO, $id)
    {
        $user = $this->findById($id);
        $data = $userDTO->toArray();
        if (!isset($data['password']))
            $user->update(Arr::except($data, ['password']));
        else
            $user->update($data);
        return true;
    }

    public function updateProfile($id, array $data = [])
    {
        $user = $this->findById($id);
        if (!isset($data['password']))
            $user->update(Arr::except($data, ['password']));
        else {
            $data['password'] = bcrypt($data['password']);
            $user->update($data);
        }
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->findById($id);
        $user->deleteAttachments();
        $user->roles()->detach();
        if (count($user->locations) > 0) {
            $user->locations()->detach();
        }
        $user->delete();
        return true;
    }
}
