"use server";

import { redirect } from "next/navigation";

import { loginWithDemoUser } from "@/lib/auth";

export async function loginAction(formData: FormData) {
  const email = String(formData.get("email") ?? "").trim();

  if (!email) {
    redirect("/login?error=missing-email");
  }

  const session = await loginWithDemoUser(email);
  redirect(`/dashboard/${session.roleSlug}`);
}
