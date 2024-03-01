import { Component } from '@angular/core';
import { TemaDao } from 'src/app/api/dao/admin/TemaDao';
import { Tema } from 'src/app/models/Tema';
import { FormGroup, FormControl } from '@angular/forms';

@Component({
  selector: 'app-temas',
  templateUrl: './temas.component.html',
  styleUrls: ['./temas.component.scss']
})
export class TemasComponent {
  temaForm = new FormGroup({
    id: new FormControl(''),
    titulo: new FormControl(''),
    descripcion: new FormControl(''),
    presentador: new FormControl(''),
    categoria: new FormControl(''),
    estatus: new FormControl(''),
    fecha_creacion: new FormControl(''),
    fecha_updated: new FormControl(''),
    deleted_date: new FormControl(''),
  });
  temas?: Tema[];

  constructor(
    public dao: TemaDao
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
    console.warn(this.temaForm.value);
  }
}
