import Link from "next/link";
import { notFound, redirect } from "next/navigation";

import { requireSessionForRole } from "@/lib/auth";
import { getModuleBySlug, getRoleBySlug } from "@/lib/platform-data";

type ModuleDetailPageProps = {
  params: Promise<{
    role: string;
    slug: string;
  }>;
};

export default async function ModuleDetailPage({ params }: ModuleDetailPageProps) {
  const { role, slug } = await params;
  const session = await requireSessionForRole(role);

  if (!session) {
    redirect("/login");
  }

  const roleDef = getRoleBySlug(role);
  const feature = getModuleBySlug(slug);

  if (!roleDef || !feature) {
    notFound();
  }

  return (
    <div className="space-y-8">
      <div className="flex flex-wrap items-center gap-3 text-sm text-slate-500">
        <Link href={`/dashboard/${role}`} className="font-medium text-slate-700 hover:text-slate-950">
          ← Kembali ke dashboard
        </Link>
        <span>•</span>
        <span>{roleDef.name}</span>
        <span>•</span>
        <span>{feature.category}</span>
      </div>

      <section className="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm shadow-slate-900/5">
        <div className="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
          <div>
            <p className="text-xs uppercase tracking-[0.28em] text-slate-400">{feature.code}</p>
            <h1 className="mt-3 text-4xl font-semibold tracking-tight text-slate-950">{feature.name}</h1>
            <p className="mt-4 max-w-3xl text-base leading-8 text-slate-600">{feature.description}</p>
          </div>
          <div className="rounded-3xl bg-slate-950 px-5 py-4 text-white">
            <p className="text-xs uppercase tracking-[0.28em] text-slate-500">Status build</p>
            <p className="mt-2 text-lg font-semibold">{feature.status}</p>
          </div>
        </div>
      </section>

      <section className="grid gap-5 lg:grid-cols-3">
        <article className="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5">
          <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Capability scope</p>
          <ul className="mt-4 space-y-3 text-sm leading-7 text-slate-600">
            {feature.capabilities.map((item) => (
              <li key={item}>• {item}</li>
            ))}
          </ul>
        </article>

        <article className="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5">
          <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Checklist MVP</p>
          <ol className="mt-4 space-y-3 text-sm leading-7 text-slate-600">
            {feature.mvpChecklist.map((item, index) => (
              <li key={item}>
                {index + 1}. {item}
              </li>
            ))}
          </ol>
        </article>

        <article className="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5">
          <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Integrasi data</p>
          <ul className="mt-4 space-y-3 text-sm leading-7 text-slate-600">
            {feature.integrations.map((item) => (
              <li key={item}>• {item}</li>
            ))}
          </ul>
        </article>
      </section>

      <section className="rounded-[2rem] border border-slate-200 bg-slate-50 p-8 shadow-sm shadow-slate-900/5">
        <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Saran next sprint</p>
        <div className="mt-4 grid gap-4 lg:grid-cols-3">
          <div className="rounded-3xl bg-white p-5 shadow-sm shadow-slate-900/5">
            <h2 className="text-lg font-semibold text-slate-950">1. Master data dulu</h2>
            <p className="mt-3 text-sm leading-7 text-slate-600">
              Bentuk schema inti, validasi server action, dan relasi user/unit/kelas yang dibutuhkan modul ini.
            </p>
          </div>
          <div className="rounded-3xl bg-white p-5 shadow-sm shadow-slate-900/5">
            <h2 className="text-lg font-semibold text-slate-950">2. Workflow transaksi</h2>
            <p className="mt-3 text-sm leading-7 text-slate-600">
              Tentukan lifecycle create → review → publish/approve supaya proses operasional tidak liar.
            </p>
          </div>
          <div className="rounded-3xl bg-white p-5 shadow-sm shadow-slate-900/5">
            <h2 className="text-lg font-semibold text-slate-950">3. Notifikasi & audit</h2>
            <p className="mt-3 text-sm leading-7 text-slate-600">
              Event penting perlu masuk ke notification hub dan tercatat di audit trail untuk akuntabilitas.
            </p>
          </div>
        </div>
      </section>
    </div>
  );
}
