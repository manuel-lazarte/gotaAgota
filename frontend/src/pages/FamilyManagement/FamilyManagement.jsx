import React, { useState, useEffect, useMemo } from "react";
import { useNavigate } from "react-router-dom";
import "./FamilyManagement.css";
import {
  Search,
  UserPlus,
  Bell,
  Settings,
  ChevronLeft,
  ChevronRight,
  Droplet,
  Loader2,
} from "lucide-react";
import { api } from "../../services/api";

const AVATAR_COLORS = [
  { bg: "#dbeafe", text: "#1e40af" },
  { bg: "#e0e7ff", text: "#3730a3" },
  { bg: "#ffedd5", text: "#9a3412" },
  { bg: "#e0f2fe", text: "#0369a1" },
  { bg: "#f0fdf4", text: "#166534" },
  { bg: "#fdf4ff", text: "#6b21a8" },
];

const TABS = ["Todos", "ZONA NORTE", "CENTRO", "SUR"];
const PAGE_SIZE = 10;

function getAvatarColor(id) {
  return AVATAR_COLORS[id % AVATAR_COLORS.length];
}

export default function FamilyManagement() {
  const [familias, setFamilias]   = useState([]);
  const [loading, setLoading]     = useState(true);
  const [error, setError]         = useState(null);
  const [activeTab, setActiveTab] = useState("Todos");
  const [search, setSearch]       = useState("");
  const [page, setPage]           = useState(1);
  const navigate                  = useNavigate();

  useEffect(() => {
    api.getFamilias()
      .then(setFamilias)
      .catch((e) => setError(e.message))
      .finally(() => setLoading(false));
  }, []);

  const filtered = useMemo(() => {
    let list = familias;
    if (activeTab !== "Todos") {
      list = list.filter((f) => f.zona === activeTab);
    }
    if (search.trim()) {
      const q = search.toLowerCase();
      list = list.filter(
        (f) =>
          f.nombre.toLowerCase().includes(q) ||
          (f.contacto ?? "").includes(q) ||
          (f.socio?.nombre ?? "").toLowerCase().includes(q)
      );
    }
    return list;
  }, [familias, activeTab, search]);

  const totalPages = Math.max(1, Math.ceil(filtered.length / PAGE_SIZE));
  const paginated  = filtered.slice((page - 1) * PAGE_SIZE, page * PAGE_SIZE);

  function handleTabChange(tab) {
    setActiveTab(tab);
    setPage(1);
  }

  function handleSearch(e) {
    setSearch(e.target.value);
    setPage(1);
  }

  return (
    <div className="family-container">
      <header className="top-user-bar">
        <div className="status-badge">
          <span className="status-dot"></span>
          Estado Normal
        </div>
        <div className="user-actions">
          <button className="icon-btn"><Bell size={20} /></button>
          <button className="icon-btn"><Settings size={20} /></button>
          <div className="user-profile">
            <img
              src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=60"
              alt="Profile"
              className="profile-img"
            />
          </div>
        </div>
      </header>

      <div className="page-header">
        <div className="header-titles">
          <h1 className="page-title">Family Management</h1>
          <p className="page-subtitle">
            Manage water quotas and family registrations for the community.
          </p>
        </div>
        <button className="btn-register">
          <UserPlus size={18} />
          <span>Registrar Nueva Familia</span>
        </button>
      </div>

      <div className="filter-card">
        <div className="search-box">
          <Search className="search-icon" size={20} />
          <input
            type="text"
            value={search}
            onChange={handleSearch}
            placeholder="Buscar por nombre o teléfono..."
            className="search-input"
          />
        </div>
        <div className="zone-tabs">
          {TABS.map((tab) => (
            <button
              key={tab}
              className={`tab-btn ${activeTab === tab ? "active" : ""}`}
              onClick={() => handleTabChange(tab)}
            >
              {tab}
            </button>
          ))}
        </div>
      </div>

      <div className="table-container">
        {loading ? (
          <div className="loading-state">
            <Loader2 size={32} className="spin" />
            <p>Cargando familias...</p>
          </div>
        ) : error ? (
          <div className="error-state">
            <p>Error al cargar datos: {error}</p>
            <button onClick={() => window.location.reload()}>Reintentar</button>
          </div>
        ) : (
          <>
            <table className="family-table">
              <thead>
                <tr>
                  <th>Familia (Responsable)</th>
                  <th>Zona</th>
                  <th>Integrantes</th>
                  <th>Cuota Diaria</th>
                  <th>Contacto</th>
                  <th style={{ textAlign: "right" }}>Acciones</th>
                </tr>
              </thead>
              <tbody>
                {paginated.length === 0 ? (
                  <tr>
                    <td colSpan={6} className="empty-state">
                      No se encontraron familias.
                    </td>
                  </tr>
                ) : (
                  paginated.map((familia) => {
                    const color = getAvatarColor(familia.id);
                    return (
                      <tr
                        key={familia.id}
                        className="clickable-row"
                        onClick={() => navigate(`/family/${familia.id}`)}
                      >
                        <td>
                          <div className="family-cell-name">
                            <div
                              className="avatar-circle"
                              style={{
                                backgroundColor: color.bg,
                                color: color.text,
                              }}
                            >
                              {familia.iniciales}
                            </div>
                            <div>
                              <span className="family-name-text">{familia.nombre}</span>
                              {familia.socio && (
                                <span className="family-socio-sub">{familia.socio.nombre}</span>
                              )}
                            </div>
                          </div>
                        </td>

                        <td>
                          <span className={`zone-tag ${familia.zona?.toLowerCase().replace(" ", "-")}`}>
                            {familia.zona ?? "—"}
                          </span>
                        </td>

                        <td>{familia.num_integrantes}</td>

                        <td>
                          <div className="quota-cell">
                            <Droplet size={16} className="water-icon" />
                            <div>
                              <strong className="quota-bold">
                                {familia.cuota_diaria ?? "—"}
                              </strong>
                              <span className="quota-unit"> L/día</span>
                            </div>
                          </div>
                        </td>

                        <td className="contact-cell">
                          {familia.contacto ?? "Sin contacto"}
                        </td>

                        <td style={{ textAlign: "right" }}>
                          <button
                            className="btn-action-view"
                            onClick={(e) => {
                              e.stopPropagation();
                              navigate(`/family/${familia.id}`);
                            }}
                          >
                            👁️
                          </button>
                        </td>
                      </tr>
                    );
                  })
                )}
              </tbody>
            </table>

            <div className="table-footer">
              <span className="results-count">
                Mostrando {paginated.length} de {filtered.length} familias
              </span>
              <div className="pagination-btns">
                <button
                  className="pag-btn"
                  disabled={page === 1}
                  onClick={() => setPage((p) => p - 1)}
                >
                  <ChevronLeft size={18} />
                </button>
                <span className="page-indicator">{page} / {totalPages}</span>
                <button
                  className="pag-btn"
                  disabled={page === totalPages}
                  onClick={() => setPage((p) => p + 1)}
                >
                  <ChevronRight size={18} />
                </button>
              </div>
            </div>
          </>
        )}
      </div>
    </div>
  );
}
