import Link from "next/link";

import { demoUsers, getRoleByCode } from "@/lib/platform-data";

export default function DashboardIndexPage() {
  return (
    <div className="min-h-screen bg-slate-950 px-6 py-10 text-white lg:px-10">
      <div className="mx-auto max-w-5xl">
        <p className="text-xs uppercase tracking-[0.28em] text-slate-400">Dashboard selector</p>
        <h1 className="mt-4 text-4xl font-semibold tracking-tight">Pilih role preview</h1>
        <p className="mt-4 max-w-2xl text-sm leading-7 text-slate-300">
          Halaman ini dipakai untuk memilih dashboard berdasarkan role pada mode preview hosting.
        </p>

        <div className="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
          {demoUsers.map((user) => {
            const role = getRoleByCode(user.roleCode);
            const roleSlug = role?.code.toLowerCase();
            return (
              <Link
                key={user.email}
                href={roleSlug ? `/dashboard/${roleSlug}/` : "/dashboard/"}
                className="rounded-3xl border border-white/10 bg-white/5 p-5 transition hover:bg-white/10"
              >
                <p className="text-xs uppercase tracking-[0.28em] text-slate-400">{role?.name}</p>
                <h2 className="mt-2 text-xl font-semibold text-white">{user.name}</h2>
                <p className="mt-2 text-sm text-slate-300">{user.badge}</p>
              </Link>
            );
          })}
        </div>
      </div>
    </div>
  );
}
