import { PrismaClient, ModuleStatus } from "@prisma/client";

import { demoUsers, modules, roles, schoolUnits } from "../src/lib/platform-data";

const prisma = new PrismaClient();

const statusMap: Record<(typeof modules)[number]["status"], ModuleStatus> = {
  "Foundation Ready": ModuleStatus.FOUNDATION_READY,
  "MVP Planning": ModuleStatus.MVP_PLANNING,
  Discovery: ModuleStatus.DISCOVERY,
};

async function main() {
  for (const role of roles) {
    await prisma.role.upsert({
      where: { code: role.code },
      update: {
        name: role.name,
        description: role.description,
      },
      create: {
        code: role.code,
        name: role.name,
        description: role.description,
      },
    });
  }

  for (const unit of schoolUnits) {
    await prisma.schoolUnit.upsert({
      where: { code: unit.code },
      update: {
        name: unit.name,
        description: unit.description,
        level: unit.code,
      },
      create: {
        code: unit.code,
        name: unit.name,
        description: unit.description,
        level: unit.code,
      },
    });
  }

  for (const feature of modules) {
    await prisma.featureModule.upsert({
      where: { slug: feature.slug },
      update: {
        code: feature.code,
        name: feature.name,
        category: feature.category,
        description: feature.description,
        status: statusMap[feature.status],
        ownerRoles: feature.ownerRoles.join(","),
        route: `/dashboard/[role]/modul/${feature.slug}`,
      },
      create: {
        code: feature.code,
        slug: feature.slug,
        name: feature.name,
        category: feature.category,
        description: feature.description,
        status: statusMap[feature.status],
        ownerRoles: feature.ownerRoles.join(","),
        route: `/dashboard/[role]/modul/${feature.slug}`,
      },
    });
  }

  await prisma.notificationChannel.upsert({
    where: { code: "WHATSAPP" },
    update: {
      name: "WhatsApp Notification Hub",
      isActive: true,
      notes: "Channel starter untuk reminder absensi, tagihan, pengumuman, dan follow-up BK.",
    },
    create: {
      code: "WHATSAPP",
      name: "WhatsApp Notification Hub",
      isActive: true,
      notes: "Channel starter untuk reminder absensi, tagihan, pengumuman, dan follow-up BK.",
    },
  });

  const roleMap = new Map((await prisma.role.findMany()).map((role) => [role.code, role.id]));
  const unitMap = new Map((await prisma.schoolUnit.findMany()).map((unit) => [unit.code, unit.id]));

  for (const user of demoUsers) {
    await prisma.user.upsert({
      where: { email: user.email },
      update: {
        name: user.name,
        badge: user.badge,
        roleId: roleMap.get(user.roleCode)!,
        schoolUnitId: unitMap.get(user.unitCode)!,
      },
      create: {
        email: user.email,
        name: user.name,
        badge: user.badge,
        roleId: roleMap.get(user.roleCode)!,
        schoolUnitId: unitMap.get(user.unitCode)!,
      },
    });
  }

  console.log("Seed selesai: roles, units, users, modules, dan channel WhatsApp sudah dibuat.");
}

main()
  .catch((error) => {
    console.error(error);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
