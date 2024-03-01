import { Component, Inject, OnInit } from '@angular/core';
import { UntypedFormGroup, UntypedFormBuilder, Validators, FormGroup, FormControl } from '@angular/forms';
import { LoginDao } from 'src/app/api/dao/LoginDao';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent implements OnInit {
  loginForm = new FormGroup({
    username: new FormControl(''),
    password: new FormControl(''),
  });

  constructor(
    private router: Router, 
    private loginDao: LoginDao) { }

  ngOnInit(): void {
    if (this.loginDao.validarSession()) {

    }
  }

  onSubmit() {
    if (this.loginForm.valid) {
      this.loginDao.login(this.loginForm.controls['username'].value!, 
                          this.loginForm.controls['password'].value!).subscribe(
        result => {
          if (result.code == 200) {
            console.log(result.usuario);
            localStorage.setItem('session', JSON.stringify(result.usuario));
            this.router.navigate(['/dashboard']);
          }
        }
      );
    }
  }
}
