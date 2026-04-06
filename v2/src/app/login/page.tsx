import Link from "next/link";
import { redirect } from "next/navigation";

import { loginAction } from "@/app/login/actions";
import { getSession } from "@/lib/auth";
import { demoUsers, getRoleByCode, getUnitByCode } from "@/lib/platform-data";

type LoginPageProps = {
  searchParams: Promise<{
    error?: string;
  }>;
};

export default async function LoginPage({ searchParams }: LoginPageProps) {
  const [session, resolvedSearchParams] = await Promise.all([getSession(), searchParams]);

  if (session) {
    redirect(`/dashboard/${session.roleSlug}`);
  }

  const errorMessage = resolvedSearchParams.error === "missing-email" ? "Pilih akun demo dulu." : null;

  return (
    <div className="min-h-screen bg-slate-950 px-6 py-8 text-white lg:px-10">
      <div className="mx-auto grid min-h-[calc(100vh-4rem)] max-w-6xl gap-8 lg:grid-cols-[1fr_520px]">
        <section className="flex flex-col justify-between rounded-[2rem] border border-white/10 bg-gradient-to-br from-sky-500/20 via-slate-900 to-violet-500/20 p-8 shadow-2xl shadow-sky-950/20">
          <div>
            <Link href="/" className="inline-flex items-center gap-3 text-sm font-semibold text-white">
              <span className="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/10">AP</span>
              <span>
                <span className="block text-xs uppercase tracking-[0.3em] text-slate-300">Aplikasi Pendidikan</span>
                <span>v2 demo access</span>
              </span>
            </Link>

            <h1 className="mt-10 max-w-xl text-4xl font-semibold tracking-tight text-white">
              Login demo untuk melihat dashboard sesuai peran sekolah.
            </h1>
            <p className="mt-5 max-w-2xl text-lg leading-8 text-slate-300">
              Saat ini autentikasi masih mode demo. Tujuannya buat validasi UX, navigasi, dan struktur modul
              sebelum masuk ke auth production dan integrasi database penuh.
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
            <p className="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Masuk demo</p>
            <h2 className="mt-3 text-3xl font-semibold text-slate-950">Pilih akun role</h2>
            <p className="mt-3 text-sm leading-7 text-slate-600">
              Login ini langsung membuat session cookie ringan lalu mengarahkan ke dashboard role yang sesuai.
            </p>
          </div>

          <form action={loginAction} className="mt-8 space-y-5">
            <div className="space-y-2">
              <label htmlFor="email" className="text-sm font-medium text-slate-700">
                Akun demo
              </label>
              <select
                id="email"
                name="email"
                defaultValue={demoUsers[0]?.email}
                className="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-400 focus:bg-white"
              >
                {demoUsers.map((user) => {
                  const role = getRoleByCode(user.roleCode);
                  return (
                    <option key={user.email} value={user.email}>
                      {role?.name} — {user.name} ({user.email})
                    </option>
                  );
                })}
              </select>
            </div>

            <div className="space-y-2">
              <label htmlFor="password" className="text-sm font-medium text-slate-700">
                Password demo
              </label>
              <input
                id="password"
                value="demo123"
                readOnly
                className="w-full rounded-2xl border border-slate-200 bg-slate-100 px-4 py-3 text-sm text-slate-500 outline-none"
              />
            </div>

            {errorMessage ? (
              <div className="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                {errorMessage}
              </div>
            ) : null}

            <button
              type="submit"
              className="w-full rounded-2xl bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
            >
              Masuk ke dashboard demo
            </button>
          </form>

          <div className="mt-8 rounded-3xl border border-slate-200 bg-slate-50 p-5">
            <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Catatan implementasi</p>
            <ul className="mt-4 space-y-3 text-sm leading-6 text-slate-600">
              <li>• Session saat ini sengaja ringan supaya fokus validasi experience dulu.</li>
              <li>• Auth production bisa diganti ke Auth.js / custom credentials + Prisma.</li>
              <li>• Proxy route guard sudah menjaga area `/dashboard/*` agar minimal butuh session.</li>
            </ul>
          </div>
        </section>
      </div>
    </div>
  );
}
