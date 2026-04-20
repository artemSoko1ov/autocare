import { NavLink, Outlet } from "react-router-dom";

const headerLinks = [
  { label: "Главная", to: "/" },
  { label: "Услуги", to: "/services" },
  { label: "Контакты", to: "/contacts" },
  { label: "Вход", to: "/login" },
  { label: "Регистрация", to: "/sign-up" },
];

const MainLayout = () => {
  return (
    <>
      <header>
        <nav>
          {headerLinks.map((link) => (
            <NavLink end={link.to === "/"} to={link.to}>
              {link.label}
            </NavLink>
          ))}
        </nav>
      </header>

      <main className="content">
        <Outlet />
      </main>
    </>
  );
};

export default MainLayout;
