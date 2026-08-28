# Product Requirements Document (PRD)

## 1. Product Overview

**Nama Produk:** E-Learning Kampus

**Platform:** Web Application

**Target Pengguna:** Admin, Dosen, Mahasiswa

**Teknologi Awal:** Laravel 12, Laravel UI, Blade, Bootstrap, MySQL

## 2. Product Vision

Menyediakan platform pembelajaran digital kampus yang terstruktur
sehingga dosen dapat mengelola proses pembelajaran dan mahasiswa dapat
mengikuti aktivitas akademik secara terpusat.

## 3. Product Goals

-   Mempermudah pengelolaan kelas.
-   Memusatkan materi pembelajaran.
-   Menyediakan pengumpulan tugas yang mendukung resubmission.
-   Menyediakan kuis dengan attempt.
-   Menyediakan diskusi berbasis thread.
-   Menyediakan informasi nilai secara terpisah untuk tugas dan kuis.
-   Menyediakan audit aktivitas dan email.

## 4. User Personas

### Admin

Membutuhkan sistem administrasi yang mudah digunakan untuk mengelola
data pengguna dan data akademik.

### Dosen

Membutuhkan tools untuk mengelola kelas, materi, tugas, kuis, diskusi,
dan nilai.

### Mahasiswa

Membutuhkan dashboard yang sederhana untuk mengakses kelas, materi,
tugas, kuis, diskusi, dan nilai.

## 5. Feature Requirements

### 5.1 Authentication

**Requirement**

-   Login berdasarkan email dan password.
-   Logout.
-   Register mahasiswa.
-   Reset password.
-   Email verification.
-   Status akun aktif/nonaktif.

**Acceptance Criteria**

-   User dengan credential valid dapat login.
-   User nonaktif tidak dapat menggunakan sistem.
-   Register publik tidak dapat memilih role admin/dosen.
-   Password tidak disimpan dalam bentuk plaintext.

### 5.2 User & Academic Master Data

Admin dapat mengelola:

-   User
-   Fakultas
-   Program Studi
-   Tahun Akademik
-   Mata Kuliah
-   Kelas
-   Dosen
-   Mahasiswa

**Acceptance Criteria**

-   Data wajib tervalidasi.
-   Kode/NIM/NIDN/email unik sesuai aturan.
-   Data yang dihapus menggunakan soft delete jika relevan.

### 5.3 Class Management

Dosen dapat mengelola aktivitas pada kelas yang menjadi tanggung
jawabnya.

Mahasiswa dapat mengikuti banyak kelas.

**Acceptance Criteria**

-   Satu kelas dapat memiliki banyak dosen.
-   Satu dosen dapat mengampu banyak kelas.
-   Satu kelas dapat memiliki banyak mahasiswa.
-   Mahasiswa tidak dapat melakukan enrollment dua kali pada kelas yang
    sama.

### 5.4 Materi

Dosen dapat membuat materi dengan tipe:

-   PDF
-   Video
-   Link
-   Dokumen

Materi memiliki status draft/published.

**Acceptance Criteria**

-   Materi draft tidak ditampilkan sebagai materi publik kelas.
-   Materi published dapat diakses mahasiswa yang terdaftar.
-   File dan URL divalidasi sesuai tipe.

### 5.5 Pengumuman

Dosen dapat membuat pengumuman untuk kelas.

**Acceptance Criteria**

-   Pengumuman memiliki judul dan isi.
-   Pengumuman dapat dipublish.
-   Mahasiswa kelas dapat melihat pengumuman yang telah dipublish.

### 5.6 Tugas

Dosen dapat membuat tugas dengan:

-   Judul
-   Deskripsi
-   Deadline
-   Batas ukuran file
-   Maksimal jumlah file
-   Ekstensi yang diperbolehkan
-   Poin maksimal

**Acceptance Criteria**

-   Mahasiswa hanya dapat mengumpulkan tugas pada kelas yang diikuti.
-   Submission setelah deadline diberi status `late`.
-   Resubmission dapat dilakukan sesuai aturan aplikasi.
-   Satu submission dapat memiliki beberapa file.
-   Dosen dapat memberikan nilai dan feedback.

### 5.7 Resubmission

Satu mahasiswa dapat memiliki beberapa submission untuk tugas yang sama.

Setiap submission mempunyai `submission_number`.

