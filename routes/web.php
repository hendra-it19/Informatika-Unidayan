<?php

use App\Http\Controllers\AkunMahasiswaController;
use App\Http\Controllers\AkunOrganisasiController;
use App\Http\Controllers\AkunStaffController;
use App\Http\Controllers\Alumni\AlumniController;
use App\Http\Controllers\Alumni\KarirAlumniController;
use App\Http\Controllers\Alumni\ShareJobsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Kegiatan\KategoriKegiatanProdiController;
use App\Http\Controllers\Kegiatan\KegiatanProdiController;
use App\Http\Controllers\KpMbkm\KampusMerdekaMahasiswaController;
use App\Http\Controllers\KpMbkm\KerjaPraktekAdminController;
use App\Http\Controllers\KpMbkm\KerjaPraktekMahasiswaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\Organisasi\KegiatanOrganisasiController;
use App\Http\Controllers\PenetapanBembimbingTugasAkhirController;
use App\Http\Controllers\PengaturanAkunController;
use App\Http\Controllers\SliderImageController;
use App\Http\Controllers\TugasAkhir\BimbinganTugasAkhirController;
use App\Http\Controllers\TugasAkhir\PemeriksaanTugasAkhirController;
use App\Http\Controllers\TugasAkhir\PengajuanTugasAkhirController;
use App\Http\Controllers\TugasAkhir\TugasAkhirController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'beranda']);
Route::get('/kegiatan', [LandingPageController::class, 'kegiatan']);
Route::get('/kegiatan/{slug}', [LandingPageController::class, 'kegiatanDetail']);
Route::get('/alumni', [LandingPageController::class, 'alumni']);
Route::get('/karir', [LandingPageController::class, 'karir']);
Route::get('/tentang-kami', [LandingPageController::class, 'tentangKami']);
Route::get('/daftar-organisasi', [LandingPageController::class, 'daftarOrganisasi']);
Route::get('/daftar-organisasi/{slug}', [LandingPageController::class, 'daftarOrganisasiDetail'])->name('daftar-organisasi.detail');
Route::get('/kegiatan-organisasi', [LandingPageController::class, 'kegiatanOrganisasi'])->name('daftar-organisasi.kegiatan');
Route::get('/kegiatan-organisasi/{slug}', [LandingPageController::class, 'kegiatanOrganisasiDetail'])->name('daftar-organisasi.kegiatanDetail');

Route::get('/kerja-praktek', [LandingPageController::class, 'kp']);
Route::get('/kampus-merdeka', [LandingPageController::class, 'msib']);

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/resresh-captcha', [AuthController::class, 'captcha'])->name('captcha.refresh');
Route::post('/login', [AuthController::class, 'loginPost'])->name('loginPost');

