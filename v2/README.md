# Aplikasi Pendidikan v2

Fresh rebuild foundation untuk **Aplikasi-Pendidikan** dengan pendekatan modern web app.

> Status: **MVP foundation / starter**
> 
> Legacy PHP tetap ada di root repo sebagai referensi fitur, tapi **v2 ini tidak bergantung ke implementasi lama**.

## Stack yang dipilih

- **Next.js 16** (App Router)
- **TypeScript**
- **Tailwind CSS 4**
- **Prisma ORM**
- **SQLite** untuk bootstrap lokal, siap diarahkan ke PostgreSQL nantinya

## Yang sudah dibangun

### Product / UX foundation
- landing page / overview baru
- login page UI untuk demo role-based access
- dashboard shell per role:
  - Admin
  - Guru
  - Siswa
  - Staff
  - Pengawas
- halaman placeholder untuk modul utama:
  - KBM
  - Absensi
  - CBT/AKM
  - E-Learning
  - Raport
  - SKL
  - Konseling
  - Administrasi
  - Pustaka
  - Payment/SPP
  - Kantin
  - Sarpras
  - Laporan Bulanan
  - Prakerin/PKL
  - WhatsApp Notification Hub

### Architecture / code foundation
- App Router structure yang bersih dan terpisah dari PHP legacy
- proxy sederhana untuk jaga area dashboard
- session demo cookie-based untuk validasi flow cepat
- source-of-truth data role, modul, dan demo users di `src/lib/platform-data.ts`
- dokumentasi arsitektur di `docs/architecture.md`

### Database starter
- Prisma schema awal untuk:
  - roles
  - users
  - school units
  - feature modules
  - notification channels
- seed data awal untuk roles, unit, modul, dan demo users

## Cara jalanin

Masuk ke folder v2:

```bash
cd v2
```

Install dependency (kalau belum):

```bash
npm install
```

Siapkan environment:

```bash
cp .env.example .env
```

Generate database lokal + schema:

```bash
npm run db:push
```

Isi seed starter:

```bash
npm run db:seed
```

Jalankan app:

```bash
npm run dev
```

Buka:

- `http://localhost:3000`

## Demo accounts

Semua akun demo memakai password:

```text
demo123
```

Akun yang tersedia:

- `admin@demo.apdik.local`
- `guru@demo.apdik.local`
- `siswa@demo.apdik.local`
- `staff@demo.apdik.local`
- `pengawas@demo.apdik.local`

> Catatan: login saat ini masih demo flow untuk mempercepat validasi UI/arsitektur. Belum auth production.

## File penting

```text
v2/
├── docs/architecture.md
├── prisma/schema.prisma
├── prisma/seed.ts
├── src/app/page.tsx
├── src/app/login/page.tsx
├── src/app/dashboard/[role]/page.tsx
├── src/app/dashboard/[role]/modul/[slug]/page.tsx
├── src/components/dashboard-shell.tsx
├── src/components/module-card.tsx
├── src/lib/auth.ts
└── src/lib/platform-data.ts
```

## Yang sengaja belum dikerjakan

Supaya tetap practical dalam target sekitar 1 jam, bagian berikut **belum dibangun penuh**:

- auth production + password hash sesungguhnya
- CRUD tiap modul
- API/route handler domain
- RBAC granular per action
- tabel domain detail (kelas, rombel, mapel, invoice, attendance records, exam attempts, dll)
- integrasi WhatsApp gateway nyata
- export PDF / Excel
- dashboard analytics real-time

## Next steps paling masuk akal

1. **Auth nyata**
   - Auth.js / custom credentials + Prisma
   - password hash
   - session management production-ready

2. **Master data akademik**
   - tahun ajaran
   - kelas / rombel
   - mapel
   - guru mapel
   - siswa / wali

3. **3 modul MVP dulu**
   - Absensi
   - KBM / E-Learning
   - Payment / SPP

4. **Lapis komunikasi**
   - template WhatsApp
   - queue pengiriman
   - log status pesan

5. **Governance**
   - audit log
   - approval flow
   - laporan bulanan otomatis

## Catatan build cepat

Target pengerjaan ini adalah **foundation yang kelihatan, jalan, dan enak dilanjutkan** — bukan menyelesaikan semua domain pendidikan sekaligus.

Jadi fokusnya memang:

- pisah dari legacy,
- kasih struktur modern,
- bikin dashboard hidup,
- mapping semua modul utama,
- dan siapkan landasan data supaya sprint berikutnya tidak mulai dari nol.
