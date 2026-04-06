import { cookies } from "next/headers";

import { getDemoUserByEmail, getRoleByCode, getRoleBySlug, getUnitByCode, type RoleCode } from "@/lib/platform-data";

const SESSION_COOKIE = "apdik_v2_demo_session";

export type DemoSession = {
  email: string;
  name: string;
  roleCode: RoleCode;
  roleSlug: string;
  unitCode: "SD" | "SMP" | "SMA";
};

function encodeSession(session: DemoSession) {
  return Buffer.from(JSON.stringify(session)).toString("base64url");
}

function decodeSession(raw: string): DemoSession | null {
  try {
    const parsed = JSON.parse(Buffer.from(raw, "base64url").toString("utf8")) as DemoSession;

    if (!parsed.email || !parsed.roleCode || !parsed.roleSlug || !parsed.name || !parsed.unitCode) {
      return null;
    }

    return parsed;
  } catch {
    return null;
  }
}

export async function getSession() {
  const store = await cookies();
  const raw = store.get(SESSION_COOKIE)?.value;

  if (!raw) {
    return null;
  }

  return decodeSession(raw);
}

export async function loginWithDemoUser(email: string) {
  const user = getDemoUserByEmail(email);

  if (!user) {
    throw new Error("Demo user tidak ditemukan.");
  }

  const role = getRoleByCode(user.roleCode);
  const unit = getUnitByCode(user.unitCode);

  if (!role || !unit) {
    throw new Error("Role atau unit demo tidak valid.");
  }

  const session: DemoSession = {
    email: user.email,
    name: user.name,
    roleCode: user.roleCode,
    roleSlug: role.code.toLowerCase(),
    unitCode: unit.code,
  };

  const store = await cookies();
  store.set(SESSION_COOKIE, encodeSession(session), {
    httpOnly: true,
    sameSite: "lax",
    secure: false,
    path: "/",
    maxAge: 60 * 60 * 8,
  });

  return session;
}

export async function logout() {
  const store = await cookies();
  store.delete(SESSION_COOKIE);
}

export async function requireSessionForRole(roleSlug: string) {
  const session = await getSession();

  if (!session) {
    return null;
  }

  const role = getRoleBySlug(roleSlug);

  if (!role || role.code !== session.roleCode) {
    return null;
  }

  return session;
}
