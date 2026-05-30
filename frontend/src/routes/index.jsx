import { createBrowserRouter } from "react-router-dom";

import RootLayout from "../layouts/RootLayout";
import FamilyManagement from "../pages/FamilyManagement/FamilyManagement";
import FamilyDetail from "../pages/FamilyDetail/FamilyDetail";

export const router = createBrowserRouter([
  {
    path: "/",
    element: <RootLayout />,
    children: [
      {
        index: true,
        element: <FamilyManagement />,
      },
      {
        path: "family",
        element: <FamilyManagement />,
      },
      {
        path: "family/:id", // 2. Añade la ruta con el parámetro dinámico ':id'
        element: <FamilyDetail />,
      },
    ],
  },
]);
