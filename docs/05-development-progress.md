# Development Progress

## Project Status

**Current Phase: Project Setup**

Analisis, PRD, ERD, dan audit database telah diselesaikan.

## Phase 1 --- Analysis

- [x] Analisis sistem
- [x] Identifikasi stakeholder
- [x] Identifikasi role
- [x] Functional requirements
- [x] Non-functional requirements
- [x] Business rules

## Phase 2 --- Product Requirements

- [x] Product overview
- [x] Product goals
- [x] User personas
- [x] User stories/requirements
- [x] Feature requirements
- [x] Permission matrix
- [x] Acceptance criteria
- [x] MVP scope
- [x] Future roadmap

## Phase 3 --- Database Design

- [x] ERD
- [x] Relationship audit
- [x] Cardinality audit
- [x] Constraint audit
- [x] Nullable relationship audit
- [x] Polymorphic relationship design
- [x] Soft delete strategy
- [x] Database Schema V1.1
- [x] DBML untuk dbdiagram.io

## Phase 4 --- Project Setup

- [x] Membuat repository GitHub
- [x] Membuat project Laravel 12
- [x] Install Laravel UI
- [x] Setup Bootstrap
- [x] Setup Vite
- [x] Konfigurasi MySQL
- [x] Setup `.env`
- [x] Menjalankan aplikasi lokal
- [x] Verifikasi authentication scaffold

## Phase 5 --- Authentication

- [ ] Login
- [ ] Logout
- [ ] Register
- [ ] Password reset
- [ ] Email verification
- [ ] Role ENUM
- [ ] Middleware role
- [ ] Authorization

## Phase 6 --- Database Migration

Urutan migration yang direncanakan:

1.  `users`
2.  `fakultas`
3.  `program_studi`
4.  `tahun_akademik`
5.  `dosen`
6.  `mahasiswa`
7.  `mata_kuliah`
8.  `kelas`
9.  `kelas_dosen`
10. `enrollments`
11. `materi`
12. `pengumuman`
13. `tugas`
14. `submissions`
15. `submission_files`
16. `assignment_grades`
17. `kuis`
18. `soal_kuis`
19. `pilihan_jawaban`
20. `quiz_attempts`
21. `quiz_answers`
22. `diskusi`
23. `diskusi_pesan`
24. `notifications`
25. `email_logs`
26. `activity_logs`

## Phase 7 --- Model & Relationship

- [ ] User model
- [ ] Fakultas model
- [ ] ProgramStudi model
- [ ] TahunAkademik model
- [ ] Dosen model
- [ ] Mahasiswa model
- [ ] MataKuliah model
- [ ] Kelas model
- [ ] KelasDosen model
- [ ] Enrollment model
- [ ] Materi model
- [ ] Pengumuman model
- [ ] Tugas model
- [ ] Submission model
- [ ] SubmissionFile model
- [ ] AssignmentGrade model
- [ ] Kuis model
- [ ] SoalKuis model
- [ ] PilihanJawaban model
- [ ] QuizAttempt model
- [ ] QuizAnswer model
- [ ] Diskusi model
- [ ] DiskusiPesan model
- [ ] Notification
- [ ] EmailLog model
- [ ] ActivityLog model

## Phase 8 --- Admin

- [ ] Admin dashboard
- [ ] User management
- [ ] Fakultas management
- [ ] Program studi management
- [ ] Tahun akademik management
- [ ] Mata kuliah management
- [ ] Kelas management

## Phase 9 --- Dosen

- [ ] Dashboard dosen
- [ ] Daftar kelas
- [ ] Materi
- [ ] Pengumuman
- [ ] Tugas
- [ ] Submission review
- [ ] Penilaian tugas
- [ ] Kuis
- [ ] Soal kuis
- [ ] Hasil attempt
- [ ] Diskusi

## Phase 10 --- Mahasiswa

- [ ] Dashboard mahasiswa
- [ ] Daftar kelas
- [ ] Detail kelas
- [ ] Materi
- [ ] Pengumuman
- [ ] Pengumpulan tugas
- [ ] Resubmission
- [ ] Kuis
- [ ] Nilai tugas
- [ ] Nilai kuis
- [ ] Diskusi

## Phase 11 --- Testing

- [ ] Authentication test
- [ ] Role authorization test
- [ ] Enrollment test
- [ ] Assignment submission test
- [ ] Resubmission test
- [ ] Multiple file upload test
- [ ] Assignment grading test
- [ ] Quiz attempt test
- [ ] Quiz answer test
- [ ] Discussion test
- [ ] Notification test

## Phase 12 --- Deployment

- [ ] Production environment
- [ ] Production database
- [ ] Environment variables
- [ ] Storage configuration
- [ ] Queue configuration jika diperlukan
- [ ] Email configuration
- [ ] Deployment
- [ ] Production testing
- [ ] Backup strategy

## Development Principles

1.  Selesaikan satu fase sebelum masuk fase berikutnya.
2.  Setiap fitur memiliki migration, model, validation, authorization,
    controller, view, dan test sesuai kebutuhan.
3.  Setiap perubahan penting dibuat dalam commit yang jelas.
4.  Error didokumentasikan dan diperbaiki sebelum melanjutkan fitur
    berikutnya.
5.  Database tidak diubah sembarangan tanpa memperbarui dokumentasi.

## Suggested Commit History

```text
chore: initialize Laravel project
docs: add system analysis
docs: add product requirements
docs: add ERD documentation
docs: add database schema
docs: add development progress
chore: install Laravel UI
feat: implement authentication
feat: add role authorization
feat: implement academic master data
feat: implement class management
feat: implement assignment submission
feat: implement quiz module
feat: implement discussion module
test: add feature tests
```

## Current Milestone

### Milestone 1 --- Planning & Design

**Status: Completed**

### Milestone 2 --- Project Setup

**Status: In Progress**

### Milestone 3 --- Authentication

**Status: Pending**

### Milestone 4 --- Database Implementation

**Status: Pending**

### Milestone 5 --- Core Features

**Status: Pending**

### Milestone 6 --- Testing & Deployment

**Status: Pending**
