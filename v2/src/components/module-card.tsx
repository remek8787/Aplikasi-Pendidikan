import Link from "next/link";

import type { ModuleDefinition } from "@/lib/platform-data";

type ModuleCardProps = {
  module: ModuleDefinition;
  href?: string;
  compact?: boolean;
};

const statusTone: Record<ModuleDefinition["status"], string> = {
  "Foundation Ready": "bg-emerald-500/15 text-emerald-700 ring-emerald-600/20",
  "MVP Planning": "bg-amber-500/15 text-amber-700 ring-amber-600/20",
  Discovery: "bg-slate-500/15 text-slate-700 ring-slate-600/20",
};

export function ModuleCard({ module, href, compact = false }: ModuleCardProps) {
  const content = (
    <article className="group rounded-3xl border border-slate-200/80 bg-white p-5 shadow-sm shadow-slate-900/5 transition hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-lg hover:shadow-slate-900/10">
      <div className="flex items-start justify-between gap-4">
        <div>
          <p className="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">{module.code}</p>
          <h3 className="mt-2 text-lg font-semibold text-slate-900">{module.name}</h3>
        </div>
        <span className={`rounded-full px-3 py-1 text-xs font-semibold ring-1 ${statusTone[module.status]}`}>
          {module.status}
        </span>
      </div>

      <p className="mt-4 text-sm leading-6 text-slate-600">{compact ? module.short : module.description}</p>

      <div className="mt-4 flex flex-wrap gap-2">
        {module.ownerRoles.map((role) => (
          <span
            key={role}
            className="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-medium uppercase tracking-wide text-slate-600"
          >
            {role}
          </span>
        ))}
      </div>

      {!compact ? (
        <ul className="mt-4 space-y-2 text-sm text-slate-600">
          {module.mvpChecklist.slice(0, 3).map((item) => (
            <li key={item} className="flex items-start gap-2">
              <span className="mt-1 text-emerald-500">•</span>
              <span>{item}</span>
            </li>
          ))}
        </ul>
      ) : null}

      <div className="mt-5 flex items-center justify-between text-sm font-medium text-slate-500">
        <span>{module.category}</span>
        <span className="text-slate-900 group-hover:text-sky-700">Lihat detail →</span>
      </div>
    </article>
  );

  if (!href) {
    return content;
  }

  return (
    <Link href={href} className="block">
      {content}
    </Link>
  );
}
