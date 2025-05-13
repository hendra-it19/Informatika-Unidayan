<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::create([
        //     'username' => 'admin',
        //     'nama' => 'Admin',
        //     'password' => Hash::make('admin123'),
        //     'role' => 'admin',
        //     'email' => 'admin@gmail.com',
        // ]);
        User::create([
            'username' => '0913098203',
            'nama' => 'Ery Muchyar Hasiri, S.T., M.Kom',
            'password' => Hash::make('0913098203'),
            'role' => 'kaprodi',
            'identitas' => '0913098203',
            'is_verificator' => true,
            'email' => '0913098203@gmail.com',
        ]);


        User::create([
            'username' => '0724027801',
            'identitas' => '0724027801',
            'password' => Hash::make('0724027801'),
            'nama' => 'MOH ARIF SURYAWAN, S.kom., M.T',
            'role' => 'dosen',
            'is_verificator' => true,
            'email' => '0724027801@gmail.com',
            'hp' => '08113344497',
        ]);
        User::create([
            'username' => '0915058201',
            'username' => 'identitas',
            'password' => Hash::make('0915058201'),
            'nama' => 'NALDY NIRMANTO T, S.Kom., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0915058201@gmail.com',

        ]);
        User::create([
            'username' => '0922058101',
            'identitas' => '0922058101',
            'password' => Hash::make('0922058101'),
            'nama' => 'LA RAUFUN, S.Kom., M.T',
            'role' => 'dosen',
            'is_verificator' => true,
            'email' => '0922058101@gmail.com',
            'hp' => '082196359353',
        ]);
        User::create([
            'username' => '0906118502',
            'identitas' => '0906118502',
            'password' => Hash::make('0906118502'),
            'nama' => 'AZLIN, S.Kom., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0906118502@gmail.com',
            'hp' => '081240082017',
        ]);
        User::create([
            'username' => '0505078501',
            'identitas' => '0505078501',
            'password' => Hash::make('0505078501'),
            'nama' => 'LM FAJAR ISRAWAN, S.Kom., M.Kom',
            'role' => 'dosen',
            'is_verificator' => true,
            'email' => '0505078501@gmail.com',
            'hp' => '082395000863',
        ]);
        User::create([
            'username' => '0910096701',
            'identitas' => '0910096701',
            'password' => Hash::make('0910096701'),
            'nama' => 'ASNIATI, S.T., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0910096701@gmail.com',
            'hp' => '082192986928',
        ]);
        User::create([
            'username' => '0911047304',
            'identitas' => '0911047304',
            'password' => Hash::make('0911047304'),
            'nama' => 'Dr. Ir. MUHAMMAD IRADAT ACHMAD, S.T., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0911047304@gmail.com',
            'hp' => '085341505399',
        ]);
        User::create([
            'username' => '0920118301',
            'identitas' => '0920118301',
            'password' => Hash::make('0920118301'),
            'nama' => 'MUHAMMAD MUKMIN, S.Kom., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0920118301@gmail.com',
            'hp' => '085240675726',
        ]);
        User::create([
            'username' => '0917018602',
            'identitas' => '0917018602',
            'password' => Hash::make('0917018602'),
            'nama' => 'HENNY HAMSINAR, S.Kom., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0917018602@gmail.com',
            'hp' => '082193002979',
        ]);
        User::create([
            'username' => '0919058001',
            'identitas' => '0919058001',
            'password' => Hash::make('0919058001'),
            'nama' => 'JABAL NUR, S.Kom., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0919058001@gmail.com',
            'hp' => '085254541619',
        ]);
        User::create([
            'username' => '0930058705',
            'identitas' => '0930058705',
            'password' => Hash::make('0930058705'),
            'nama' => 'FITRIAH MUSADAT, S.Si., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0930058705@gmail.com',
            'hp' => '085696964813',
        ]);
        User::create([
            'username' => '0910038203',
            'identitas' => '0910038203',
            'password' => Hash::make('0910038203'),
            'nama' => 'Ir. LA ATINA, S.T., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0910038203@gmail.com',
            'hp' => '085398492200',
        ]);
        User::create([
            'username' => '0910068901',
            'identitas' => '0910068901',
            'password' => Hash::make('0910068901'),
            'nama' => 'Ir. SULTAN HADY, S.T., M.T',
            'role' => 'dosen',
            'is_verificator' => true,
            'email' => '0910068901@gmail.com',
            'hp' => '081267442574',
        ]);
        User::create([
            'username' => '0912126101',
            'identitas' => '0912126101',
            'password' => Hash::make('0912126101'),
            'nama' => 'Ir. CHRISTOPOL EDDY, M.Eng',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0912126101@gmail.com',
            'hp' => '082312222825',
        ]);
        User::create([
            'username' => '0918088903',
            'identitas' => '0918088903',
            'password' => Hash::make('0918088903'),
            'nama' => 'HELSON HAMID, S.T., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0918088903@gmail.com',

        ]);
        User::create([
            'username' => '0921128902',
            'identitas' => '0921128902',
            'password' => Hash::make('0921128902'),
            'nama' => 'NALIS HENDRAWAN, S.T., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0921128902@gmail.com',
            'hp' => '092187292905',
        ]);
        User::create([
            'username' => '0928079103',
            'identitas' => '0928079103',
            'password' => Hash::make('0928079103'),
            'nama' => 'HAMID WIJAYA, S.T., M.Kom',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0928079103@gmail.com',
            'hp' => '085241915927',
        ]);
        User::create([
            'username' => '0913049103',
            'identitas' => '0913049103',
            'password' => Hash::make('0913049103'),
            'nama' => 'WA ODE RAMHA A.U.M., M.Kom',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0913049103@gmail.com',
            'hp' => '085156571662',
        ]);
        User::create([
            'username' => '0925099004',
            'identitas' => '0925099004',
            'password' => Hash::make('0925099004'),
            'nama' => 'AHMAD MAULID ASMIDIN, S.T., M.T',
            'role' => 'dosen',
            'is_verificator' => false,
            'email' => '0925099004@gmail.com',
            'hp' => '082271178072',
        ]);


        // mahasiswa
        $user = User::create([
            'username' => '19650167',
            'identitas' => '19650167',
            'password' => Hash::make('19650167'),
            'nama' => 'IQRA ANUGRAH FARIHI',
            'role' => 'mahasiswa',
            'email' => '19650167@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2019,
        ]);

        $user = User::create([
            'username' => '19650033',
            'identitas' => '19650033',
            'password' => Hash::make('19650033'),
            'nama' => 'ROSMAWATI',
            'role' => 'mahasiswa',
            'email' => '19650033@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2019,
        ]);

        $user = User::create([
            'username' => '20650179',
            'identitas' => '20650179',
            'password' => Hash::make('20650179'),
            'nama' => 'PUJA MAWARNI',
            'role' => 'mahasiswa',
            'email' => '20650179@gmail.com',

        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2020,
        ]);

        $user = User::create([
            'username' => '20650145',
            'identitas' => '20650145',
            'password' => Hash::make('20650145'),
            'nama' => 'HERNIANI',
            'role' => 'mahasiswa',
            'email' => '20650145@gmail.com',

        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2020,
        ]);

        $user = User::create([
            'username' => '19650107',
            'identitas' => '19650107',
            'password' => Hash::make('19650107'),
            'nama' => 'RIAN MAULANA',
            'role' => 'mahasiswa',
            'email' => '19650107@gmail.com',

        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2019,
        ]);

        $user = User::create([
            'username' => '20650110',
            'identitas' => '20650110',
            'password' => Hash::make('20650110'),
            'nama' => 'RAHMAWATI ZAHRA',
            'role' => 'mahasiswa',
            'email' => '20650110@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2019,
        ]);

        $user = User::create([
            'username' => '20650158',
            'identitas' => '20650158',
            'password' => Hash::make('20650158'),
            'nama' => 'WINDA',
            'role' => 'mahasiswa',
            'email' => '20650158@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2019,
        ]);

        $user = User::create([
            'username' => '19650113',
            'identitas' => '19650113',
            'password' => Hash::make('19650113'),
            'nama' => 'ANDRIANTO',
            'role' => 'mahasiswa',
            'email' => '19650113@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2019,
        ]);

        $user = User::create([
            'username' => '18650103',
            'identitas' => '18650103',
            'password' => Hash::make('18650103'),
            'nama' => 'ANDIN APRIADIN',
            'role' => 'mahasiswa',
            'email' => '18650103@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2019,
        ]);

        $user = User::create([
            'username' => '19650139',
            'identitas' => '19650139',
            'password' => Hash::make('19650139'),
            'nama' => 'FITRIANI REZKI',
            'role' => 'mahasiswa',
            'email' => '19650139@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2019,
        ]);

        $user = User::create([
            'username' => '20650040',
            'identitas' => '20650040',
            'password' => Hash::make('20650040'),
            'nama' => 'SUPARMAN',
            'role' => 'mahasiswa',
            'email' => '20650040@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2020,
        ]);

        $user = User::create([
            'username' => '20650164',
            'identitas' => '20650164',
            'password' => Hash::make('20650164'),
            'nama' => 'LA ODE MUHAMMAD IQBAL',
            'role' => 'mahasiswa',
            'email' => '20650164@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2019,
        ]);

        $user = User::create([
            'username' => '20650088',
            'identitas' => '20650088',
            'password' => Hash::make('20650088'),
            'nama' => 'ANGGI TRIANADITA',
            'role' => 'mahasiswa',
            'email' => '20650088@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2020,
        ]);

        $user = User::create([
            'username' => '20650103',
            'identitas' => '20650103',
            'password' => Hash::make('20650103'),
            'nama' => 'LINTANG',
            'role' => 'mahasiswa',
            'email' => '20650103@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2020,
        ]);

        $user = User::create([
            'username' => '20650153',
            'identitas' => '20650153',
            'password' => Hash::make('20650153'),
            'nama' => 'MUH IKBAL',
            'role' => 'mahasiswa',
            'email' => '20650153@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2020,
        ]);


        $user = User::create([
            'username' => '20650061',
            'identitas' => '20650061',
            'password' => Hash::make('20650061'),
            'nama' => 'HARFINO',
            'role' => 'mahasiswa',
            'email' => '20650061@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2020,
        ]);

        $user = User::create([
            'username' => '20650079',
            'identitas' => '20650079',
            'password' => Hash::make('20650079'),
            'nama' => 'YILING ANDIKA WATI',
            'role' => 'mahasiswa',
            'email' => '20650079@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2020,
        ]);

        $user = User::create([
            'username' => '20650023',
            'identitas' => '20650023',
            'password' => Hash::make('20650023'),
            'nama' => 'ASRUL',
            'role' => 'mahasiswa',
            'email' => '20650023@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2020,
        ]);

        $user = User::create([
            'username' => '20650054',
            'identitas' => '20650054',
            'password' => Hash::make('20650054'),
            'nama' => 'UMI HAN SAMAL',
            'role' => 'mahasiswa',
            'email' => '20650054@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2020,
        ]);

        $user = User::create([
            'username' => '20650071',
            'identitas' => '20650071',
            'password' => Hash::make('20650071'),
            'nama' => 'HADIYASTI FEBRIANA',
            'role' => 'mahasiswa',
            'email' => '20650071@gmail.com',
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'tahun_masuk' => 2020,
        ]);
        // 20
    }
}
