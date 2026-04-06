import Link from "next/link";

import { ModuleCard } from "@/components/module-card";
import { getSession } from "@/lib/auth";
import { architecturePillars, modules, roles, schoolUnits } from "@/lib/platform-data";

export default async function HomePage() {
  const session = await getSession();

  return (
    <div className="pb-20">
      <header className="mx-auto flex w-full max-w-7xl items-center justify-between px-6 py-6 lg:px-10">
        <Link href="/" className="inline-flex items-center gap-3 text-sm font-semibold text-slate-900">
          <span className="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-500 to-violet-500 text-white shadow-lg shadow-sky-500/25">
            AP
          </span>
          <span>
            <span className="block text-xs uppercase tracking-[0.3em] text-slate-400">Aplikasi Pendidikan</span>
            <span>v2 Foundation</span>
          </span>
        </Link>

        <div className="flex items-center gap-3">
          <Link
            href="/login"
            className="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-slate-300 hover:text-slate-950"
          >
            Demo login
          </Link>
          <Link
            href={session ? `/dashboard/${session.roleSlug}` : "/login"}
            className="rounded-full bg-slate-950 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-800"
          >
            {session ? "Masuk ke dashboard" : "Lihat dashboard"}
          </Link>
        </div>
      </header>

      <main className="mx-auto flex w-full max-w-7xl flex-col gap-16 px-6 lg:px-10">
        <section className="grid gap-10 rounded-[2rem] border border-slate-200/70 bg-white/90 p-8 shadow-2xl shadow-slate-900/5 backdrop-blur lg:grid-cols-[1.2fr_0.8fr] lg:p-12">
          <div>
            <span className="inline-flex rounded-full bg-sky-500/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-sky-700">
              Fresh rebuild · bukan tambal monolith lama
            </span>
            <h1 className="mt-6 max-w-3xl text-4xl font-semibold tracking-tight text-slate-950 sm:text-5xl">
              Pondasi modern untuk sistem pendidikan all-in-one SD / SMP / SMA.
            </h1>
            <p className="mt-6 max-w-2xl text-lg leading-8 text-slate-600">
              Rebuild v2 ini memisahkan arah produk baru dari kode PHP legacy. Fokusnya: UI modern,
              arsitektur jelas, dashboard per-role, placeholder modul utama, dan fondasi database yang siap
              dibesarkan.
            </p>

            <div className="mt-8 flex flex-wrap gap-3">
              {roles.map((role) => (
                <span
                  key={role.code}
                  className="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-700"
                >
                  {role.name}
                </span>
              ))}
            </div>

            <div className="mt-10 flex flex-wrap gap-4">
              <Link
                href="/login"
                className="rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
              >
                Coba login demo
              </Link>
              <Link
                href="#arsitektur"
                className="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:text-slate-950"
              >
                Lihat arsitektur
              </Link>
            </div>
          </div>

          <div className="grid gap-4">
            <div className="rounded-3xl bg-slate-950 p-6 text-white">
              <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Apa yang sudah hidup</p>
              <ul className="mt-5 space-y-3 text-sm text-slate-300">
                <li>• Landing page & product overview</li>
                <li>• Login UI dengan demo session per role</li>
                <li>• Dashboard shell role-based</li>
                <li>• Halaman placeholder untuk modul utama</li>
                <li>• Prisma schema + seed data awal</li>
              </ul>
            </div>

            <div className="rounded-3xl border border-slate-200 bg-slate-50 p-6">
              <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Segmen sekolah</p>
              <div className="mt-4 grid gap-3">
                {schoolUnits.map((unit) => (
                  <div key={unit.code} className="rounded-2xl bg-white p-4 shadow-sm shadow-slate-900/5">
                    <div className="flex items-center justify-between gap-4">
                      <h3 className="font-semibold text-slate-900">{unit.name}</h3>
                      <span className="rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-sky-700">
                        {unit.code}
                      </span>
                    </div>
                    <p className="mt-2 text-sm leading-6 text-slate-600">{unit.description}</p>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </section>

        <section id="arsitektur" className="grid gap-6 lg:grid-cols-3">
          {architecturePillars.map((pillar) => (
            <article key={pillar.title} className="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5">
              <p className="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Pilar</p>
              <h2 className="mt-3 text-xl font-semibold text-slate-950">{pillar.title}</h2>
              <p className="mt-3 text-sm leading-7 text-slate-600">{pillar.body}</p>
            </article>
          ))}
        </section>

        <section>
          <div className="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
              <p className="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Catalog modul</p>
              <h2 className="mt-2 text-3xl font-semibold text-slate-950">Semua domain utama sudah dipetakan di v2</h2>
            </div>
            <p className="max-w-xl text-sm leading-6 text-slate-600">
              Setiap kartu modul sudah punya jalur ke halaman detail placeholder yang menjelaskan ruang lingkup MVP, integrasi data, dan next build.
            </p>
          </div>

          <div className="mt-8 grid gap-5 lg:grid-cols-2 xl:grid-cols-3">
            {modules.map((module) => (
              <ModuleCard key={module.slug} module={module} href="/login" compact />
            ))}
          </div>
        </section>
      </main>
    </div>
  );
}
