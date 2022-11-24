<?php

namespace App\Http\Services\Merchant;

use LaravelEasyRepository\Service;
use App\Http\Repositories\Merchant\MerchantRepository;
use App\Models\Role as ModelsRole;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class MerchantServiceImplement extends Service implements MerchantService{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(MerchantRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function create($attributes)
    {
        return DB::transaction(function() use ($attributes) {
            if (isset($attributes['image'])) {
                if (isset($attributes['image']) && $attributes['image']) {
                    $attributes['image'] = $attributes['image']->store('users/merchants');
                }
            }

            $merchant = $this->mainRepository->create($attributes);

            $merchant->user()->update([
                'role_id' => ModelsRole::MERCHANT
            ]);
            $roleMerchant = Role::find(ModelsRole::MERCHANT);
            $merchant->user->syncRoles($roleMerchant);

            return response()->json([
                'message' => 'Merchant has added!',
                'status' => 'success',
                'data' => $merchant
            ], Response::HTTP_CREATED);
        });
    }

    public function update($id, $attributes)
    {
        return DB::transaction(function() use ($attributes, $id) {
            $merchant = $this->mainRepository->findOrFail($id);

            if (isset($attributes['image'])) {
                if (isset($attributes['image']) && $attributes['image']) {
                    if ($merchant->image) {
                        Storage::delete($merchant->image);
                    }
                    $attributes['image'] = $attributes['image']->store('users/merchants');
                }
            }

            $merchant->update($attributes);

            return response()->json([
                'message' => 'Merchant has added!',
                'status' => 'success',
                'data' => $merchant
            ], Response::HTTP_CREATED);
        });
    }

    public function delete($id)
    {
        return DB::transaction(function() use ($id) {
            $merchant = $this->mainRepository->findOrFail($id);
            if ($merchant->image) {
                Storage::delete($merchant->image);
            }

            $merchant->user()->update([
                'role_id' => ModelsRole::CUSTOMER
            ]);
            $roleCustomer = Role::find(ModelsRole::CUSTOMER);
            $merchant->user->syncRoles($roleCustomer);

            $merchant->delete();

            return response()->json([
                'message' => 'Merchant has deleted!',
                'status' => 'success',
                'data' => $merchant
            ], Response::HTTP_CREATED);
        });
    }
}
