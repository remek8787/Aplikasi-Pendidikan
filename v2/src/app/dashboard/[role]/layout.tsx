import { redirect } from "next/navigation";

import { DashboardShell } from "@/components/dashboard-shell";
import { requireSessionForRole } from "@/lib/auth";

type RoleLayoutProps = {
  children: React.ReactNode;
  params: Promise<{
    role: string;
  }>;
};

export default async function RoleLayout({ children, params }: RoleLayoutProps) {
  const { role } = await params;
  const session = await requireSessionForRole(role);

  if (!session) {
    redirect("/login");
  }

  return (
    <DashboardShell
      roleSlug={role}
      session={{
        name: session.name,
        email: session.email,
        roleCode: session.roleCode,
        unitCode: session.unitCode,
      }}
    >
      {children}
    </DashboardShell>
  );
}
