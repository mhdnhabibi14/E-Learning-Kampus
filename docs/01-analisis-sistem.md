# Analisis Sistem E-Learning Kampus

## 1. Latar Belakang

Perkembangan pembelajaran digital membuat perguruan tinggi membutuhkan
sistem yang dapat mengelola aktivitas akademik secara terpusat. Sistem
E-Learning Kampus dirancang sebagai media pembelajaran yang
menghubungkan dosen dan mahasiswa dalam satu platform.

Sistem tidak hanya menyediakan materi, tetapi juga mendukung tugas,
pengumpulan tugas, kuis, diskusi, pengumuman, notifikasi, dan informasi
nilai.

## 2. Permasalahan

Beberapa permasalahan yang ingin diselesaikan:

1.  Materi pembelajaran belum terpusat.
2.  Pengumpulan tugas membutuhkan media yang terstruktur.
3.  Dosen membutuhkan tempat untuk memberikan tugas dan nilai.
4.  Mahasiswa membutuhkan akses terpusat terhadap kelas dan materi.
5.  Kuis membutuhkan mekanisme attempt dan penyimpanan jawaban.
6.  Komunikasi terkait pembelajaran membutuhkan ruang diskusi.
7.  Aktivitas sistem membutuhkan pencatatan untuk audit.

## 3. Tujuan Sistem

### Tujuan Umum

Membangun platform E-Learning Kampus yang terstruktur, mudah digunakan,
dan mendukung aktivitas pembelajaran antara dosen dan mahasiswa.

### Tujuan Khusus

-   Memusatkan data pembelajaran.
-   Memudahkan dosen mengelola kelas.
-   Memudahkan mahasiswa mengikuti kelas.
-   Menyediakan mekanisme tugas dan resubmission.
-   Menyediakan kuis dan penyimpanan attempt.
-   Menyediakan diskusi berbasis thread.
-   Menyediakan notifikasi dan pencatatan email.
-   Menjaga histori data melalui soft delete dan activity log.

## 4. Aktor Sistem

### Admin

Admin bertanggung jawab terhadap pengelolaan sistem dan master data.

### Dosen

Dosen bertanggung jawab terhadap aktivitas pembelajaran pada kelas yang
diampu.

### Mahasiswa

Mahasiswa mengikuti kelas dan aktivitas pembelajaran yang tersedia.

## 5. Ruang Lingkup

### Termasuk

-   Authentication
-   User management
-   Fakultas
-   Program studi
-   Tahun akademik
-   Dosen
-   Mahasiswa
-   Mata kuliah
-   Kelas
-   Enrollment
-   Materi
-   Pengumuman
-   Tugas
-   Submission
-   Multiple submission files
-   Resubmission
-   Nilai tugas
-   Kuis
-   Soal
-   Pilihan jawaban
-   Quiz attempt
-   Quiz answer
-   Diskusi
-   Notification
-   Email log
-   Activity log

### Tidak termasuk untuk MVP

-   Perhitungan IPK
-   Gradebook gabungan
-   Nilai akhir otomatis lintas komponen
-   Video conference built-in
-   Chat real-time
-   Sistem pembayaran

## 6. Kebutuhan Fungsional

### Authentication

-   User dapat login.
-   User dapat logout.
-   User dapat melakukan reset password.
-   User memiliki role.
-   Akun dapat diaktifkan/nonaktifkan.

### Admin

-   Mengelola user.
-   Mengelola fakultas.
-   Mengelola program studi.
-   Mengelola tahun akademik.
-   Mengelola mata kuliah.
-   Mengelola kelas.

### Dosen

-   Melihat kelas yang diampu.
-   Mengelola materi.
-   Membuat pengumuman.
-   Membuat tugas.
-   Menentukan deadline dan aturan file.
-   Melihat submission.
-   Memberikan nilai tugas.
-   Membuat kuis.
-   Membuat soal dan pilihan jawaban.
-   Melihat hasil attempt.
-   Membuat thread diskusi.

### Mahasiswa

-   Melihat kelas yang diikuti.
-   Mengakses materi.
-   Melihat pengumuman.
-   Mengumpulkan tugas.
-   Melakukan resubmission jika diperbolehkan.
-   Mengunggah beberapa file dalam satu submission.
-   Mengerjakan kuis.
-   Melihat nilai tugas.
-   Melihat nilai kuis.
-   Mengikuti diskusi.

## 7. Kebutuhan Non-Fungsional

### Security

-   Password disimpan menggunakan hashing Laravel.
-   Authorization berbasis role dan policy.
-   User tidak dapat menentukan role admin/dosen melalui register
    publik.
-   File upload divalidasi.
-   Data sensitif tidak disimpan dalam repository.

### Performance

-   Pagination untuk daftar data.
-   Index pada foreign key dan kolom pencarian penting.
-   File tidak disimpan langsung sebagai binary pada database.

### Maintainability

-   Menggunakan Eloquent relationship.
-   Menggunakan Form Request untuk validasi.
-   Menggunakan Policy/Middleware untuk authorization.
-   Menggunakan SoftDeletes pada data yang relevan.

## 8. Business Rules

1.  Role terdiri dari `admin`, `dosen`, dan `mahasiswa`.
2.  Mahasiswa hanya dapat memiliki satu enrollment pada kelas yang sama.
3.  Mahasiswa dapat mengambil mata kuliah yang sama pada semester
    berbeda.
4.  Tugas dapat menerima resubmission.
5.  Satu submission dapat memiliki lebih dari satu file.
6.  Nilai tugas dan nilai kuis tidak digabung dalam satu gradebook.
7.  Diskusi menggunakan thread dengan reply.
8.  `parent_id` pada pesan diskusi boleh NULL.
9.  `pilihan_jawaban_id` pada quiz answer boleh NULL.
10. `user_id` pada activity log boleh NULL.
11. Email log dikaitkan ke data menggunakan polymorphic relationship.
12. Activity log menggunakan polymorphic relationship.
13. Soft delete tidak berarti seluruh data anak harus otomatis dihapus.

## 9. Kesimpulan

Hasil analisis menghasilkan sistem E-Learning Kampus dengan tiga role
utama dan modul pembelajaran yang terpisah secara jelas. Struktur ini
menjadi dasar penyusunan PRD, ERD, database schema, dan implementasi
Laravel.
