## Tentang Repository ini

Ini aplikasi web yang berfungsi menjadi admin dalam sebuah aplikasi mobile. Ingat, ini hanya aplikasi web, bukan mobile.

## Cara menggunakan projek ini, disarankan pakai vscode (jika pertama kali memakai projek ini)

- Clone projek ini ke laptop/PC kalian
  **<p>git clone https://github.com/pararel/apb.git </p>**

- di direktori projeknya, lakukan penginstalan composer
  **<p>composer install</p>**

- ada file .env.example. salin dan ubah jadi .env
- pada file .env, buat barisan baru dan tambahkan teks berikut
  **<p>FIREBASE_CREDENTIALS=storage/firebase/firebase_credentials.json</p>**
  **<p>FIREBASE_DATABASE_URL=https://emonic-e9f58.firebaseio.com</p>**

- generate app key laravel
  **<p>php artisan key:generate</p>**

- untuk kunci kredensial supaya bisa mengakses database mobile nya, letakkan file nya di storage/firebase. (file minta ke moderator)
- Hidupkan server seperti apache dengan xampp atau sejenisnya, lalu jalankan web
  **<p>php artisan serve</p>**
