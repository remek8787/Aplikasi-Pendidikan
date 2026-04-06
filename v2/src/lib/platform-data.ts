export const roleOrder = ["ADMIN", "GURU", "SISWA", "STAFF", "PENGAWAS"] as const;
export type RoleCode = (typeof roleOrder)[number];

export type EducationLevel = "SD" | "SMP" | "SMA";
export type ModuleStatus = "Foundation Ready" | "MVP Planning" | "Discovery";

export type RoleDefinition = {
  code: RoleCode;
  name: string;
  description: string;
  focus: string[];
  accent: string;
};

export type SchoolUnitDefinition = {
  code: EducationLevel;
  name: string;
  description: string;
};

export type ModuleDefinition = {
  slug: string;
  code: string;
  name: string;
  short: string;
  description: string;
  category: "Akademik" | "Operasional" | "Layanan" | "Keuangan";
  status: ModuleStatus;
  ownerRoles: RoleCode[];
  capabilities: string[];
  mvpChecklist: string[];
  integrations: string[];
};

export type DemoUser = {
  email: string;
  password: string;
  name: string;
  roleCode: RoleCode;
  unitCode: EducationLevel;
  badge: string;
};

export const schoolUnits: SchoolUnitDefinition[] = [
  {
    code: "SD",
    name: "SD / Dasar",
    description: "Fokus administrasi kelas awal, penilaian dasar, dan keterlibatan orang tua.",
  },
  {
    code: "SMP",
    name: "SMP / Menengah Pertama",
    description: "Fokus jadwal KBM, penilaian berjenjang, dan pembinaan karakter.",
  },
  {
    code: "SMA",
    name: "SMA / Menengah Atas",
    description: "Fokus akademik lanjut, CBT/AKM, prakerin, dan kesiapan kelulusan.",
  },
];

export const roles: RoleDefinition[] = [
  {
    code: "ADMIN",
    name: "Admin",
    description: "Pengendali master data, konfigurasi sekolah, dan monitoring keseluruhan platform.",
    focus: ["master data", "governance", "reporting", "integrasi"],
    accent: "from-sky-500 to-cyan-400",
  },
  {
    code: "GURU",
    name: "Guru",
    description: "Mengelola proses KBM, materi, tugas, penilaian, absensi, dan raport.",
    focus: ["KBM", "penilaian", "absensi", "e-learning"],
    accent: "from-emerald-500 to-lime-400",
  },
  {
    code: "SISWA",
    name: "Siswa",
    description: "Mengakses pembelajaran, tugas, ujian, jadwal, tagihan, dan progres akademik.",
    focus: ["belajar", "ujian", "raport", "tagihan"],
    accent: "from-violet-500 to-fuchsia-400",
  },
  {
    code: "STAFF",
    name: "Staff",
    description: "Menangani administrasi, pustaka, sarpras, pembayaran, dan operasional sekolah.",
    focus: ["administrasi", "sarana", "pustaka", "payment"],
    accent: "from-amber-500 to-orange-400",
  },
  {
    code: "PENGAWAS",
    name: "Pengawas",
    description: "Memantau mutu, kepatuhan, capaian unit, dan ringkasan laporan sekolah.",
    focus: ["audit", "monitoring", "mutu", "evaluasi"],
    accent: "from-rose-500 to-pink-400",
  },
];

