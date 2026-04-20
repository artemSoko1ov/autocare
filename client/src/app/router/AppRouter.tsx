import { BrowserRouter, Route, Routes } from "react-router-dom";
import ContactsPage from "@/pages/contacts/ui/ContactsPage";
import HomePage from "@/pages/home/ui/HomePage";
import LoginPage from "@/pages/login/ui/LoginPage";
import NotFoundPage from "@/pages/not-found/ui/NotFoundPage";
import ServicesPage from "@/pages/services/ui/ServicesPage";
import SignUpPage from "@/pages/sign-up/ui/SignUpPage";
import MainLayout from "@/widgets/layout/ui/MainLayout";

const AppRouter = () => {
  return (
    <BrowserRouter>
      <Routes>
        <Route element={<MainLayout />} path="/">
          <Route element={<HomePage />} index />
          <Route element={<ServicesPage />} path="services" />
          <Route element={<ContactsPage />} path="contacts" />
          <Route element={<LoginPage />} path="login" />
          <Route element={<SignUpPage />} path="sign-up" />
          <Route element={<NotFoundPage />} path="*" />
        </Route>
      </Routes>
    </BrowserRouter>
  );
};

export default AppRouter;
