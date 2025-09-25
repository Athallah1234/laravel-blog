# 📰 ModernBlog - Laravel Blog Platform (Maintenance)

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-^8.2-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=flat&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-green)

🚀 **ModernBlog** adalah platform blog modern berbasis **Laravel** dengan desain responsif, manajemen konten yang powerful, dan fitur lengkap untuk mengelola artikel, kategori, tag, komentar, serta user role (Admin & User).  
Project ini cocok untuk **personal blog, company blog, atau blog komunitas** yang ingin dibangun dengan **Laravel + Bootstrap 5**.

---

## ✨ Fitur Utama

✅ **Authentication & Authorization**
- Login, Register, Logout
- Role-based (Admin & User)
- Verifikasi Email & Reset Password

✅ **Manajemen Artikel**
- Tambah, Edit, Hapus Artikel
- Upload Thumbnail
- Editor WYSIWYG (Summernote/TinyMCE/Quill)
- Draft vs Publish

✅ **Kategori & Tag**
- Manajemen kategori (CRUD)
- Tagging system untuk artikel

✅ **Komentar**
- Sistem komentar bawaan
- Nested Comment (reply)

✅ **User Management**
- Profil pengguna
- Ganti avatar
- Role Management oleh Admin

✅ **Dashboard Admin**
- Statistik artikel, user, komentar
- Log aktivitas

✅ **SEO & Sharing**
- Slug otomatis
- Meta title & description
- Share ke social media

✅ **UI/UX Modern**
- Desain dengan Bootstrap 5
- Dark/Light Mode
- Mobile-friendly

---

## 📸 Demo Screenshots

| Home Page | Dashboard Admin | Detail Artikel |
|-----------|----------------|----------------|
| ![Home](https://via.placeholder.com/400x200?text=Home+Page) | ![Dashboard](https://via.placeholder.com/400x200?text=Admin+Dashboard) | ![Detail](https://via.placeholder.com/400x200?text=Detail+Article) |

---

## 🛠️ Teknologi yang Digunakan

- [Laravel 12](https://laravel.com/docs/12.x/) - PHP Framework
- [Bootstrap 5](https://getbootstrap.com/) - Frontend UI
- [MySQL](https://www.mysql.com/) - Database
- [Composer](https://getcomposer.org/) - Dependency Manager
- [NPM](https://www.npmjs.com/) - Asset bundler

---

## ⚙️ Instalasi & Setup

### 1. Clone Repository
```bash
git clone https://github.com/Athallah1234/laravel-blog.git
cd modernblog
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run dev
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```
Edit file .env sesuai kebutuhan:
```env
APP_NAME="ModernBlog"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=modernblog
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi Database & Seeder
```bash
php artisan migrate
```

### 5. Jalankan Server
```bash
php artisan serve
```
Akses: 👉 http://localhost:8000

## 🤝 Kontribusi

Kontribusi selalu terbuka! 🚀
Jika ingin membantu:

- Fork project
- Buat branch fitur baru (``git checkout -b fitur-baru``)
- Commit perubahan (``git commit -m "Tambah fitur baru"``)
- Push ke branch (``git push origin fitur-baru``)
- Ajukan Pull Request
