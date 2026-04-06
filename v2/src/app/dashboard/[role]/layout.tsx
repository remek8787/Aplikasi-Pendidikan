import { redirect } from "next/navigation";

import { DashboardShell } from "@/components/dashboard-shell";
import { getDemoUserByRoleSlug, getRoleBySlug } from "@/lib/platform-data";

type RoleLayoutProps = {
  children: React.ReactNode;
  params: Promise<{
    role: string;
  }>;
};

export function generateStaticParams() {
  return ["admin", "guru", "siswa", "staff", "pengawas"].map((role) => ({ role }));
}

export default async function RoleLayout({ children, params }: RoleLayoutProps) {
  const { role } = await params;
  const roleDef = getRoleBySlug(role);
  const user = getDemoUserByRoleSlug(role);

  if (!roleDef || !user) {
    redirect("/dashboard/");
  }

  return (
    <DashboardShell
      roleSlug={role}
      session={{
        name: user.name,
        email: user.email,
        roleCode: user.roleCode,
        unitCode: user.unitCode,
      }}
    >
      {children}
    </DashboardShell>
  );
}
