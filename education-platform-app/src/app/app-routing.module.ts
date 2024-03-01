import { NgModule } from '@angular/core';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { HomeComponent } from './components/home/home.component';
import { LoginComponent } from './components/login/login.component';
import { RegistroComponent } from './components/registro/registro.component';

import { AuthGuardService as AuthGuard } from './services/guards/auth-guard.service';
import { RoleGuardService as RoleGuard } from './services/guards/role-guard.service';
import { AlumnosComponent } from './components/admin/alumnos/alumnos.component';
import { ClasesComponent } from './components/admin/clases/clases.component';
import { CursosComponent } from './components/admin/cursos/cursos.component';
import { EstructuraComponent } from './components/admin/estructura/estructura.component';
import { MaestrosComponent } from './components/admin/maestros/maestros.component';
import { RecursosComponent } from './components/admin/recursos/recursos.component';
import { TemasComponent } from './components/admin/temas/temas.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  { path: '', redirectTo: '/home', pathMatch: 'full' },
  { path: 'home', component: HomeComponent },
  { path: 'registro', component: RegistroComponent },
  { path: 'login', component: LoginComponent },
  { path: 'dashboard', component: DashboardComponent, canActivate: [AuthGuard] },
  { path: 'administracion/alumnos', component: AlumnosComponent, canActivate: [RoleGuard] , data: { roles: ["SUPERUSUARIO","ADMINISTRADOR"]}  },
  { path: 'administracion/clases', component: ClasesComponent, canActivate: [RoleGuard] , data: { roles: ["SUPERUSUARIO","ADMINISTRADOR"]}  },
  { path: 'administracion/cursos', component: CursosComponent, canActivate: [RoleGuard] , data: { roles: ["SUPERUSUARIO","ADMINISTRADOR"]}  },
  { path: 'administracion/estructura', component: EstructuraComponent, canActivate: [RoleGuard] , data: { roles: ["SUPERUSUARIO","ADMINISTRADOR"]}  },
  { path: 'administracion/maestros', component: MaestrosComponent, canActivate: [RoleGuard] , data: { roles: ["SUPERUSUARIO","ADMINISTRADOR"]}  },
  { path: 'administracion/recursos', component: RecursosComponent, canActivate: [RoleGuard] , data: { roles: ["SUPERUSUARIO","ADMINISTRADOR"]}  },
  { path: 'administracion/temas', component: TemasComponent, canActivate: [RoleGuard] , data: { roles: ["SUPERUSUARIO","ADMINISTRADOR"]}  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
