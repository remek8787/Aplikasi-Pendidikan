import { redirect } from "next/navigation";

import { ModuleCard } from "@/components/module-card";
import { requireSessionForRole } from "@/lib/auth";
import { getModulesForRole, getRoleBySlug, getUnitByCode, modules } from "@/lib/platform-data";

type RoleDashboardPageProps = {
  params: Promise<{
    role: string;
  }>;
};

export default async function RoleDashboardPage({ params }: RoleDashboardPageProps) {
  const { role } = await params;
  const session = await requireSessionForRole(role);

  if (!session) {
    redirect("/login");
  }

  const roleDef = getRoleBySlug(role);

  if (!roleDef) {
    redirect("/dashboard");
  }

  const roleModules = getModulesForRole(session.roleCode);
  const unit = getUnitByCode(session.unitCode);
  const readyModules = modules.filter((module) => module.status === "Foundation Ready").length;

  return (
    <div className="space-y-8">
      <section className="rounded-[2rem] bg-slate-950 p-8 text-white shadow-2xl shadow-slate-900/10">
        <div className="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Dashboard role-based</p>
            <h1 className="mt-3 text-4xl font-semibold tracking-tight">{roleDef.name} Workspace</h1>
            <p className="mt-4 max-w-3xl text-sm leading-7 text-slate-300">
              Fokus role ini: {roleDef.focus.join(", ")}. Saat ini dashboard menjadi shell awal untuk menata prioritas fitur, data yang dibutuhkan, dan jalur implementasi MVP.
            </p>
          </div>

          <div className="grid gap-3 sm:grid-cols-3">
            <div className="rounded-3xl border border-white/10 bg-white/5 p-4">
              <p className="text-xs uppercase tracking-[0.28em] text-slate-500">Modul relevan</p>
              <p className="mt-2 text-3xl font-semibold text-white">{roleModules.length}</p>
            </div>
            <div className="rounded-3xl border border-white/10 bg-white/5 p-4">
              <p className="text-xs uppercase tracking-[0.28em] text-slate-500">Foundation ready</p>
              <p className="mt-2 text-3xl font-semibold text-white">{readyModules}</p>
            </div>
            <div className="rounded-3xl border border-white/10 bg-white/5 p-4">
              <p className="text-xs uppercase tracking-[0.28em] text-slate-500">Unit aktif</p>
              <p className="mt-2 text-xl font-semibold text-white">{unit?.code}</p>
              <p className="mt-1 text-xs text-slate-400">{unit?.name}</p>
            </div>
          </div>
        </div>
      </section>

      <section className="grid gap-5 lg:grid-cols-[1.3fr_0.7fr]">
        <article className="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5">
          <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Prioritas saat ini</p>
          <h2 className="mt-3 text-2xl font-semibold text-slate-950">Roadmap MVP untuk {roleDef.name}</h2>
          <ul className="mt-5 space-y-3 text-sm leading-7 text-slate-600">
            <li>• Pastikan modul inti role ini punya data master dan navigasi yang jelas.</li>
            <li>• Pecah kebutuhan menjadi: master data, transaksi, approval, laporan, notifikasi.</li>
            <li>• Sambungkan event penting ke WhatsApp supaya wali/siswa/staff selalu ter-update.</li>
            <li>• Siapkan audit trail untuk area sensitif seperti absensi, nilai, dan pembayaran.</li>
          </ul>
        </article>

        <article className="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm shadow-slate-900/5">
          <p className="text-xs uppercase tracking-[0.28em] text-slate-400">User context</p>
          <h2 className="mt-3 text-xl font-semibold text-slate-950">{session.name}</h2>
          <div className="mt-4 space-y-3 text-sm text-slate-600">
            <p>Email: {session.email}</p>
            <p>Role code: {session.roleCode}</p>
            <p>Unit: {unit?.name}</p>
            <p>Mode: demo session cookie-based</p>
          </div>
        </article>
      </section>

      <section>
        <div className="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
          <div>
            <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Modul kerja</p>
            <h2 className="mt-2 text-3xl font-semibold text-slate-950">Halaman placeholder siap dijadikan sprint berikutnya</h2>
          </div>
          <p className="max-w-xl text-sm leading-6 text-slate-600">
            Klik satu per satu untuk melihat scope MVP, integrasi data, dan saran implementasi tahap selanjutnya.
          </p>
        </div>

        <div className="mt-8 grid gap-5 xl:grid-cols-2">
          {roleModules.map((module) => (
            <ModuleCard key={module.slug} module={module} href={`/dashboard/${role}/modul/${module.slug}`} />
          ))}
        </div>
      </section>
    </div>
  );
}
