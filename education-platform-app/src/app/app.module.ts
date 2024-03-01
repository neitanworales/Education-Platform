import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HomeComponent } from './components/home/home.component';
import { LoginComponent } from './components/login/login.component';
import { RegistroComponent } from './components/registro/registro.component';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { LoginDao } from './api/dao/LoginDao';
import { Utils } from './api/Utils';
import { HttpClientModule } from '@angular/common/http';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { AuthGuardService } from './services/guards/auth-guard.service';
import { AuthService } from './services/guards/auth.service';
import { RoleGuardService } from './services/guards/role-guard.service';
import { SidebarComponent } from './components/admin/sidebar/sidebar.component';
import { EstructuraComponent } from './components/admin/estructura/estructura.component';
import { CursosComponent } from './components/admin/cursos/cursos.component';
import { TemasComponent } from './components/admin/temas/temas.component';
import { ClasesComponent } from './components/admin/clases/clases.component';
import { RecursosComponent } from './components/admin/recursos/recursos.component';
import { AlumnosComponent } from './components/admin/alumnos/alumnos.component';
import { MaestrosComponent } from './components/admin/maestros/maestros.component';
import { CursoDao } from './api/dao/admin/CursoDao';
import { TemaDao } from './api/dao/admin/TemaDao';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    LoginComponent,
    RegistroComponent,
    HeaderComponent,
    FooterComponent,
    DashboardComponent,
    SidebarComponent,
    EstructuraComponent,
    CursosComponent,
    TemasComponent,
    ClasesComponent,
    RecursosComponent,
    AlumnosComponent,
    MaestrosComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule, 
    ReactiveFormsModule,
    HttpClientModule,
  ],
  providers: [
    Utils,
    LoginDao,
    AuthGuardService,
    AuthService,
    RoleGuardService,
    CursoDao,
    TemaDao,
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
