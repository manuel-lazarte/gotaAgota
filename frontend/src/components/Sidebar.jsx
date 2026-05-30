import React from "react";
import "./Sidebar.css";
// Puedes usar lucide-react, react-icons o tus propios SVG.
// Aquí uso clases de iconos genéricas como referencia.
import {
  LayoutDashboard,
  Users,
  AlertTriangle,
  History,
  Plus,
  HelpCircle,
  Settings,
} from "lucide-react";

export default function Sidebar() {
  return (
    <aside className="sidebar">
      {/* Header / Logo */}
      <div className="sidebar-header">
        <div className="logo-icon">
          {/* Reemplazar con tu SVG de gota */}
          <span className="drop-emblem">💧</span>
        </div>
        <div className="brand-info">
          <h1 className="brand-name">GotaAGota</h1>
          <p className="brand-sub">Community Water Management</p>
        </div>
      </div>

      {/* Navegación Principal */}
      <nav className="sidebar-nav">
        <ul className="nav-list">
          <li className="nav-item active">
            <a href="/family" className="nav-link">
              <Users className="icon" size={20} />
              <span>Family Management</span>
            </a>
          </li>
        </ul>
      </nav>

      {/* Sección Inferior 固定 */}
      <div className="sidebar-footer">
        <button className="btn-report">
          <Plus size={18} />
          <span>Report Leak</span>
        </button>

        <hr className="divider" />

        <ul className="footer-nav-list">
          <li className="nav-item">
            <a href="#support" className="nav-link">
              <HelpCircle className="icon" size={20} />
              <span>Support</span>
            </a>
          </li>
          <li className="nav-item">
            <a href="#settings" className="nav-link">
              <Settings className="icon" size={20} />
              <span>Settings</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>
  );
}