**Acceptance Criteria**

-   Nomor submission bertambah secara berurutan.
-   Histori submission tetap tersimpan.
-   File submission terhubung ke submission tertentu.
-   Nilai terhubung ke submission yang dinilai.

### 5.8 Kuis

Dosen dapat membuat kuis dengan:

-   Waktu mulai
-   Waktu selesai
-   Durasi
-   Batas attempt
-   Poin maksimal
-   Soal
-   Pilihan jawaban

Mahasiswa dapat melakukan attempt sesuai batas yang ditentukan.

**Acceptance Criteria**

-   Mahasiswa hanya dapat mengerjakan kuis pada kelas yang diikuti.
-   Attempt dicatat.
-   Jawaban setiap soal disimpan.
-   Score quiz disimpan pada attempt.
-   Nilai kuis ditampilkan terpisah dari nilai tugas.

### 5.9 Diskusi

Diskusi menggunakan model **thread + reply**.

**Acceptance Criteria**

-   Thread memiliki judul dan isi.
-   User dapat membuat pesan.
-   Pesan dapat menjadi reply terhadap pesan lain.
-   `parent_id` NULL berarti pesan utama.
-   Diskusi dapat dibuka atau ditutup.

### 5.10 Notification

Sistem dapat menyimpan notifikasi user.

**Acceptance Criteria**

-   Notifikasi terhubung ke user.
-   Notifikasi dapat ditandai telah dibaca.
-   Data tambahan dapat disimpan sebagai JSON.

### 5.11 Email Log

Email log mencatat email yang dikirim sistem.

**Acceptance Criteria**

-   Status email tercatat.
-   Waktu pengiriman tercatat.
-   Error dapat dicatat.
-   Email dapat dikaitkan ke entity seperti tugas atau nilai melalui
    polymorphic relationship.

### 5.12 Activity Log

Activity log mencatat aktivitas penting user atau sistem.

**Acceptance Criteria**

-   Action tercatat.
-   Subject dapat menggunakan polymorphic relationship.
-   IP address dan user agent dapat dicatat jika tersedia.
-   Aktivitas sistem dapat memiliki `user_id` NULL.

## 6. Permission Matrix

  Fitur                                Admin                    Dosen         Mahasiswa
  ----------------------- ------------------------------- ------------------ -----------
  Kelola user                            ✓                        \-             \-
  Kelola fakultas                        ✓                        \-             \-
  Kelola prodi                           ✓                        \-             \-
  Kelola tahun akademik                  ✓                        \-             \-
  Kelola mata kuliah                     ✓                        \-             \-
  Kelola kelas                           ✓                 sesuai otorisasi      \-
  Materi                                 ✓                        ✓             lihat
  Pengumuman                             ✓                        ✓             lihat
  Tugas                                  ✓                        ✓            kumpul
  Nilai tugas              lihat/kelola sesuai kebutuhan          ✓             lihat
  Kuis                                   ✓                        ✓           kerjakan
  Nilai kuis               lihat/kelola sesuai kebutuhan          ✓             lihat
  Diskusi                                ✓                        ✓               ✓
  Notification                        sistem                    sistem          lihat
  Activity log                           ✓                        \-             \-

## 7. Out of Scope

Untuk MVP tidak mencakup:

-   Gradebook gabungan.
-   IPK otomatis.
-   Pembayaran.
-   Video conference built-in.
-   Chat real-time.
-   Integrasi SIAKAD eksternal.

## 8. Success Criteria

Project dianggap memenuhi MVP apabila:

-   Tiga role dapat login dan memperoleh akses sesuai haknya.
-   Admin dapat mengelola master data.
-   Dosen dapat mengelola kelas dan konten pembelajaran.
-   Mahasiswa dapat mengikuti kelas.
-   Tugas dan resubmission berjalan.
-   Multiple file submission berjalan.
-   Kuis dan attempt berjalan.
-   Nilai tugas dan kuis dapat dilihat secara terpisah.
-   Diskusi thread/reply berjalan.
-   Notification dan logging dasar berjalan.

## 9. Future Development

Fitur yang dapat dipertimbangkan setelah MVP:

-   Gradebook.
-   Integrasi SIAKAD.
-   Kalender akademik.
-   Live class.
-   Chat real-time.
-   Analitik pembelajaran.
-   Mobile application.
