const BASE = "/api/v1";

async function request(path, options = {}) {
  const res = await fetch(`${BASE}${path}`, {
    headers: { "Content-Type": "application/json", Accept: "application/json" },
    ...options,
  });
  if (!res.ok) {
    const err = await res.json().catch(() => ({}));
    throw new Error(err.message ?? `HTTP ${res.status}`);
  }
  if (res.status === 204) return null;
  return res.json();
}

export const api = {
  // Familias
  getFamilias:      ()     => request("/familias"),
  getFamilia:       (id)   => request(`/familias/${id}`),
  createFamilia:    (data) => request("/familias", { method: "POST", body: JSON.stringify(data) }),
  updateFamilia:    (id, data) => request(`/familias/${id}`, { method: "PUT", body: JSON.stringify(data) }),
  deleteFamilia:    (id)   => request(`/familias/${id}`, { method: "DELETE" }),

  // Socios
  getSocios:        ()     => request("/socios"),
  getSocio:         (id)   => request(`/socios/${id}`),

  // Consumos
  getConsumosPorMedidor: (medidorId) => request(`/medidores/${medidorId}/consumos`),

  // Tanque y alertas
  getTanqueResumen: ()     => request("/tanque/resumen"),
  getAlertasActivas: ()    => request("/alertas/activas"),
};
