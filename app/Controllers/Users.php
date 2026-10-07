<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index()
    {
        return view('users/index', [
            'title' => 'User Accounts',
            'users' => (new UserModel())->orderBy('full_name')->findAll(),
        ]);
    }

    public function new()
    {
        return view('users/form', [
            'title' => 'New User',
            'user' => null,
            'action' => site_url('users'),
        ]);
    }

    public function create()
    {
        $rules = [
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[120]',
            'role' => 'permit_empty|max_length[50]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new UserModel())->insert($this->userData());

        return redirect()->to('/users')->with('success', 'User added successfully.');
    }

    public function edit(int $id)
    {
        $user = (new UserModel())->find($id);
        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        return view('users/form', [
            'title' => 'Edit User',
            'user' => $user,
            'action' => site_url('users/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);
        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        $rules = [
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[50]|is_unique[users.username,id,' . $id . ']',
            'full_name' => 'required|max_length[120]',
            'role' => 'permit_empty|max_length[50]',
        ];

        $avatar = $this->request->getFile('avatar');
        $hasAvatar = $avatar !== null && $avatar->getError() !== UPLOAD_ERR_NO_FILE;
        if ($hasAvatar) {
            $rules['avatar'] = 'uploaded[avatar]|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|ext_in[avatar,jpg,jpeg,png]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->userData();
        if ($hasAvatar && $avatar->isValid() && ! $avatar->hasMoved()) {
            $data['avatar'] = $this->prepareAvatar($avatar->getTempName(), $avatar->getClientExtension());
        }

        $model->update($id, $data);

        if (isset($data['avatar']) && ! empty($user['avatar'])) {
            $oldAvatar = FCPATH . 'uploads/' . basename($user['avatar']);
            if (is_file($oldAvatar)) {
                unlink($oldAvatar);
            }
        }

        return redirect()->to('/users')->with('success', 'User updated successfully.');
    }

    private function userData(): array
    {
        $role = trim((string) $this->request->getPost('role'));

        return [
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'role' => $role !== '' ? $role : 'Staff',
        ];
    }

    private function prepareAvatar(string $temporaryPath, string $extension): string
    {
        $uploadPath = FCPATH . 'uploads';
        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $extension = strtolower($extension) === 'png' ? 'png' : 'jpg';
        $filename = bin2hex(random_bytes(16)) . '.' . $extension;

        service('image')
            ->withFile($temporaryPath)
            ->fit(300, 300, 'center')
            ->save($uploadPath . '/' . $filename, 85);

        return $filename;
    }
}
