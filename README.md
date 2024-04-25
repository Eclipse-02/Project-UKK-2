# PROJEK UKK DIGITAL LIBRARY

- Nama: Rafa Umar Abdus Syakur.
- NIS: 12100738.
- Kelas: RPL-XII.

## 0. Setup
Sebelum menjalankan program, pastikan anda sudah memiliki [xampp](https://www.apachefriends.org/download.html), [composer](https://getcomposer.org), dan [node.js](https://nodejs.org/en)

Jika project sudah di clone/unzip, jalankan perintah ini di project tersebut

    php artisan key:generate
    composer install
    npm install

Jangan lupa untuk membuat .env file dengan menyalin .env.example

Ini untuk mengenerate database dan data dummy

    php artisan migrate --seed

Dan ini untuk menjalankan server

    php artisan ser
    npm run dev

## 1. Welcome Page
Ini adalah Welcome Page. Di halaman ini kalian bisa membaca dan mengunduh buku. Tetapi sebelum itu, kalian harus login dan mengunggah file terlebih dahulu.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/d3de9f42-873a-42f5-a8b4-2d598737ce8e)

## 2. Login Page
Pada halaman ini, anda bisa masuk ke 3 akun berbeda yang telah di generate oleh seeder. Silahkan login ke akun admin/employee untuk mengunggah file.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/be890f0a-1bd7-45fe-b8c6-20bac929e043)

- Akun Admin </br>
Email: admin@gmail.com </br>
Password: 12345678 </br>
  
- Akun Employee </br>
Email: employee@gmail.com </br>
Password: 12345678 </br>
  
- Akun User </br>
Email: user@gmail.com </br>
Password: 12345678 </br>

## 3. Dashboard Page
Tergantung pada akun, tampilan anda akan berbeda. Di gambar bawah ini adalah tampilan user admin.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/abe4e41d-0ee0-4476-9581-d189e4a831b9)

### 3.1. Admin Page
Pada bagian ini akan menjelaskan apa saja yang bisa lakukan oleh user admin.

#### 3.1.1 Dashboard
Di halaman ini admin bisa memantau jumlah buku yang diunggah, buku fisik, dan buku yang sedang dipinjam. Karena belum ada buku yang diunggah, tidak ada yang meminjam buku fisik.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/abe4e41d-0ee0-4476-9581-d189e4a831b9)

#### 3.1.2 Categories
Di halaman ini anda bisa membuat, melihat, mengedit, dan menghapus kategori buku.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/ac88d03b-7eff-4c91-adca-85d1dfa5031e)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/0a7276ca-0e2b-4cbb-ab06-84d6239300b9)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/1c75cb13-92aa-4dca-95d0-dba7b0917c91)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/339f400e-b710-4314-a94d-229eaed39b0b)

#### 3.1.3 Publishers
Di halaman ini anda bisa membuat, melihat, mengedit, dan menghapus penerbit buku.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/1192f3a3-4015-4f19-a17a-fb6f8176a8a7)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/84586219-f72e-46b5-8e82-8e55df6ce27d)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/491c5b96-bd14-4485-a9f1-1a364e079439)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/a82bb427-e6d0-4d9e-b08b-92bd0edbf3a6)

#### 3.1.4 Books
Di halaman ini anda bisa membuat, melihat, mengedit, dan menghapus buku.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/e48397df-2317-4a04-a5cd-2b9c39366f90)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/16ea9e2d-a766-4e88-9b2b-d5ee55a21740)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/6f05f149-33bc-4252-97d9-586453a4c01a)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/b8fc5482-869b-4b09-becb-ad46625e12c8)

#### 3.1.5 Borrowings
Di halaman ini anda bisa melihat dan mengganti status peminjaman buku.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/6b9c3812-d598-41f4-b914-531886d7ca01)

#### 3.1.6 Users
Di halaman ini anda bisa membuat, melihat, mengedit, dan menghapus buku.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/766f90ac-d511-4ea7-8632-b8151fdeae72)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/96712f45-4628-4dcb-b7a2-43f2db346b32)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/65461360-bcea-4ff8-9890-484d5695a472)

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/60924a6b-25a9-43f6-924d-41e93b8a51c2)

#### 3.1.7 Logs
Di halaman ini anda bisa melihat, aktivitas yang dilakukan oleh semua user.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/01477360-fcb2-41c7-a451-7840828c93cf)

### 3.2. Employee Page
Employee memiliki akses yang sama dengan admin kecuali [users](#316-users) dan [logs](#317-logs)

### 3.3. User Page
Pada bagian ini akan menjelaskan apa saja yang bisa lakukan oleh user.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/5eb078b0-27a2-41bc-a6ee-e955cd770bbf)

#### 3.3.1 Bookshelves
Di halaman ini anda bisa membaca, meminjam, dan mengunduh buku.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/7d0ca410-d741-468a-8aad-eeac8a7b940e)

Anda bisa melanjutkan baca anda

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/eaeb33cf-5e59-4244-87a4-1756a3904a19)

Lalu meminjam buku dan mengunduh

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/8e0d40a2-a7b7-44a3-96ec-5963f242da90)

#### 3.3.2 Review
Di halaman ini anda bisa memberi nilai dan komentar buku.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/4e20619b-904e-4172-b1ff-0e251f8f3294)

## 4 Extras
Pada bagian ini akan menjelaskan apa saja yang bisa lakukan oleh semua user.

### 4.1 Profile Detail
Di halaman ini memberikan informasi mengenai akun yang sedang digunakan. BTW untuk meminjam buku, data telepon dan alamat harus diisi terlebih dahulu.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/824cbe1c-a372-4150-9eb2-0aea463d7355)

### 4.2 Change Profile Detail
Di halaman ini anda bisa mengubah data akun yang sedang digunakan.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/d1008693-6870-4632-89a4-37e64c2005a4)

### 4.3 Change Password
Di halaman ini anda bisa mengubah password akun yang sedang digunakan.

![image](https://github.com/Eclipse-02/Project-UKK-2/assets/102575866/5089ddf9-f03a-43c0-8492-04c2206c452b)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
