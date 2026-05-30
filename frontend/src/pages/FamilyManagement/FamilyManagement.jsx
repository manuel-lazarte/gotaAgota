import React, { useState } from "react";
import { useNavigate } from "react-router-dom"; // 1. Importar useNavigate
import "./FamilyManagement.css";
import {
  Search,
  UserPlus,
  Bell,
  Settings,
  ChevronLeft,
  ChevronRight,
  Droplet,
} from "lucide-react";

export default function FamilyManagement() {
  const [activeTab, setActiveTab] = useState("Todos");
  const navigate = useNavigate(); // 2. Inicializar el hook de navegación

  const families = [
    {
      id: 1,
      initials: "GR",
      name: "García Rodríguez",
      zone: "ZONA NORTE",
      members: 4,
      quota: "600 L/day",
      contact: "+52 555 123 4567",
      avatarColor: "#dbeafe",
      textColor: "#1e40af",
    },
    {
      id: 2,
      initials: "ML",
      name: "Martínez López",
      zone: "CENTRO",
      members: 5,
      quota: "750 L/day",
      contact: "+52 555 987 6543",
      avatarColor: "#e0e7ff",
      textColor: "#3730a3",
    },
    {
      id: 3,
      initials: "SH",
      name: "Sánchez Hernández",
      zone: "SUR",
      members: 2,
      quota: "300 L/day",
      contact: "+52 555 444 3333",
      avatarColor: "#ffedd5",
      textColor: "#9a3412",
    },
    {
      id: 4,
      initials: "DM",
      name: "Díaz Martínez",
      zone: "CENTRO",
      members: 6,
      quota: "900 L/day",
      contact: "+52 555 222 1111",
      avatarColor: "#e0f2fe",
      textColor: "#0369a1",
    },
  ];

  return (
    <div className="family-container">
      {/* 1. Barra de Usuario Superior */}
      <header className="top-user-bar">
        <div className="status-badge">
          <span className="status-dot"></span>
          Estado Normal
        </div>
        <div className="user-actions">
          <button className="icon-btn">
            <Bell size={20} />
          </button>
          <button className="icon-btn">
            <Settings size={20} />
          </button>
          <div className="user-profile">
            <img
              src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=60"
              alt="Profile"
              className="profile-img"
            />
          </div>
        </div>
      </header>

      {/* 2. Cabecera Principal de la Página */}
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

      {/* 3. Panel de Filtros e Insumos */}
      <div className="filter-card">
        <div className="search-box">
          <Search className="search-icon" size={20} />
          <input
            type="text"
            placeholder="Search by family name or phone..."
            className="search-input"
          />
        </div>
        <div className="zone-tabs">
          {["Todos", "Zona Norte", "Centro", "Sur"].map((tab) => (
            <button
              key={tab}
              className={`tab-btn ${activeTab === tab ? "active" : ""}`}
              onClick={() => setActiveTab(tab)}
            >
              {tab}
            </button>
          ))}
        </div>
      </div>

      {/* 4. Contenedor de la Tabla */}
      <div className="table-container">
        <table className="family-table">
          <thead>
            <tr>
              <th>Family Name (Head)</th>
              <th>Zone</th>
              <th>Members</th>
              <th>Water Quota</th>
              <th>Contact</th>
              <th style={{ textAlign: "right" }}>Actions</th>
            </tr>
          </thead>
          <tbody>
            {families.map((family) => (
              <tr
                key={family.id}
                className="clickable-row"
                onClick={() => navigate(`/family/${family.id}`)} // 3. Evento de redirección
              >
                {/* Nombre y Avatar */}
                <td>
                  <div className="family-cell-name">
                    <div
                      className="avatar-circle"
                      style={{
                        backgroundColor: family.avatarColor,
                        color: family.textColor,
                      }}
                    >
                      {family.initials}
                    </div>
                    <span className="family-name-text">{family.name}</span>
                  </div>
                </td>

                {/* Zona Tag */}
                <td>
                  <span
                    className={`zone-tag ${family.zone.toLowerCase().replace(" ", "-")}`}
                  >
                    {family.zone}
                  </span>
                </td>

                {/* Miembros */}
                <td>{family.members}</td>

                {/* Cuota de Agua */}
                <td>
                  <div className="quota-cell">
                    <Droplet size={16} className="water-icon" />
                    <div>
                      <strong className="quota-bold">
                        {family.quota.split(" ")[0]}
                      </strong>
                      <span className="quota-unit">
                        {" "}
                        {family.quota.split(" ")[1]}
                      </span>
                    </div>
                  </div>
                </td>

                {/* Contacto */}
                <td className="contact-cell">{family.contact}</td>

                {/* Acciones */}
                <td style={{ textAlign: "right" }}>
                  <button
                    className="btn-action-view"
                    onClick={(e) => {
                      e.stopPropagation(); // Evita que se dispare el onClick de la fila al hacer clic solo en el botón
                      navigate(`/family/${family.id}`);
                    }}
                  >
                    👁️
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>

        {/* Footer de la Tabla */}
        <div className="table-footer">
          <span className="results-count">Showing 4 of 124 families</span>
          <div className="pagination-btns">
            <button className="pag-btn">
              <ChevronLeft size={18} />
            </button>
            <button className="pag-btn">
              <ChevronRight size={18} />
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
