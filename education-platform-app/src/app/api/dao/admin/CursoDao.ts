import { HttpClient } from "@angular/common/http";
import { Inject, Injectable } from "@angular/core";
import { Utils } from "../../Utils";
import { Observable } from "rxjs";
import { CursoResponse } from "src/app/models/Responses/CursoResponse";
import { environment } from "src/environments/environment";

@Injectable()
export class CursoDao {

    constructor(
        private http: HttpClient,
        private utils: Utils
    ) { }

    public getCursos(): Observable<CursoResponse> {
        return this.http.get<CursoResponse>(environment.apiUrl + 'school/cursos', { headers: this.utils.getHeaders() });
    }

}
