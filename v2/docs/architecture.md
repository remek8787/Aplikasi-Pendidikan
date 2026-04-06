# Arsitektur v2

## Kenapa rebuild baru?

Kode legacy PHP tetap dipertahankan sebagai referensi fitur, tapi v2 dibangun terpisah supaya:

- tidak terikat coupling monolith lama,
- lebih gampang pecah modul, role, dan workflow,
- siap pindah dari MVP ke production tanpa refactor total.

## Stack yang dipilih

- **Next.js 16 + App Router**
- **TypeScript**
- **Tailwind CSS 4**
- **Prisma ORM**
- **SQLite untuk local MVP**, dengan model yang tetap lurus kalau nanti pindah ke PostgreSQL

## Struktur folder utama

```text
v2/
├── docs/
│   └── architecture.md
├── prisma/
│   ├── schema.prisma
│   └── seed.ts
├── src/
│   ├── app/
│   │   ├── dashboard/
│   │   ├── login/
│   │   ├── globals.css
│   │   ├── layout.tsx
│   │   └── page.tsx
│   ├── components/
│   │   ├── dashboard-shell.tsx
│   │   └── module-card.tsx
│   └── lib/
│       ├── auth.ts
│       └── platform-data.ts
└── README.md
```

## Prinsip implementasi

### 1. Server-first
Mayoritas page adalah Server Components. Ini lebih cocok untuk dashboard sekolah yang banyak data, kontrol akses, dan reporting.

### 2. Role-based shell
Dashboard dipisah per role (`admin`, `guru`, `siswa`, `staff`, `pengawas`) dengan satu layout bersama, supaya nanti permission logic bisa tumbuh tanpa duplikasi UI besar.

### 3. Module-driven product map
Setiap modul besar punya:

- status implementasi,
- scope kemampuan,
- checklist MVP,
- integrasi dengan modul lain.

Ini bikin sprint berikutnya bisa langsung masuk ke eksekusi, bukan debat scope dari nol.

### 4. DB foundation dulu, auth production belakangan
Untuk satu jam pertama, login dibuat mode demo cookie-based agar UI dan flow hidup cepat. Tapi Prisma schema sudah menyiapkan pondasi user, role, unit sekolah, catalog modul, dan channel notifikasi.

## Tahap lanjut yang paling masuk akal

1. Ganti demo auth ke auth nyata (Auth.js atau custom credentials).
2. Tambah tabel domain inti: kelas, mapel, academic year, enrollment, attendance, invoice, exam.
3. Hubungkan tiap modul ke server action / route handler.
4. Tambah audit log dan permission matrix.
5. Integrasikan WhatsApp gateway / queue untuk notifikasi event-driven.
