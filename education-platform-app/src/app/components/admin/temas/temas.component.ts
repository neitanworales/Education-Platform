import { Component } from '@angular/core';
import { TemaDao } from 'src/app/api/dao/admin/TemaDao';
import { Tema } from 'src/app/models/Tema';
import { FormBuilder } from '@angular/forms';
import { Validators } from '@angular/forms';

@Component({
  selector: 'app-temas',
  templateUrl: './temas.component.html',
  styleUrls: ['./temas.component.scss']
})
export class TemasComponent {
  temaForm = this.formBuilder.group({
    id: [''],
    titulo: ['', Validators.required],
    descripcion: [''],
    presentador: [''],
    categoria: [''],
    estatus: [''],
    fecha_creacion: [''],
    fecha_updated: [''],
    deleted_date: [''],
  });
  temas?: Tema[];

  constructor(
    public dao: TemaDao,
    private formBuilder: FormBuilder
  ) {}

  ngOnInit(): void {
    this.getTemas();
  }

  getTemas(){
    this.dao.getTemas().subscribe(
      result=> {
        console.log(result.mensaje);
        this.temas = result.temas;
      }
    );
  }

  onSubmit(){
    console.warn(this.temaForm.controls['titulo'].value);
  }
}
