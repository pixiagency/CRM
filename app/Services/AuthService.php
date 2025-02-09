<?php

namespace App\Services;

use App\Enums\ActivationStatus;
use App\Exceptions\NotFoundException;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseService
{
    public function __construct(public User $model) {}

    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @throws NotFoundException
     */
    public function loginWithEmailOrPhone(string $identifier, string $password): User|Model
    {
        $identifierField = is_numeric($identifier) ? 'phone' : 'email';
        $credential = [$identifierField => $identifier, 'password' => $password];

        if (!auth()->attempt($credential))
            throw new NotFoundException(__('app.login_failed'));
        return $this->model->where($identifierField, $identifier)->first();
    }

    public function signup(string $name, string $email, string $password): bool
    {
        try {
            $user = $this->getModel()->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            $user->assignRole('sales');
            return true;
        } catch (Exception $e) {
            dd($e);
            throw new Exception(__('app.signup_failed'));
        }
    }

    /**
     * delete existing user
     * @param int $id
     * @return bool
     * @throws NotFoundException
     */
    public function destroy(User $user): bool
    {
        $user->delete();
        return true;
    }

    public function updateProfile(array $data): bool
    {
        $this->model->where('id', Auth::id())->update($data);
        return true;
    }

    public function changePassword(User $user, array $data): bool
    {
        if (!Hash::check($data['old_password'], $user->password))
            throw new Exception(trans('app.not_match'));
        $user->update([
            'password' => bcrypt($data['new_password']),
        ]);
        return true;
    }
}