export const modules: ModuleDefinition[] = [
  {
    slug: "kbm",
    code: "KBM",
    name: "KBM & Jadwal",
    short: "Kelola jadwal, kelas, materi, dan agenda pembelajaran.",
    description:
      "Menjadi pusat kegiatan belajar mengajar: kalender akademik, jadwal, rombel, materi mingguan, dan progres kelas.",
    category: "Akademik",
    status: "Foundation Ready",
    ownerRoles: ["ADMIN", "GURU", "PENGAWAS"],
    capabilities: ["kalender akademik", "jadwal pelajaran", "rombel dan wali kelas", "agenda per pertemuan"],
    mvpChecklist: ["master rombel", "jadwal mingguan", "agenda mengajar", "dashboard keterlaksanaan"],
    integrations: ["Absensi", "E-Learning", "Raport"],
  },
  {
    slug: "absensi",
    code: "ABS",
    name: "Absensi",
    short: "Presensi siswa dan pegawai dengan rekap harian sampai bulanan.",
    description:
      "Presensi terpusat untuk siswa, guru, dan staff. Siap berkembang ke QR, fingerprint, face recognition, atau WhatsApp reminder.",
    category: "Akademik",
    status: "Foundation Ready",
    ownerRoles: ["ADMIN", "GURU", "STAFF", "PENGAWAS"],
    capabilities: ["presensi siswa", "presensi pegawai", "rekap izin/sakit/alpa", "notifikasi keterlambatan"],
    mvpChecklist: ["input kehadiran", "rekap kelas", "rekap pegawai", "export bulanan"],
    integrations: ["KBM", "Laporan Bulanan", "WhatsApp Notification Hub"],
  },
  {
    slug: "cbt-akm",
    code: "CBT",
    name: "CBT & AKM",
    short: "Bank soal, ujian online, paket asesmen, dan analitik hasil.",
    description:
      "Fondasi computer based test untuk penilaian harian, PAS, tryout, dan asesmen minimum berbasis web.",
    category: "Akademik",
    status: "MVP Planning",
    ownerRoles: ["ADMIN", "GURU", "SISWA", "PENGAWAS"],
    capabilities: ["bank soal", "jadwal ujian", "paket soal adaptif", "analitik hasil"],
    mvpChecklist: ["daftar ujian", "paket soal dasar", "timer ujian", "ringkasan nilai"],
    integrations: ["KBM", "Raport", "Laporan Bulanan"],
  },
  {
    slug: "e-learning",
    code: "ELRN",
    name: "E-Learning",
    short: "Materi, tugas, diskusi, dan alur belajar mandiri siswa.",
    description:
      "Portal pembelajaran digital untuk materi kelas, assignment, deadline, dan progress student activity.",
    category: "Akademik",
    status: "Foundation Ready",
    ownerRoles: ["ADMIN", "GURU", "SISWA"],
    capabilities: ["materi per mapel", "unggah tugas", "komentar/umpan balik", "tracking progres"],
    mvpChecklist: ["daftar materi", "detail materi", "tugas sederhana", "status selesai"],
    integrations: ["KBM", "CBT & AKM", "WhatsApp Notification Hub"],
  },
  {
    slug: "raport",
    code: "RPT",
    name: "Raport",
    short: "Kompilasi nilai akhir, sikap, kehadiran, dan catatan wali kelas.",
    description:
      "Menyatukan penilaian formatif, sumatif, ekstrakurikuler, dan rekap kehadiran menjadi raport digital.",
    category: "Akademik",
    status: "MVP Planning",
    ownerRoles: ["ADMIN", "GURU", "SISWA", "PENGAWAS"],
    capabilities: ["nilai per kompetensi", "catatan wali kelas", "rekap absensi", "publikasi raport"],
    mvpChecklist: ["template raport", "import nilai", "preview raport", "status publikasi"],
    integrations: ["KBM", "Absensi", "CBT & AKM", "SKL"],
  },
  {
    slug: "skl",
    code: "SKL",
    name: "SKL & Kelulusan",
    short: "Pengelolaan surat kelulusan, arsip, dan status alumni.",
    description:
      "Mengatur proses kelulusan, penerbitan SKL, dan arsip dokumen siswa yang siap unduh atau cetak.",
    category: "Layanan",
    status: "Discovery",
    ownerRoles: ["ADMIN", "STAFF", "SISWA", "PENGAWAS"],
    capabilities: ["status kelulusan", "arsip SKL", "verifikasi dokumen", "riwayat cetak"],
    mvpChecklist: ["template dokumen", "status lulus", "download SKL", "audit trail"],
    integrations: ["Raport", "Administrasi"],
  },
  {
    slug: "konseling",
    code: "BK",
    name: "Konseling",
    short: "Catatan pembinaan siswa, kasus, follow-up, dan komunikasi wali.",
    description:
      "Ruang kerja guru BK/wali untuk mencatat intervensi, kasus, dan tindak lanjut pembinaan siswa.",
    category: "Layanan",
    status: "Discovery",
    ownerRoles: ["ADMIN", "GURU", "STAFF", "PENGAWAS"],
    capabilities: ["kasus siswa", "timeline tindak lanjut", "catatan wali", "status penyelesaian"],
    mvpChecklist: ["pencatatan kasus", "timeline follow-up", "status penanganan", "rekap per kelas"],
    integrations: ["Absensi", "WhatsApp Notification Hub"],
  },
  {
    slug: "administrasi",
    code: "ADM",
    name: "Administrasi",
    short: "Surat menyurat, master data, arsip, dan operasional back-office.",
    description:
      "Modul operasional umum untuk data sekolah, surat, pengumuman, dan arsip dokumen penting.",
    category: "Operasional",
    status: "Foundation Ready",
    ownerRoles: ["ADMIN", "STAFF", "PENGAWAS"],
    capabilities: ["master data", "arsip surat", "pengumuman", "log aktivitas"],
    mvpChecklist: ["master sekolah", "template surat", "pengumuman internal", "arsip digital"],
    integrations: ["SKL", "Laporan Bulanan", "WhatsApp Notification Hub"],
  },
  {
    slug: "pustaka",
    code: "LIB",
    name: "Pustaka",
    short: "Katalog buku, peminjaman, pengembalian, dan status koleksi.",
    description:
      "Sistem perpustakaan sekolah untuk koleksi buku, sirkulasi, denda, dan riwayat pinjam siswa/guru.",
    category: "Layanan",
    status: "MVP Planning",
    ownerRoles: ["ADMIN", "STAFF", "SISWA", "GURU"],
    capabilities: ["katalog buku", "peminjaman", "pengembalian", "status stok"],
    mvpChecklist: ["master buku", "transaksi pinjam", "transaksi kembali", "rekap keterlambatan"],
    integrations: ["Administrasi", "WhatsApp Notification Hub"],
  },
  {
    slug: "payment",
    code: "PAY",
    name: "Payment & SPP",
    short: "Tagihan, pembayaran, jurnal penerimaan, dan rekap tunggakan.",
    description:
      "Menangani semua transaksi siswa: SPP, registrasi, kegiatan, dan pembayaran terverifikasi.",
    category: "Keuangan",
    status: "Foundation Ready",
    ownerRoles: ["ADMIN", "STAFF", "SISWA", "PENGAWAS"],
    capabilities: ["billing siswa", "status pembayaran", "rekap tunggakan", "kwitansi"],
    mvpChecklist: ["invoice sederhana", "konfirmasi bayar", "riwayat pembayaran", "ringkasan piutang"],
    integrations: ["Administrasi", "WhatsApp Notification Hub", "Laporan Bulanan"],
  },
  {
    slug: "kantin",
    code: "KNT",
    name: "Kantin",
    short: "POS sederhana, topup saldo, dan monitoring transaksi siswa.",
    description:
      "Siap dikembangkan menjadi smart canteen dengan saldo siswa, transaksi harian, dan dashboard menu.",
    category: "Keuangan",
    status: "Discovery",
    ownerRoles: ["ADMIN", "STAFF", "SISWA"],
    capabilities: ["menu dan harga", "transaksi kasir", "saldo siswa", "laporan penjualan"],
    mvpChecklist: ["master menu", "POS ringan", "histori transaksi", "ringkasan harian"],
    integrations: ["Payment & SPP", "Laporan Bulanan"],
  },
  {
    slug: "sarpras",
    code: "SPR",
    name: "Sarpras",
    short: "Inventaris aset, pemeliharaan, dan pengajuan kebutuhan ruang/fasilitas.",
    description:
      "Memetakan aset sekolah, kondisi barang, jadwal maintenance, dan permintaan pengadaan.",
    category: "Operasional",
    status: "MVP Planning",
    ownerRoles: ["ADMIN", "STAFF", "PENGAWAS"],
    capabilities: ["inventaris aset", "status kondisi", "maintenance", "pengajuan kebutuhan"],
    mvpChecklist: ["master aset", "status kondisi", "jadwal servis", "rekap pengadaan"],
    integrations: ["Administrasi", "Laporan Bulanan"],
  },
  {
    slug: "laporan-bulanan",
    code: "LAP",
    name: "Laporan Bulanan",
    short: "Ringkasan KPI sekolah per unit, kehadiran, keuangan, dan mutu layanan.",
    description:
      "Mengonsolidasikan data dari modul lain menjadi laporan periodik untuk kepala sekolah dan pengawas.",
    category: "Operasional",
    status: "Foundation Ready",
    ownerRoles: ["ADMIN", "STAFF", "PENGAWAS"],
    capabilities: ["rekap KPI", "snapshot keuangan", "rekap absensi", "insight lintas modul"],
    mvpChecklist: ["template laporan", "summary per unit", "status pengumpulan", "export PDF"],
    integrations: ["Absensi", "Payment & SPP", "Sarpras", "KBM"],
  },
  {
    slug: "prakerin",
    code: "PKL",
    name: "Prakerin / PKL",
    short: "Penempatan, monitoring, jurnal kegiatan, dan evaluasi pembimbing industri.",
    description:
      "Sangat relevan untuk jenjang menengah atas atau vokasi: mengelola partner, peserta, dan evaluasi magang.",
    category: "Akademik",
    status: "Discovery",
    ownerRoles: ["ADMIN", "GURU", "SISWA", "PENGAWAS"],
    capabilities: ["tempat magang", "jurnal harian", "monitoring pembimbing", "penilaian industri"],
    mvpChecklist: ["daftar partner", "penempatan siswa", "jurnal mingguan", "status monitoring"],
    integrations: ["Raport", "WhatsApp Notification Hub"],
  },
  {
    slug: "whatsapp-notifications",
    code: "WA",
    name: "WhatsApp Notification Hub",
    short: "Router notifikasi untuk absensi, tagihan, pengumuman, dan reminder penting.",
    description:
      "Lapis komunikasi lintas modul untuk wali murid, guru, siswa, dan staff lewat template broadcast/event-driven.",
    category: "Layanan",
    status: "Foundation Ready",
    ownerRoles: ["ADMIN", "STAFF", "GURU"],
    capabilities: ["template pesan", "event trigger", "log pengiriman", "segment penerima"],
    mvpChecklist: ["template dasar", "queue notifikasi", "preview pesan", "riwayat kirim"],
    integrations: ["Absensi", "Payment & SPP", "Administrasi", "Pustaka", "Prakerin"],
  },
];

