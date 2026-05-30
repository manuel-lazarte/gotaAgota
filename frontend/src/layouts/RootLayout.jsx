import React from "react";
import { Outlet } from "react-router-dom";
import Sidebar from "../components/Sidebar.jsx";
import "./RootLayout.css";

export default function RootLayout() {
  return (
    <div className="layout-container">
      {/* El Sidebar se queda fijo a la izquierda */}
      <Sidebar />

      {/* El main contendrá las páginas de tus rutas (Dashboard, Family, etc.) */}
      <main className="layout-content">
        <Outlet />
      </main>
    </div>
  );
}
