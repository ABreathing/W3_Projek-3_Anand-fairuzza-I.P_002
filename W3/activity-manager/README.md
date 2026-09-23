# Activity Manager

Aplikasi manajemen aktivitas harian berbasis Laravel yang menerapkan pemisahan arsitektur bersih (*Form Request*, *Service Layer*, *Resource Controller*, dan *Blade Views*)

## Spesifikasi & Persyaratan System
* PHP >= 8.2
* Composer
* Laravel 11.x / 13.x
* SQLite / MySQL

## Langkah Instalasi & Jalankan Proyek

1. **Clone Repository & Masuk Folder Proyek**
git clone https://github.com/ABreathing/W3_Projek-3_Anand-fairuzza-I.P_002
cd W3_Projek-3_Anand-fairuzza-I.P_002/activity-manager
2. **Install Dependency PHP**
composer install
3. **Copy File Environment & Generate App Key**
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
kalau mau pake mysql tinggal ganti `DB_CONNECTION` dan isi host/nama db/user/password di `.env`

4. **Migrate & Seed Database**
php artisan migrate --seed
perintah ini bikin tabel `activities` sekaligus isi 5 data dummy dari `ActivitySeeder`

5. **(Opsional) Build Asset Frontend**
npm install
npm run build

6. **Jalankan Server**
php artisan serve
buka `http://localhost:8000` nanti langsung redirect ke `/activities`