export const demoUsers: DemoUser[] = [
  {
    email: "admin@demo.apdik.local",
    password: "demo123",
    name: "Nadia Admin",
    roleCode: "ADMIN",
    unitCode: "SMA",
    badge: "Owner platform & master data",
  },
  {
    email: "guru@demo.apdik.local",
    password: "demo123",
    name: "Rizky Guru",
    roleCode: "GURU",
    unitCode: "SMP",
    badge: "Wali kelas & mapel IPA",
  },
  {
    email: "siswa@demo.apdik.local",
    password: "demo123",
    name: "Alya Siswa",
    roleCode: "SISWA",
    unitCode: "SMA",
    badge: "Siswa kelas XI",
  },
  {
    email: "staff@demo.apdik.local",
    password: "demo123",
    name: "Bagas Staff",
    roleCode: "STAFF",
    unitCode: "SD",
    badge: "TU, pustaka, dan kas sekolah",
  },
  {
    email: "pengawas@demo.apdik.local",
    password: "demo123",
    name: "Maya Pengawas",
    roleCode: "PENGAWAS",
    unitCode: "SMA",
    badge: "Pengawas mutu & kepatuhan",
  },
];

export const architecturePillars = [
  {
    title: "App Router + Server Components",
    body: "Mayoritas halaman tetap server-rendered agar ringan, jelas, dan aman untuk ekspansi fitur admin yang kompleks.",
  },
  {
    title: "Prisma schema PostgreSQL-ready",
    body: "MVP memakai SQLite untuk start cepat, tetapi model dan arsitektur disiapkan supaya migrasi ke PostgreSQL tetap lurus.",
  },
  {
    title: "Module-driven roadmap",
    body: "Setiap modul punya halaman placeholder, scope MVP, integrasi data, dan daftar pekerjaan lanjut supaya eksekusi berikutnya terarah.",
  },
];

