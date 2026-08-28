# Database Schema

## 1. Prinsip Database

Database menggunakan:

-   MySQL
-   Primary key berbasis `id`
-   Foreign key untuk relationship normal
-   ENUM untuk role/status tertentu
-   Unique constraint untuk business rule
-   Soft delete pada data yang relevan
-   JSON untuk data fleksibel pada notification/activity log
-   Polymorphic relationship untuk email dan activity log

## 2. Daftar Tabel

    No Tabel               Keterangan
  ---- ------------------- -------------------------------
     1 users               Authentication dan role
     2 fakultas            Master fakultas
     3 program_studi       Master program studi
     4 tahun_akademik      Tahun dan semester akademik
     5 dosen               Profile dosen
     6 mahasiswa           Profile mahasiswa
     7 mata_kuliah         Master mata kuliah
     8 kelas               Kelas mata kuliah per periode
     9 kelas_dosen         Relasi dosen dan kelas
    10 enrollments         Relasi mahasiswa dan kelas
    11 materi              Materi pembelajaran
    12 pengumuman          Pengumuman kelas
    13 tugas               Assignment
    14 submissions         Pengumpulan tugas
    15 submission_files    File pada submission
    16 assignment_grades   Nilai tugas
    17 kuis                Quiz
    18 soal_kuis           Soal quiz
    19 pilihan_jawaban     Pilihan jawaban
    20 quiz_attempts       Percobaan quiz
    21 quiz_answers        Jawaban mahasiswa
    22 diskusi             Thread diskusi
    23 diskusi_pesan       Pesan dan reply
    24 notifications       Notifikasi user
    25 email_logs          Log email
    26 activity_logs       Audit aktivitas

## 3. Tabel Inti

### users

Kolom utama:

-   `id`
-   `name`
-   `email`
-   `password`
-   `role`
-   `avatar`
-   `is_active`
-   `last_login_at`
-   `email_verified_at`
-   `created_at`
-   `updated_at`
-   `deleted_at`

Role:

``` text
admin
dosen
mahasiswa
```

### fakultas

-   `id`
-   `kode`
-   `nama`
-   timestamps
-   `deleted_at`

### program_studi

-   `id`
-   `fakultas_id`
-   `kode`
-   `nama`
-   `jenjang`
-   timestamps
-   `deleted_at`

### tahun_akademik

-   `id`
-   `kode`
-   `tahun`
-   `semester`
-   `mulai_tanggal`
-   `selesai_tanggal`
-   `is_active`
-   timestamps
-   `deleted_at`

### dosen

-   `id`
-   `user_id`
-   `program_studi_id`
-   `nidn`
-   `nip`
-   `status`
-   timestamps
-   `deleted_at`

### mahasiswa

-   `id`
-   `user_id`
-   `program_studi_id`
-   `nim`
-   `angkatan`
-   `status`
-   timestamps
-   `deleted_at`

### mata_kuliah

-   `id`
-   `program_studi_id`
-   `kode`
-   `nama`
-   `sks`
-   `semester`
-   `deskripsi`
-   timestamps
-   `deleted_at`

### kelas

-   `id`
-   `mata_kuliah_id`
-   `tahun_akademik_id`
-   `kode_kelas`
-   `nama_kelas`
-   `kuota`
-   `deskripsi`
-   `status`
-   timestamps
-   `deleted_at`

### kelas_dosen

-   `id`
-   `kelas_id`
-   `dosen_id`
-   `peran`
-   timestamps
-   `deleted_at`

### enrollments

-   `id`
-   `kelas_id`
-   `mahasiswa_id`
-   `status`
-   `tanggal_enroll`
-   timestamps
-   `deleted_at`

## 4. Tabel Pembelajaran

### materi

Menyimpan materi pembelajaran dan mendukung tipe PDF, video, link, dan
dokumen.

### pengumuman

Menyimpan pengumuman yang dibuat untuk kelas.

### tugas

Menyimpan assignment dan aturan pengumpulan.

### submissions

Menyimpan setiap versi submission mahasiswa.

### submission_files

Menyimpan file yang termasuk dalam satu submission.

### assignment_grades

Menyimpan nilai dan feedback untuk submission tertentu.

## 5. Tabel Kuis

### kuis

Menyimpan konfigurasi quiz.

### soal_kuis

Menyimpan pertanyaan quiz.

### pilihan_jawaban

Menyimpan opsi jawaban.

### quiz_attempts

Menyimpan setiap percobaan mahasiswa.

### quiz_answers

Menyimpan jawaban mahasiswa untuk setiap soal.

`pilihan_jawaban_id` nullable.

## 6. Tabel Diskusi

### diskusi

Menyimpan thread.

### diskusi_pesan

Menyimpan pesan dan reply.

`parent_id` nullable.

## 7. Tabel Sistem

### notifications

Notifikasi per user.

### email_logs

Log email dengan polymorphic relation.

### activity_logs

Audit aktivitas dengan polymorphic subject.

`user_id` nullable karena aktivitas dapat dilakukan oleh sistem.

## 8. Soft Delete

Data yang menggunakan soft delete memiliki:

``` text
deleted_at
```

Soft delete digunakan agar histori tidak langsung hilang dari database.

Relasi child tidak otomatis dihapus hanya karena parent di-soft-delete.
Perilaku cascade akan ditentukan secara hati-hati pada migration dan
service/application layer.

## 9. Indexing

Foreign key dan kolom pencarian utama diberi index.

Contoh:

``` text
program_studi.fakultas_id
kelas.mata_kuliah_id
kelas.tahun_akademik_id
kelas_dosen.dosen_id
enrollments.mahasiswa_id
submissions.tugas_id
submissions.mahasiswa_id
quiz_attempts.kuis_id
quiz_attempts.mahasiswa_id
notifications.user_id
```

## 10. Nilai

Nilai tugas dan kuis sengaja dipisahkan.

``` text
assignment_grades
```

digunakan untuk nilai tugas.

``` text
quiz_attempts.score
```

digunakan untuk nilai kuis.

Tidak ada `gradebook` atau tabel nilai akhir pada MVP.
