# ERD E-Learning Kampus

## 1. Database Overview

Database menggunakan MySQL dan terdiri dari 26 tabel utama.

Arsitektur data utama:

``` text
Fakultas
   ↓
Program Studi
   ↓
Mata Kuliah
   ↓
Kelas
   ├── Kelas Dosen
   ├── Enrollment
   ├── Materi
   ├── Pengumuman
   ├── Tugas
   │    └── Submission
   │         ├── Submission Files
   │         └── Assignment Grade
   ├── Kuis
   │    ├── Soal
   │    │    └── Pilihan Jawaban
   │    └── Quiz Attempts
   │         └── Quiz Answers
   └── Diskusi
        └── Diskusi Pesan
```

## 2. Entity

### Authentication

-   `users`

### Akademik

-   `fakultas`
-   `program_studi`
-   `tahun_akademik`
-   `dosen`
-   `mahasiswa`
-   `mata_kuliah`
-   `kelas`
-   `kelas_dosen`
-   `enrollments`

### Pembelajaran

-   `materi`
-   `pengumuman`
-   `tugas`
-   `submissions`
-   `submission_files`
-   `assignment_grades`

### Kuis

-   `kuis`
-   `soal_kuis`
-   `pilihan_jawaban`
-   `quiz_attempts`
-   `quiz_answers`

### Diskusi & Sistem

-   `diskusi`
-   `diskusi_pesan`
-   `notifications`
-   `email_logs`
-   `activity_logs`

## 3. Relationship Utama

### User

``` text
users 1 ─── 1 dosen
users 1 ─── 1 mahasiswa
```

### Fakultas

``` text
fakultas 1 ─── N program_studi
```

### Program Studi

``` text
program_studi 1 ─── N dosen
program_studi 1 ─── N mahasiswa
program_studi 1 ─── N mata_kuliah
```

### Mata Kuliah & Kelas

``` text
mata_kuliah 1 ─── N kelas
tahun_akademik 1 ─── N kelas
```

### Dosen & Kelas

``` text
dosen N ─── N kelas
          melalui kelas_dosen
```

### Mahasiswa & Kelas

``` text
mahasiswa N ─── N kelas
              melalui enrollments
```

### Pembelajaran

``` text
kelas 1 ─── N materi
kelas 1 ─── N pengumuman
kelas 1 ─── N tugas
kelas 1 ─── N kuis
kelas 1 ─── N diskusi
```

### Tugas

``` text
tugas 1 ─── N submissions
mahasiswa 1 ─── N submissions
submission 1 ─── N submission_files
submission 1 ─── 1 assignment_grade
```

### Kuis

``` text
kuis 1 ─── N soal_kuis
soal_kuis 1 ─── N pilihan_jawaban
kuis 1 ─── N quiz_attempts
quiz_attempt 1 ─── N quiz_answers
```

### Diskusi

``` text
diskusi 1 ─── N diskusi_pesan
diskusi_pesan 1 ─── N reply
```

`parent_id` nullable untuk membedakan pesan utama dan reply.

## 4. Constraint Penting

``` text
users.email UNIQUE

dosen.user_id UNIQUE
dosen.nidn UNIQUE
dosen.nip UNIQUE

mahasiswa.user_id UNIQUE
mahasiswa.nim UNIQUE

mata_kuliah.kode UNIQUE

kelas
UNIQUE(mata_kuliah_id, tahun_akademik_id, kode_kelas)

kelas_dosen
UNIQUE(kelas_id, dosen_id)

enrollments
UNIQUE(kelas_id, mahasiswa_id)

submissions
UNIQUE(tugas_id, mahasiswa_id, submission_number)

assignment_grades.submission_id UNIQUE

soal_kuis
UNIQUE(kuis_id, urutan)

pilihan_jawaban
UNIQUE(soal_kuis_id, urutan)

quiz_attempts
UNIQUE(kuis_id, mahasiswa_id, attempt_number)

quiz_answers
UNIQUE(attempt_id, soal_kuis_id)
```

## 5. Nullable Relationship

Tiga kolom berikut memang nullable:

### `quiz_answers.pilihan_jawaban_id`

Tidak semua jawaban membutuhkan pilihan jawaban.

### `diskusi_pesan.parent_id`

`NULL` berarti pesan utama; terisi berarti reply.

### `activity_logs.user_id`

`NULL` dapat digunakan untuk aktivitas yang dilakukan oleh sistem.

## 6. Polymorphic Relationship

### Email Log

``` text
email_logs
├── emailable_type
└── emailable_id
```

Digunakan untuk menghubungkan log email ke entity seperti tugas, nilai,
kuis, atau pengumuman.

### Activity Log

``` text
activity_logs
├── subject_type
└── subject_id
```

Digunakan untuk menghubungkan aktivitas ke subject yang dicatat.

## 7. DBML

Kode DBML final dapat disimpan pada dokumentasi atau file terpisah untuk
digunakan di dbdiagram.io.

Struktur referensi utamanya:

``` dbml
Ref: fakultas.id < program_studi.fakultas_id
Ref: program_studi.id < dosen.program_studi_id
Ref: program_studi.id < mahasiswa.program_studi_id
Ref: program_studi.id < mata_kuliah.program_studi_id

Ref: mata_kuliah.id < kelas.mata_kuliah_id
Ref: tahun_akademik.id < kelas.tahun_akademik_id

Ref: kelas.id < kelas_dosen.kelas_id
Ref: dosen.id < kelas_dosen.dosen_id

Ref: kelas.id < enrollments.kelas_id
Ref: mahasiswa.id < enrollments.mahasiswa_id

Ref: kelas.id < materi.kelas_id
Ref: kelas.id < pengumuman.kelas_id

Ref: kelas.id < tugas.kelas_id
Ref: tugas.id < submissions.tugas_id
Ref: mahasiswa.id < submissions.mahasiswa_id
Ref: submissions.id < submission_files.submission_id
Ref: submissions.id - assignment_grades.submission_id

Ref: kelas.id < kuis.kelas_id
Ref: kuis.id < soal_kuis.kuis_id
Ref: soal_kuis.id < pilihan_jawaban.soal_kuis_id
Ref: kuis.id < quiz_attempts.kuis_id
Ref: mahasiswa.id < quiz_attempts.mahasiswa_id
Ref: quiz_attempts.id < quiz_answers.attempt_id
Ref: soal_kuis.id < quiz_answers.soal_kuis_id

Ref: kelas.id < diskusi.kelas_id
Ref: diskusi.id < diskusi_pesan.diskusi_id
Ref: users.id < diskusi_pesan.user_id
```

Relationship nullable dan polymorphic tidak dipaksa sebagai FK biasa
pada DBML.

## 8. Status Audit

**Database Schema V1.1 --- Approved for Migration**

Perbaikan audit:

-   `sks` → tipe integer kecil.
-   `semester` pada mata kuliah → tipe integer kecil.
-   `angkatan` → tipe tahun.
-   Nullable relationship dipertahankan.