Route::prefix('dashboard')->middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'dashboard']);
    Route::get('/pengaturan-akun', [PengaturanAkunController::class, 'index'])->name('pengaturan-akun.index');
    Route::put('/pengaturan-akun-password', [PengaturanAkunController::class, 'password'])->name('pengaturan-akun.password');
    Route::put('/pengaturan-akun-mahasiswa', [PengaturanAkunController::class, 'mahasiswa'])->name('pengaturan-akun.mahasiswa');
    Route::put('/pengaturan-akun-alumni', [PengaturanAkunController::class, 'alumni'])->name('pengaturan-akun.alumni');
    Route::put('/pengaturan-akun-staff', [PengaturanAkunController::class, 'staff'])->name('pengaturan-akun.staff');

    // admin - kaprodi
    Route::middleware(['UserHasRole:admin,kaprodi'])->group(function () {
        Route::resource('slider', SliderImageController::class);
        Route::resource('mitra', MitraController::class);

        Route::resource('kategori-kegiatan-prodi', KategoriKegiatanProdiController::class);
        Route::get('/api/kategori-kegiatan-prodi', [KategoriKegiatanProdiController::class, 'api'])->name('kategori-kegiatan-prodi.api');
        Route::resource('kegiatan-prodi', KegiatanProdiController::class);

        Route::resource('alumni', AlumniController::class);
        Route::get('/alumni-export', [AlumniController::class, 'export'])->name('alumni.export');
        Route::get('/alumni-import-page', [AlumniController::class, 'importPage'])->name('alumni.importPage');
        Route::post('/alumni-import', [AlumniController::class, 'import'])->name('alumni.import');
        Route::resource('alumni-karir', KarirAlumniController::class);
        Route::put('/alumni-karir/{id}/konfirmasi', [KarirAlumniController::class, 'konfirmasi'])->name('alumni-karir.konfirmasi');
        Route::put('/alumni-karir/{id}/tolak', [KarirAlumniController::class, 'tolak'])->name('alumni-karir.tolak');
        Route::put('/alumni-karir/{id}/pesan', [KarirAlumniController::class, 'pesan'])->name('alumni-karir.pesan');

        Route::resource('akun-mahasiswa', AkunMahasiswaController::class);
        Route::get('/akun-mahasiswa-export', [AkunMahasiswaController::class, 'export'])->name('akun-mahasiswa.export');
        Route::get('/akun-mahasiswa-import-page', [AkunMahasiswaController::class, 'importPage'])->name('akun-mahasiswa.importPage');
        Route::post('/akun-mahasiswa-import', [AkunMahasiswaController::class, 'import'])->name('akun-mahasiswa.import');
        Route::resource('akun-staff', AkunStaffController::class);
        Route::get('/akun-staff-export', [AkunStaffController::class, 'export'])->name('akun-staff.export');
        Route::get('/akun-staff-import-page', [AkunStaffController::class, 'importPage'])->name('akun-staff.importPage');
        Route::post('/akun-staff-import', [AkunStaffController::class, 'import'])->name('akun-staff.import');

        Route::resource('akun-organisasi', AkunOrganisasiController::class);
        Route::post('/akun-organisasi/tambah-anggota', [AkunOrganisasiController::class, 'tambahAnggota'])->name('akun-organisasi.tambahAnggota');
        Route::delete('/akun-organisasi/{id}/hapus-anggota', [AkunOrganisasiController::class, 'hapusAnggota'])->name('akun-organisasi.hapusAnggota');
        Route::resource('penetapan-pembimbing-ta', PenetapanBembimbingTugasAkhirController::class);
        Route::post('/penetapan-pembimbing-ta/pdf', [PenetapanBembimbingTugasAkhirController::class, 'exportPdf'])->name('penetapan-pembimbing-ta.pdf');
        // Route::resource('tugas-akhir', TugasAkhirController::class);
        // Route::resource('postingan-organisasi', KegiatanOrganisasiController::class);

        Route::prefix('kerja-praktek')->group(function () {
            Route::get('/', [KerjaPraktekAdminController::class, 'index']);
        });
    });

    Route::middleware(['UserHasRole:dosen,kaprodi,admin'])->group(function () {
        Route::resource('pemeriksaan-ta', PemeriksaanTugasAkhirController::class);
    });

    Route::middleware(['UserHasRole:dosen,kaprodi,mahasiswa'])->group(function () {
        Route::resource('bimbingan-ta', BimbinganTugasAkhirController::class);
        Route::get('bimbingan-ta/{id}/chat', [BimbinganTugasAkhirController::class, 'chat'])->name('bimbingan-ta.chat');
        Route::post('bimbingan-ta/chat', [BimbinganTugasAkhirController::class, 'postChat'])->name('bimbingan-ta.postChat');
    });

    // mahasiswa
    Route::middleware(['UserHasRole:mahasiswa'])->group(function () {
        Route::resource('pengajuan-ta', PengajuanTugasAkhirController::class);
        Route::resource('detail-ta', TugasAkhirController::class);

        Route::prefix('kerja-praktek')->group(function () {
            Route::get('/', [KerjaPraktekMahasiswaController::class, 'index'])->name('kerja-praktek.index');
            Route::get('/daftar', [KerjaPraktekMahasiswaController::class, 'daftar'])->name('kerja-praktek.daftar');
        });

        Route::prefix('kampus-merdeka')->group(function () {
            Route::get('/', [KampusMerdekaMahasiswaController::class, 'index'])->name('kampus-merdeka.index');
        });
    });

    // alumni
    Route::middleware(['UserHasRole:alumni'])->group(function () {
        Route::resource('share-jobs', ShareJobsController::class);
    });

    Route::middleware(['UserHasRole:organisasi,kaprodi,admin'])->group(function () {
        Route::resource('postingan-organisasi', KegiatanOrganisasiController::class);
    });
});


// Route::get('/seed', function () {
//     Artisan::call('db:seed');
// });lara
