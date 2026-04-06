import Link from "next/link";

import { getModulesForRole, getRoleBySlug, getUnitByCode, type DemoUser } from "@/lib/platform-data";

type DashboardShellProps = {
  roleSlug: string;
  session: {
    name: string;
    email: string;
    roleCode: DemoUser["roleCode"];
    unitCode: DemoUser["unitCode"];
  };
  children: React.ReactNode;
};

export function DashboardShell({ roleSlug, session, children }: DashboardShellProps) {
  const role = getRoleBySlug(roleSlug);

  if (!role) {
    throw new Error("Role dashboard tidak ditemukan.");
  }

  const unit = getUnitByCode(session.unitCode);
  const modules = getModulesForRole(session.roleCode);

  return (
    <div className="min-h-screen bg-slate-950 text-slate-50">
      <div className="mx-auto grid min-h-screen max-w-7xl lg:grid-cols-[280px_1fr]">
        <aside className="border-b border-white/10 bg-slate-950/95 p-6 lg:border-r lg:border-b-0">
          <Link href="/" className="inline-flex items-center gap-3 text-sm font-semibold text-white">
            <span className="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-500 to-violet-500 text-lg font-bold">
              AP
            </span>
            <span>
              <span className="block text-xs uppercase tracking-[0.3em] text-slate-400">Aplikasi Pendidikan</span>
              <span>v2 Foundation</span>
            </span>
          </Link>

          <div className={`mt-8 rounded-3xl bg-gradient-to-br ${role.accent} p-[1px]`}>
            <div className="rounded-[calc(1.5rem-1px)] bg-slate-950/90 p-5">
              <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Session aktif</p>
              <h2 className="mt-3 text-xl font-semibold text-white">{session.name}</h2>
              <p className="mt-1 text-sm text-slate-300">{role.name} · {unit?.name}</p>
              <p className="mt-2 text-sm text-slate-400">{session.email}</p>
            </div>
          </div>

          <nav className="mt-8 space-y-2">
            <p className="mb-3 text-xs uppercase tracking-[0.28em] text-slate-500">Modul prioritas</p>
            <Link href={`/dashboard/${roleSlug}`} className="flex rounded-2xl bg-white/5 px-4 py-3 text-sm font-medium text-white transition hover:bg-white/10">
              Ringkasan dashboard
            </Link>
            {modules.map((module) => (
              <Link
                key={module.slug}
                href={`/dashboard/${roleSlug}/modul/${module.slug}`}
                className="flex rounded-2xl px-4 py-3 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white"
              >
                {module.name}
              </Link>
            ))}
          </nav>

          <div className="mt-8 rounded-3xl border border-white/10 bg-white/5 p-5">
            <p className="text-xs uppercase tracking-[0.28em] text-slate-500">Catatan pondasi</p>
            <ul className="mt-4 space-y-3 text-sm text-slate-300">
              <li>• Versi hosting ini berjalan sebagai static preview untuk validasi alur UI.</li>
              <li>• Database starter disiapkan via Prisma + SQLite.</li>
              <li>• Target berikutnya: auth nyata, API, dan workflow tiap modul.</li>
            </ul>
          </div>

          <div className="mt-8">
            <Link
              href="/login/"
              className="flex w-full items-center justify-center rounded-2xl border border-white/10 px-4 py-3 text-sm font-medium text-slate-200 transition hover:border-white/20 hover:bg-white/5 hover:text-white"
            >
              Kembali ke pilih role
            </Link>
          </div>
        </aside>

        <main className="bg-slate-50 text-slate-950">
          <div className="mx-auto flex min-h-screen w-full max-w-5xl flex-col px-6 py-8 lg:px-10">{children}</div>
        </main>
      </div>
    </div>
  );
}
