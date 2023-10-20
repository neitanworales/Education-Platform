import { Injectable } from '@angular/core';
import { Router, CanActivate } from '@angular/router';
import { AuthService } from './auth.service';

@Injectable()
export class AuthGuardService implements CanActivate {
  
  constructor(
    public auth: AuthService, 
    public router: Router) {}

  async canActivate(): Promise<boolean> {
    if (!await this.auth.isAuthenticated()) {
      console.log("deslogeado");
      this.router.navigate(['login']);
      return false;
    }
    console.log("aun logeado");
    return true;
  }

}
