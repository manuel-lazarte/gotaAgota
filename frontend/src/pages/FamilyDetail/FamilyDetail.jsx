import React from "react";
import "./FamilyDetail.css";
import {
  Bell,
  Settings,
  MapPin,
  Layers,
  Activity,
  Droplet,
  Users,
  TrendingDown,
  Calendar,
  MessageSquare,
  ChevronDown,
  Eye,
  Smartphone,
  CheckCircle2,
  Battery,
  AlertCircle,
  MoreVertical,
  Edit2,
} from "lucide-react";

export default function FamilyDetail() {
  // Mock de datos del historial basado en image_2f6842.png
  const historyData = [
    {
      date: "Hoy, 15 Oct",
      extra: "Corte: 15:30",
      consumption: "450 Litros",
      status: "Normal",
      statusClass: "status-normal",
    },
    {
      date: "Ayer, 14 Oct",
      extra: "Día completo",
      consumption: "642 Litros",
      status: "Exceso",
      statusClass: "status-exceso",
    },
    {
      date: "13 Oct 2023",
      extra: "Día completo",
      consumption: "510 Litros",
      status: "Normal",
      statusClass: "status-normal",
    },
  ];

  // Alturas en porcentaje para simular el gráfico de consumo en tiempo real
  const chartBars = [25, 40, 95, 60, 45, 30, 30, 45, 80, 55, 50, 20, 15];

  return (
    <div className="detail-container">
      {/* Navbar Superior */}
      <header className="detail-navbar">
        <h2 className="navbar-title">Detalle de Familia</h2>
        <div className="navbar-actions">
          <button className="nav-icon-btn">
            <Bell size={20} />
          </button>
          <button className="nav-icon-btn">
            <Settings size={20} />
          </button>
          <div className="nav-profile">
            <img
              src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=60"
              alt="Profile"
            />
          </div>
        </div>
      </header>

      {/* Breadcrumbs y Título Principal */}
      <div className="detail-header-section">
        <div className="breadcrumbs">
          <span>Gestión</span> &gt;{" "}
          <span className="active-crumb">Detalles de Familia</span>
        </div>

        <div className="main-title-row">
          <div>
            <h1 className="family-title">Familia García Rodríguez</h1>
            <div className="family-metadata">
              <span>
                <MapPin size={14} /> Zona Norte
              </span>
              <span className="dot-separator">•</span>
              <span>
                <Layers size={14} /> Sector Las Palmas
              </span>
              <span className="dot-separator">•</span>
              <span>
                <Activity size={14} /> Medidor #4421-B
              </span>
            </div>
          </div>
          <div className="action-buttons">
            <button className="btn-adjust-quota">
              <Edit2 size={16} /> Ajustar Cuota
            </button>
            <button className="btn-more">
              <MoreVertical size={18} />
            </button>
          </div>
        </div>
      </div>

      {/* Grid de Tarjetas de Indicadores (Métricas) */}
      <div className="metrics-grid">
        {/* Consumo Diario Actual */}
        <div className="metric-card border-blue">
          <div className="metric-header">
            <div>
              <p className="metric-label">Consumo Diario Actual</p>
              <h3 className="metric-value color-blue">
                450 <span className="value-unit">Litros</span>
              </h3>
            </div>
            <div className="metric-icon-wrapper bg-light-blue">
              <Droplet size={18} className="color-blue" />
            </div>
          </div>
          <div className="progress-bar-container">
            <div className="progress-bar-fill" style={{ width: "75%" }}></div>
          </div>
          <div className="metric-footer-row">
            <span>
              <strong>75%</strong> del límite
            </span>
            <span>
              Límite: <strong>600L</strong>
            </span>
          </div>
        </div>

        {/* Cuota Asignada */}
        <div className="metric-card border-brown">
          <div className="metric-header">
            <div>
              <p className="metric-label">Cuota Asignada</p>
              <h3 className="metric-value">
                600 <span className="value-unit">L/día</span>
              </h3>
            </div>
            <div className="metric-icon-wrapper bg-light-brown">
              <Activity size={18} className="color-brown" />
            </div>
          </div>
          <p className="metric-info-text text-muted">Basado en 4 integrantes</p>
        </div>

        {/* Integrantes */}
        <div className="metric-card border-purple">
          <div className="metric-header">
            <div>
              <p className="metric-label">Integrantes</p>
              <h3 className="metric-value">
                4 <span className="value-unit">Personas</span>
              </h3>
            </div>
            <div className="metric-icon-wrapper bg-light-purple">
              <Users size={18} className="color-purple" />
            </div>
          </div>
          <div className="avatar-stack">
            <img
              src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80"
              alt="Int 1"
            />
            <img
              src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=80"
              alt="Int 2"
            />
            <img
              src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=80"
              alt="Int 3"
            />
            <div className="avatar-plus">+1</div>
          </div>
        </div>

        {/* Promedio Semanal */}
        <div className="metric-card border-green">
          <div className="metric-header">
            <div>
              <p className="metric-label">Promedio Semanal</p>
              <h3 className="metric-value">
                428 <span className="value-unit">L/prom.</span>
              </h3>
            </div>
            <div className="metric-icon-wrapper bg-light-green">
              <Calendar size={18} className="color-green" />
            </div>
          </div>
          <div className="trending-badge color-green">
            <TrendingDown size={16} />
            <span>
              <strong>-4.2%</strong> vs semana pasada
            </span>
          </div>
        </div>
      </div>

      {/* Distribución Dos Columnas: Izquierda (Gráfico e Historial) | Derecha (Acciones y Medidor) */}
      <div className="main-content-layout">
        {/* Columna Izquierda */}
        <div className="left-column">
          {/* Gráfico en Tiempo Real */}
          <div className="content-card">
            <div className="card-header-row">
              <div>
                <h3 className="card-title">Consumo en Tiempo Real</h3>
                <p className="card-subtitle">Historial de uso horario de hoy</p>
              </div>
              <button className="dropdown-btn">
                Hoy, 15 Oct <ChevronDown size={16} />
              </button>
            </div>

            {/* Simulación del gráfico de barras */}
            <div className="realtime-chart-container">
              <div className="chart-bars-wrapper">
                {chartBars.map((height, idx) => (
                  <div key={idx} className="chart-column">
                    <div
                      className={`chart-bar ${idx === 2 || idx === 8 ? "bar-highlight" : ""} ${idx >= 11 ? "bar-dashed" : ""}`}
                      style={{ height: `${height}%` }}
                    ></div>
                  </div>
                ))}
              </div>
              <div className="chart-timeline-labels">
                <span>06:00</span>
                <span>08:00</span>
                <span>10:00</span>
                <span>12:00</span>
                <span>14:00</span>
                <span>16:00</span>
              </div>
            </div>
          </div>

          {/* Historial de Consumo Reciente */}
          <div className="content-card">
            <div className="card-header-row">
              <h3 className="card-title">Historial de Consumo Reciente</h3>
              <a href="#complete-history" className="view-all-link">
                Ver Historial Completo
              </a>
            </div>

            <table className="history-table">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Consumo Total</th>
                  <th>Estado</th>
                  <th style={{ textAlign: "center" }}>Acciones</th>
                </tr>
              </thead>
              <tbody>
                {historyData.map((row, index) => (
                  <tr key={index}>
                    <td>
                      <div className="date-cell">
                        <span className="main-date">{row.date}</span>
                        <span className="sub-date">{row.extra}</span>
                      </div>
                    </td>
                    <td
                      className={`consumption-cell ${row.statusClass === "status-exceso" ? "color-red font-bold" : "font-semibold"}`}
                    >
                      {row.consumption}
                    </td>
                    <td>
                      <span className={`status-pill ${row.statusClass}`}>
                        <span className="status-pill-dot"></span>
                        {row.status}
                      </span>
                    </td>
                    <td style={{ textAlign: "center" }}>
                      <button className="btn-action-view">
                        <Eye size={16} />
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>

        {/* Columna Derecha */}
        <div className="right-column">
          {/* Acción Directa */}
          <div className="action-direct-card">
            <div className="card-title-with-icon">
              <MessageSquare size={18} className="color-blue-dark" />
              <h3>Acción Directa</h3>
            </div>
            <p className="action-card-description">
              Envía un mensaje instantáneo a la Familia García sobre su consumo
              actual o mantenimientos.
            </p>
            <div className="action-buttons-stack">
              <button className="btn-action-whatsapp">
                <span className="wa-icon-mock">🔑</span>
                <span>Enviar WhatsApp</span>
                <span className="arrow-right">&gt;</span>
              </button>
              <button className="btn-action-app">
                <Smartphone size={16} />
                <span>Notificación App</span>
                <span className="app-send-icon">🚀</span>
              </button>
            </div>
          </div>

          {/* Estado del Medidor */}
          <div className="content-card">
            <h3 className="card-title-simple">Estado del Medidor</h3>

            <div className="meter-status-box">
              <div className="status-item bg-light-green-box">
                <CheckCircle2 size={18} className="color-green-dark" />
                <div>
                  <h4 className="status-item-title">Online</h4>
                  <p className="status-item-sub">Última señal: Hace 2 min</p>
                </div>
              </div>

              <div className="status-item bg-light-blue-box">
                <Battery size={18} className="color-blue-dark" />
                <div>
                  <h4 className="status-item-title">Batería: 92%</h4>
                  <p className="status-item-sub">Sensor Ultrasónico</p>
                </div>
              </div>
            </div>

            <button className="btn-remote-diagnostic">
              Diagnóstico Remoto
            </button>
          </div>

          {/* Alertas Recientes */}
          <div className="alerts-section">
            <h4 className="alerts-section-title">Alertas Recientes</h4>
            <div className="alert-item-box">
              <div className="alert-item-header">
                <span className="alert-dot-indicator"></span>
                <span className="alert-source-title">Sistema Gota A Gota</span>
                <span className="alert-time">10:45 AM</span>
              </div>
              <p className="alert-body-text">
                Aviso: El consumo superó los 50L en la última hora. Posible fuga
                menor...
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
