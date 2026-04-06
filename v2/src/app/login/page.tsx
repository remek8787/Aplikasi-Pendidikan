import Link from "next/link";

import { demoUsers, getRoleByCode, getUnitByCode } from "@/lib/platform-data";

export default function LoginPage() {
  return (
    <div className="min-h-screen bg-slate-950 px-6 py-8 text-white lg:px-10">
      <div className="mx-auto grid min-h-[calc(100vh-4rem)] max-w-6xl gap-8 lg:grid-cols-[1fr_520px]">
        <section className="flex flex-col justify-between rounded-[2rem] border border-white/10 bg-gradient-to-br from-sky-500/20 via-slate-900 to-violet-500/20 p-8 shadow-2xl shadow-sky-950/20">
          <div>
            <Link href="/" className="inline-flex items-center gap-3 text-sm font-semibold text-white">
              <span className="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/10">AP</span>
              <span>
                <span className="block text-xs uppercase tracking-[0.3em] text-slate-300">Aplikasi Pendidikan</span>
                <span>v2 preview access</span>
              </span>
            </Link>

            <h1 className="mt-10 max-w-xl text-4xl font-semibold tracking-tight text-white">
              Preview role-based dashboard untuk fondasi web app pendidikan baru.
            </h1>
            <p className="mt-5 max-w-2xl text-lg leading-8 text-slate-300">
              Karena hosting saat ini tipe shared hosting, versi yang dideploy adalah preview statis dari pondasi v2.
              Tujuannya supaya Tuan Besar bisa lihat arah UI, struktur role, dan peta modul langsung di web.
            </p>
          </div>

          <div className="grid gap-4 md:grid-cols-2">
            {demoUsers.map((user) => {
              const role = getRoleByCode(user.roleCode);
              const unit = getUnitByCode(user.unitCode);

              return (
                <div key={user.email} className="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                  <p className="text-xs uppercase tracking-[0.28em] text-slate-400">{role?.name}</p>
                  <h2 className="mt-2 text-lg font-semibold text-white">{user.name}</h2>
                  <p className="mt-1 text-sm text-slate-300">{user.badge}</p>
                  <div className="mt-4 space-y-1 text-sm text-slate-300">
                    <p>{user.email}</p>
                    <p>Password demo: {user.password}</p>
                    <p>Unit: {unit?.name}</p>
                  </div>
                </div>
              );
            })}
          </div>
        </section>

        <section className="rounded-[2rem] bg-white p-8 text-slate-950 shadow-2xl shadow-slate-900/25">
          <div>
            <p className="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Masuk preview</p>
            <h2 className="mt-3 text-3xl font-semibold text-slate-950">Pilih role untuk melihat dashboard</h2>
            <p className="mt-3 text-sm leading-7 text-slate-600">
              Di mode preview hosting ini, login dibuat sebagai tautan langsung ke dashboard tiap role supaya bisa tampil tanpa runtime Node.js.
            </p>
          </div>

          <div className="mt-8 space-y-4">
            {demoUsers.map((user) => {
              const role = getRoleByCode(user.roleCode);
              const roleSlug = role?.code.toLowerCase();
              return (
                <Link
                  key={user.email}
                  href={roleSlug ? `/dashboard/${roleSlug}/` : "/dashboard/"}
                  className="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 text-sm transition hover:border-sky-300 hover:bg-white"
                >
                  <div>
                    <p className="font-semibold text-slate-950">{role?.name} — {user.name}</p>
                    <p className="mt-1 text-slate-500">{user.email}</p>
                  </div>
                  <span className="rounded-full bg-slate-950 px-3 py-1 text-xs font-semibold text-white">Buka</span>
                </Link>
              );
            })}
          </div>

          <div className="mt-8 rounded-3xl border border-slate-200 bg-slate-50 p-5">
            <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Catatan deploy</p>
            <ul className="mt-4 space-y-3 text-sm leading-6 text-slate-600">
              <li>• Ini adalah static preview agar bisa tayang di hosting sekarang.</li>
              <li>• Untuk login nyata, session, dan CRUD penuh tetap butuh runtime Node / VPS / platform app hosting.</li>
              <li>• Struktur UI, role, modul, dan arsitektur tetap sudah siap dilanjutkan ke fase production.</li>
            </ul>
          </div>
        </section>
      </div>
    </div>
  );
}
