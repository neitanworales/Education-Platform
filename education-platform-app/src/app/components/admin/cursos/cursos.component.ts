import { Component } from '@angular/core';
import { CursoDao } from 'src/app/api/dao/admin/CursoDao';
import { Curso } from 'src/app/models/Curso';

@Component({
  selector: 'app-cursos',
  templateUrl: './cursos.component.html',
  styleUrls: ['./cursos.component.scss']
})
export class CursosComponent {

  cursos?: Curso[];

  constructor(
    public dao: CursoDao
  ) { }

  ngOnInit(): void {
    this.getCursos();
  }

  getCursos(){
    this.dao.getCursos().subscribe(
      result=> {
        console.log(result.mensaje);
        this.cursos = result.cursos;
      }
    );
  }

}
