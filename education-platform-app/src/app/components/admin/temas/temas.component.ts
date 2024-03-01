import { Component } from '@angular/core';
import { TemaDao } from 'src/app/api/dao/admin/TemaDao';
import { Tema } from 'src/app/models/Tema';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Validators } from '@angular/forms';

@Component({
  selector: 'app-temas',
  templateUrl: './temas.component.html',
  styleUrls: ['./temas.component.scss']
})
export class TemasComponent {
  
  temaForm = this.initForm();

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

  loadOnModal(tema: Tema){
    this.temaForm.patchValue({
      isUpdate : true,
      id: tema.id?.toString(),
      titulo: tema.titulo?.toString(),
      descripcion: tema.descripcion?.toString(),
      presentador: tema.presentador?.toString(),
      categoria: tema.categoria?.toString(),
      estatus: tema.estatus?.toString(),
      fecha_creacion: tema.fecha_creacion?.toString(),
      fecha_updated: tema.fecha_updated?.toString(),
    });
  }

  onSubmit(){
    console.warn(this.temaForm.controls['titulo'].value);
  }

  initForm(){
    return this.formBuilder.group({
      isUpdate: [false],
      id: [''],
      titulo: ['', Validators.required],
      descripcion: [''],
      presentador: [''],
      categoria: [''],
      estatus: [''],
      fecha_creacion: [''],
      fecha_updated: [''],
    });
  }
}
