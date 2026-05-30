import React, { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
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
  TrendingUp,
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
  Loader2,
  ArrowLeft,
} from "lucide-react";
import { api } from "../../services/api";

function calcPorcentaje(consumo, cuotaMensual) {
  if (!consumo || !cuotaMensual) return 0;
  return Math.min(100, Math.round((consumo / cuotaMensual) * 100));
}

function formatFecha(isoDate) {
  if (!isoDate) return "—";
  return new Date(isoDate).toLocaleDateString("es-EC", {
    day: "2-digit",
    month: "short",
    year: "numeric",
  });
}

function estadoConsumo(consumo, cuotaMensual) {
  if (!consumo || !cuotaMensual) return { label: "Sin datos", cls: "status-normal" };
  const pct = (consumo / cuotaMensual) * 100;
  if (pct > 100) return { label: "Exceso",     cls: "status-exceso"  };
  if (pct > 80)  return { label: "Precaución", cls: "status-precaution" };
  return          { label: "Normal",     cls: "status-normal"  };
}

export default function FamilyDetail() {
  const { id }      = useParams();
  const navigate    = useNavigate();
  const [data, setData]     = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError]   = useState(null);

  useEffect(() => {
    api.getFamilia(id)
      .then(setData)
      .catch((e) => setError(e.message))
      .finally(() => setLoading(false));
  }, [id]);

  if (loading) return (
    <div className="detail-container loading-center">
      <Loader2 size={40} className="spin" />
      <p>Cargando detalle...</p>
    </div>
  );

  if (error) return (
    <div className="detail-container error-center">
      <AlertCircle size={32} />
      <p>{error}</p>
      <button onClick={() => navigate("/family")}>Volver</button>
    </div>
  );

  const {
    nombre, iniciales, num_integrantes, zona, direccion,
    socio, medidor, contacto,
    cuota_mensual, cuota_diaria, periodo_cuota,
    consumo_ultimo, consumos_recientes = [],
  } = data;

  const porcentaje    = calcPorcentaje(consumo_ultimo, cuota_mensual);
  const promedioMes   = consumos_recientes.length
    ? Math.round(consumos_recientes.reduce((s, c) => s + Number(c.consumo), 0) / consumos_recientes.length)
    : null;

  // Barras del gráfico usando consumos_recientes (últimos 6 meses)
  const maxConsumo    = Math.max(...consumos_recientes.map((c) => Number(c.consumo)), 1);
  const chartBars     = consumos_recientes.length > 0
    ? consumos_recientes.map((c) => Math.round((Number(c.consumo) / maxConsumo) * 90) + 5)
    : [25, 40, 95, 60, 45, 30]; // fallback

  return (
    <div className="detail-container">
      {/* Navbar Superior */}
      <header className="detail-navbar">
        <div className="navbar-back">
          <button className="btn-back" onClick={() => navigate("/family")}>
            <ArrowLeft size={18} /> Volver
          </button>
          <h2 className="navbar-title">Detalle de Familia</h2>
        </div>
        <div className="navbar-actions">
          <button className="nav-icon-btn"><Bell size={20} /></button>
          <button className="nav-icon-btn"><Settings size={20} /></button>
          <div className="nav-profile">
            <img
              src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=60"
              alt="Profile"
            />
          </div>
        </div>
      </header>

      {/* Breadcrumbs y Título */}
      <div className="detail-header-section">
        <div className="breadcrumbs">
          <span className="crumb-link" onClick={() => navigate("/family")}>Gestión</span>
          {" > "}
          <span className="active-crumb">Detalles de Familia</span>
        </div>

        <div className="main-title-row">
          <div>
            <h1 className="family-title">{nombre}</h1>
            <div className="family-metadata">
              {zona && <span><MapPin size={14} /> {zona}</span>}
              {direccion && (
                <>
                  <span className="dot-separator">•</span>
                  <span><Layers size={14} /> {direccion}</span>
                </>
              )}
              {medidor && (
                <>
                  <span className="dot-separator">•</span>
                  <span><Activity size={14} /> Medidor #{medidor.numero_serie}</span>
                </>
              )}
            </div>
          </div>
          <div className="action-buttons">
            <button className="btn-adjust-quota">
              <Edit2 size={16} /> Ajustar Cuota
            </button>
            <button className="btn-more"><MoreVertical size={18} /></button>
          </div>
        </div>
      </div>

      {/* Grid de Métricas */}
      <div className="metrics-grid">
        {/* Consumo Último Mes */}
        <div className="metric-card border-blue">
          <div className="metric-header">
            <div>
              <p className="metric-label">Último Consumo Registrado</p>
              <h3 className="metric-value color-blue">
                {consumo_ultimo ?? "—"} <span className="value-unit">L</span>
              </h3>
            </div>
            <div className="metric-icon-wrapper bg-light-blue">
              <Droplet size={18} className="color-blue" />
            </div>
          </div>
          <div className="progress-bar-container">
            <div className="progress-bar-fill" style={{ width: `${porcentaje}%` }}></div>
          </div>
          <div className="metric-footer-row">
            <span><strong>{porcentaje}%</strong> del límite mensual</span>
            <span>Límite: <strong>{cuota_mensual ?? "—"} L</strong></span>
          </div>
        </div>

        {/* Cuota Asignada */}
        <div className="metric-card border-brown">
          <div className="metric-header">
            <div>
              <p className="metric-label">Cuota Asignada</p>
              <h3 className="metric-value">
                {cuota_diaria ?? "—"} <span className="value-unit">L/día</span>
              </h3>
            </div>
            <div className="metric-icon-wrapper bg-light-brown">
              <Activity size={18} className="color-brown" />
            </div>
          </div>
          <p className="metric-info-text text-muted">
            Basado en {num_integrantes} integrante{num_integrantes !== 1 ? "s" : ""}
            {periodo_cuota && ` · Período ${periodo_cuota}`}
          </p>
        </div>

        {/* Integrantes */}
        <div className="metric-card border-purple">
          <div className="metric-header">
            <div>
              <p className="metric-label">Integrantes</p>
              <h3 className="metric-value">
                {num_integrantes} <span className="value-unit">Personas</span>
              </h3>
            </div>
            <div className="metric-icon-wrapper bg-light-purple">
              <Users size={18} className="color-purple" />
            </div>
          </div>
          <div className="family-iniciales-big">{iniciales}</div>
        </div>

        {/* Promedio Histórico */}
        <div className="metric-card border-green">
          <div className="metric-header">
            <div>
              <p className="metric-label">Promedio Histórico</p>
              <h3 className="metric-value">
                {promedioMes ?? "—"} <span className="value-unit">L/mes</span>
              </h3>
            </div>
            <div className="metric-icon-wrapper bg-light-green">
              <Calendar size={18} className="color-green" />
            </div>
          </div>
          <div className="trending-badge color-green">
            <TrendingDown size={16} />
            <span>Últimos {consumos_recientes.length} registros</span>
          </div>
        </div>
      </div>

      {/* Layout de dos columnas */}
      <div className="main-content-layout">
        {/* Columna Izquierda */}
        <div className="left-column">
          {/* Gráfico de barras con datos reales */}
          <div className="content-card">
            <div className="card-header-row">
              <div>
                <h3 className="card-title">Historial de Consumo</h3>
                <p className="card-subtitle">Últimos {consumos_recientes.length} meses registrados</p>
              </div>
              <button className="dropdown-btn">
                {consumos_recientes[0]?.fecha_lectura
                  ? formatFecha(consumos_recientes[0].fecha_lectura)
                  : "Sin datos"}
                <ChevronDown size={16} />
              </button>
            </div>

            <div className="realtime-chart-container">
              <div className="chart-bars-wrapper">
                {chartBars.map((height, idx) => (
                  <div key={idx} className="chart-column">
                    <div
                      className={`chart-bar ${idx === 0 ? "bar-highlight" : ""}`}
                      style={{ height: `${height}%` }}
                      title={consumos_recientes[idx]
                        ? `${formatFecha(consumos_recientes[idx].fecha_lectura)}: ${consumos_recientes[idx].consumo} L`
                        : ""}
                    ></div>
                  </div>
                ))}
              </div>
              <div className="chart-timeline-labels">
                {consumos_recientes.slice().reverse().map((c, i) => (
                  <span key={i}>
                    {new Date(c.fecha_lectura).toLocaleDateString("es-EC", { month: "short" })}
                  </span>
                ))}
              </div>
            </div>
          </div>

          {/* Historial tabular */}
          <div className="content-card">
            <div className="card-header-row">
              <h3 className="card-title">Historial de Consumo Reciente</h3>
            </div>

            <table className="history-table">
              <thead>
                <tr>
                  <th>Fecha Lectura</th>
                  <th>Consumo</th>
                  <th>Estado</th>
                  <th style={{ textAlign: "center" }}>Acción</th>
                </tr>
              </thead>
              <tbody>
                {consumos_recientes.length === 0 ? (
                  <tr><td colSpan={4} className="empty-state">Sin registros</td></tr>
                ) : (
                  consumos_recientes.map((row, index) => {
                    const est = estadoConsumo(row.consumo, cuota_mensual);
                    return (
                      <tr key={row.id ?? index}>
                        <td>
                          <div className="date-cell">
                            <span className="main-date">{formatFecha(row.fecha_lectura)}</span>
                          </div>
                        </td>
                        <td className={est.cls === "status-exceso" ? "color-red font-bold" : "font-semibold"}>
                          {row.consumo} L
                        </td>
                        <td>
                          <span className={`status-pill ${est.cls}`}>
                            <span className="status-pill-dot"></span>
                            {est.label}
                          </span>
                        </td>
                        <td style={{ textAlign: "center" }}>
                          <button className="btn-action-view"><Eye size={16} /></button>
                        </td>
                      </tr>
                    );
                  })
                )}
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
              Envía un mensaje a {socio?.nombre ?? nombre} sobre su consumo o mantenimientos.
            </p>
            {contacto && (
              <p className="contact-display">📞 {contacto}</p>
            )}
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

            {medidor ? (
              <>
                <p className="meter-serial">Serie: {medidor.numero_serie}</p>
                <div className="meter-status-box">
                  <div className={`status-item ${medidor.activo ? "bg-light-green-box" : "bg-light-red-box"}`}>
                    {medidor.activo
                      ? <CheckCircle2 size={18} className="color-green-dark" />
                      : <AlertCircle  size={18} className="color-red-dark"  />
                    }
                    <div>
                      <h4 className="status-item-title">{medidor.activo ? "Activo" : "Inactivo"}</h4>
                      <p className="status-item-sub">Última lectura: {formatFecha(consumos_recientes[0]?.fecha_lectura)}</p>
                    </div>
                  </div>
                  <div className="status-item bg-light-blue-box">
                    <Battery size={18} className="color-blue-dark" />
                    <div>
                      <h4 className="status-item-title">Medidor #{medidor.id}</h4>
                      <p className="status-item-sub">Sensor de caudal</p>
                    </div>
                  </div>
                </div>
              </>
            ) : (
              <p className="text-muted">Sin medidor registrado</p>
            )}

            <button className="btn-remote-diagnostic">Diagnóstico Remoto</button>
          </div>

          {/* Información del Socio */}
          {socio && (
            <div className="alerts-section">
              <h4 className="alerts-section-title">Responsable de la Propiedad</h4>
              <div className="alert-item-box">
                <div className="alert-item-header">
                  <span className={`alert-dot-indicator ${socio.activo ? "" : "dot-inactive"}`}></span>
                  <span className="alert-source-title">{socio.nombre}</span>
                  <span className={`alert-time ${socio.activo ? "badge-activo" : "badge-inactivo"}`}>
                    {socio.activo ? "Activo" : "Inactivo"}
                  </span>
                </div>
                {contacto && (
                  <p className="alert-body-text">📞 {contacto}</p>
                )}
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}
