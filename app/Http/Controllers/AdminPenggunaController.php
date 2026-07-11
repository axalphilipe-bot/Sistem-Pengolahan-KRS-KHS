<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminPenggunaController extends Controller
{
    private const ROLES = ['admin', 'mahasiswa', 'dosen', 'kps'];

    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%")
                        ->orWhere('nuptk', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengguna', [
            'users' => $users,
            'search' => $search,
            'totalUser' => User::count(),
            'totalAdmin' => User::where('role', 'admin')->count(),
            'totalDosen' => User::where('role', 'dosen')->count(),
            'totalMahasiswa' => User::where('role', 'mahasiswa')->count(),
            'totalKps' => User::where('role', 'kps')->count(),
        ]);
    }

    public function create()
    {
        return view('admin.tambah_pengguna');
    }

    public function store(Request $request)
    {
        $validated = $this->validateUser($request);
        $data = $this->normalizeUserData($validated);
        $data['password'] = Hash::make($validated['password']);

        User::create($data);

        LogAktivitas::catat('Menambahkan pengguna ' . $data['name'] . ' (' . $data['role'] . ')');

        return redirect('/admin/pengguna')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit_pengguna', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $this->validateUser($request, $user);

        $data = $this->normalizeUserData($validated);

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        LogAktivitas::catat('Memperbarui data pengguna ' . $user->name);

        return redirect('/admin/pengguna')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ((int) Auth::id() === (int) $user->id) {
            return redirect('/admin/pengguna')
                ->with('error', 'Tidak dapat menghapus akun yang sedang login.');
        }

        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return redirect('/admin/pengguna')
                ->with('error', 'Tidak dapat menghapus admin terakhir.');
        }

        $nama = $user->name;
        $user->delete();

        LogAktivitas::catat('Menghapus pengguna ' . $nama);

        return redirect('/admin/pengguna')
            ->with('success', 'Pengguna berhasil dihapus.');
    }

    private function validateUser(Request $request, ?User $user = null): array
    {
        $role = $request->input('role');
        $userId = $user?->id;

        $rules = [
            'name' => 'required|string|max:100',
            'role' => ['required', Rule::in(self::ROLES)],
            'status' => 'required|in:aktif,nonaktif',
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8', 'max:255'],
            'no_hp' => 'nullable|string|max:20',
            'prodi' => 'nullable|string|max:50',
            'kelas' => 'nullable|string|max:10',
        ];

        if (in_array($role, ['admin', 'kps'], true)) {
            $rules['email'] = [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($userId),
            ];
        } elseif ($role === 'mahasiswa') {
            $rules['nim'] = [
                'required',
                'string',
                'max:10',
                Rule::unique('users', 'nim')->ignore($userId),
            ];
            $rules['email'] = [
                'nullable',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($userId),
            ];
        } elseif ($role === 'dosen') {
            $rules['nuptk'] = [
                'required',
                'string',
                'max:14',
                Rule::unique('users', 'nuptk')->ignore($userId),
            ];
            $rules['email'] = [
                'nullable',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($userId),
            ];
        }

        return $request->validate($rules);
    }

    private function normalizeUserData(array $validated): array
    {
        $role = $validated['role'];

        $data = [
            'name' => $validated['name'],
            'role' => $role,
            'status' => $validated['status'],
            'email' => null,
            'nim' => null,
            'nuptk' => null,
            'no_hp' => null,
            'prodi' => null,
            'kelas' => null,
        ];

        if (in_array($role, ['admin', 'kps'], true)) {
            $data['email'] = $validated['email'];
        } elseif ($role === 'mahasiswa') {
            $data['nim'] = $validated['nim'];
            $data['email'] = $validated['email'] ?? null;
            $data['no_hp'] = $validated['no_hp'] ?? null;
            $data['prodi'] = $validated['prodi'] ?? null;
            $data['kelas'] = $validated['kelas'] ?? null;
        } elseif ($role === 'dosen') {
            $data['nuptk'] = $validated['nuptk'];
            $data['email'] = $validated['email'] ?? null;
        }

        return $data;
    }
}
