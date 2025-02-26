<?php

namespace App\Services\Central;

use Exception;
use Illuminate\Support\Str;
use App\Models\Landlord\User;
use App\Services\BaseService;
use App\Models\Landlord\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Model;

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

    public function signup(string $name, string $tenant, string $email, string $password): bool
{
    try {
        // Create the user
        $user = $this->getModel()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        // Create the tenant
        $tenant_record = Tenant::create([
            'id' => $tenant, // Ensure this matches the primary key of the tenants table
            'name' => $tenant,
            'domain' => $tenant . '.crm.test', // Provide a value for the domain column
            'database' => Str::ulid(), // Generate a unique database name
            'owner_id' => $user->id,
        ]);

        // Create the domain for the tenant
        $tenant_record->domains()->create([
            'domain' => $tenant . '.crm.test', // Ensure this matches the tenant's domain
        ]);

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
