<?php

namespace App\Http\Controllers\Pages\User;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\AdminRepository;
use App\Http\Requests\WEB\User\Admin\CreateRequest;
use App\Http\Requests\WEB\User\Admin\UpdateRequest;
use App\Http\Services\Admin\AdminService;
use App\Http\Traits\ErrorFixer;
use App\Http\Traits\MessageFixer;
use App\Models\Role as ModelsRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    use MessageFixer;

    protected $adminService, $adminRepository;

    public function __construct(AdminService $adminService, AdminRepository $adminRepository)
    {
        $this->adminService = $adminService;
        $this->adminRepository = $adminRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('users.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            $image = $request->file->store('users/admins');

            $request->merge([
                'image' => $image,
                'password' => 'password',
                'role_id' => ModelsRole::ADMIN
            ]);

            $user = $this->adminRepository->create($request->all());
            $user->syncRoles(Role::find(ModelsRole::ADMIN));

            return $this->success(route('web.user.admin.index'), 'admin has been created!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = $this->adminService->findOrFail($id);

        return view('users.admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = $this->adminService->findOrFail($id);

        return view('users.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            DB::commit();
            $admin = $this->adminService->findOrFail($id);

            if ($request->hasFile('file')) {
                $image = str_replace(url('storage'), '', $admin->image);
                if ($image) {
                    Storage::delete($image);
                }

                $image = $request->file->store('users/admins');
                $request->merge([
                    'image' => $image,
                ]);
            }

            $this->adminService->update($id, $request->all());

            return $this->success(route('web.user.admin.show', $id), 'admin has been updated!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = $this->adminRepository->findOrFail($id);

        $image = str_replace(url('storage'), '', $admin->image);
        if ($image) {
            Storage::delete($image);
        }

        $admin->delete();
        return $this->success(route('web.user.admin.index'), 'admin has been deleted!');
    }
}
