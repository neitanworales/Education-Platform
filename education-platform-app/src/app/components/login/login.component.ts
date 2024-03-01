import { Component, OnInit } from '@angular/core';
import { UntypedFormGroup, UntypedFormBuilder, Validators } from '@angular/forms';
import { LoginDao } from 'src/app/api/dao/LoginDao';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  username?: String = "";
  password?: String = "";

  registerForm!: UntypedFormGroup;
  submitted = false;
  loginError?: boolean;

  constructor(private formBuilder: UntypedFormBuilder, public loginDao: LoginDao, private router: Router) { }

  ngOnInit(): void {
    if(this.loginDao.validarSession()){
      this.router.navigate(['dashboard']);
    }

    this.registerForm = this.formBuilder.group({
      username: ["", Validators.required],
      password: ["", Validators.required],
    })
    this.loginError = false;
  }

  get form() {
    return this.registerForm?.controls;
  }

  onSubmit() {
    this.submitted = true;
    if (this.registerForm?.invalid) {
      return;
    }
    this.loginDao.login(this.username!, this.password!).subscribe(
      result => {
        if (result.code==200) {
          console.log(result.usuario);
          localStorage.setItem('session', JSON.stringify(result.usuario));
          this.loginError = false;
          this.router.navigate(['dashboard']);
        } else {
          this.loginError = true;
        }
      }
    );
  }

  onReset() {
    this.submitted = false;
    this.registerForm?.reset();
  }
}
