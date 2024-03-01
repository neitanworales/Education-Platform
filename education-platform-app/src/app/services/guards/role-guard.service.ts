import { Injectable } from '@angular/core';
import { Router, CanActivate, ActivatedRouteSnapshot, Data } from '@angular/router';
import { LoginDao } from '../../api/dao/LoginDao';
import { AuthService } from './auth.service';
import { lastValueFrom, Observable } from 'rxjs';
import { Role } from 'src/app/models/Role';

@Injectable()
export class RoleGuardService implements CanActivate {

  roles? : Role[];

  constructor(
    public loginDao: LoginDao,
    public auth: AuthService,
    public router: Router) { }

  async canActivate(route: ActivatedRouteSnapshot): Promise<boolean> {
    // this will be passed from the route config
    // on the data property
    const expectedAdmin = route.data;
    // decode the token to get its payload

    if (! await this.auth.isAuthenticated()) {
      this.router.navigate(['login']);
      return false;
    }
    const valuie =  this.validateRole(expectedAdmin);
    return valuie;
  }

  validateRole(expectedAdmin: Data) : Promise<boolean> {
    const resultado = this.loginDao.getValidarRoles(expectedAdmin["roles"]);
    return lastValueFrom(resultado);
  }

}