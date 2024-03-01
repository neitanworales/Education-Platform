import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from './auth.service';

@Injectable()
export class AuthGuardService  {
  
  constructor(
    public auth: AuthService, 
    public router: Router) {}

  async canActivate(): Promise<boolean> {
    if (!await this.auth.isAuthenticated()) {
      this.router.navigate(['login']);
      return false;
    }
    return true;
  }

}
