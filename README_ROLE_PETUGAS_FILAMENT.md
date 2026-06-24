# Pembatasan akses role `petugas` (Filament)

## Yang diinginkan
- Petugas **boleh create & edit** data.
- Petugas **tidak boleh delete** data (baik delete record tunggal maupun bulk).
- Petugas **tidak boleh mengelola tabel `users`/role/permission seperti super admin**.

## Implementasi yang sudah dilakukan
### 1) Menonaktifkan tombol delete untuk role `petugas`
DeleteAction/ delete bulk/ header delete dinonaktifkan dengan kondisi:
- `auth()->user()?->hasRole('petugas') ? null : DeleteAction::make()`

File yang diubah:
- `app/Filament/Resources/Kamars/Tables/KamarsTable.php`
- `app/Filament/Resources/Kamars/Pages/EditKamar.php`
- `app/Filament/Resources/Penghunis/Tables/PenghunisTable.php`
- `app/Filament/Resources/Penghunis/Pages/EditPenghuni.php`
- `app/Filament/Resources/Fasilitas/Tables/FasilitasTable.php`
- `app/Filament/Resources/Fasilitas/Pages/EditFasilitas.php`
- `app/Filament/Resources/TipeKamars/Tables/TipeKamarsTable.php`
- `app/Filament/Resources/TipeKamars/Pages/EditTipeKamar.php`
- `app/Filament/Resources/TransaksiSewas/Tables/TransaksiSewasTable.php`
- `app/Filament/Resources/TransaksiSewas/Pages/EditTransaksiSewa.php`

### 2) Akses “kelola user/role/permission”
Saat ini, dari struktur `app/Filament/Resources`, **tidak ditemukan resource** untuk:
- `UserResource`
- `RoleResource`
- `PermissionResource`

Karena itu, penguncian khusus untuk “kelola user/role/permission” belum bisa diterapkan via Filament resource.

## Cara menggunakan
1. Login sebagai **super admin**.
2. Buat role `petugas` dan assign ke user yang diinginkan.
3. Login sebagai user role `petugas`.
4. Verifikasi:
   - Tombol delete pada daftar (record & bulk) tidak muncul.
   - Tombol delete di halaman edit tidak muncul.
   - Create/Edit tetap tersedia.

## Catatan
Kalau di kemudian hari kamu menambahkan `UserResource/RoleResource/PermissionResource`, perlu ditambahkan guard/authorization tambahan agar petugas tidak bisa mengelola.