export const mvpStreams = [
  "Foundation UI: landing, login, dashboard shell, halaman modul",
  "Identity & role mapping: Admin, Guru, Siswa, Staff, Pengawas",
  "Database starter: roles, users, school units, module catalog, notification channels",
  "Roadmap jelas untuk modul akademik, operasional, layanan, dan keuangan",
];

export function getRoleByCode(roleCode: RoleCode) {
  return roles.find((role) => role.code === roleCode);
}

export function getRoleBySlug(slug: string) {
  return roles.find((role) => role.code.toLowerCase() === slug.toLowerCase());
}

export function getUnitByCode(code: EducationLevel) {
  return schoolUnits.find((unit) => unit.code === code);
}

export function getModuleBySlug(slug: string) {
  return modules.find((module) => module.slug === slug);
}

export function getModulesForRole(roleCode: RoleCode) {
  return modules.filter((module) => module.ownerRoles.includes(roleCode));
}

export function getDemoUserByEmail(email: string) {
  return demoUsers.find((user) => user.email.toLowerCase() === email.toLowerCase());
}

export function getDemoUserByRoleSlug(roleSlug: string) {
  const role = getRoleBySlug(roleSlug);

  if (!role) {
    return null;
  }

  return demoUsers.find((user) => user.roleCode === role.code) ?? null;
}
