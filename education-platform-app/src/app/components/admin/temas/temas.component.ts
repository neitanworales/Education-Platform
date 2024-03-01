import { Component } from '@angular/core';
import { TemaDao } from 'src/app/api/dao/admin/TemaDao';
import { Tema } from 'src/app/models/Tema';

@Component({
  selector: 'app-temas',
  templateUrl: './temas.component.html',
  styleUrls: ['./temas.component.scss']
})
export class TemasComponent {
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
}
