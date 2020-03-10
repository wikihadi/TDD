import Fin from './components/Pages/Fin';
import Tasks from './components/Pages/Tasks';
import Timer from './components/Pages/Timer';
import Dashboard from './components/Pages/Dashboard';
import ContactList from './components/pages/ContactList';
import Users from './components/pages/Admin/Users';
import Role from './components/pages/Admin/Role';
export const routes = [
    { path: '/dashboard', component: Dashboard, name: 'Dashboard', meta:{title: 'Dashboard',} },
    { path: '/dashboard/timer', component: Timer, name: 'Timer', meta:{title: 'Dashboard - Timer',}},
    { path: '/dashboard/tasks', component: Tasks, name: 'Tasks', meta:{title: 'Dashboard - Tasks',} },
    { path: '/dashboard/fin', component: Fin, name: 'Fin' },
    { path: '/dashboard/contact-list', component: ContactList, name: 'ContactList' },
    { path: '/dashboard/admin/users', component: Users, name: 'Users', meta:{title: 'Admin - Users',}},
    { path: '/dashboard/admin/roles', component: Role, name: 'Roles', meta:{title: 'Admin - Roles',}},
];
