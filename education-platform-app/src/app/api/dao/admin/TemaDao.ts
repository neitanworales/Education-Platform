import { HttpClient } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { Utils } from "../../Utils";
import { TemaResponse } from "src/app/models/Responses/TemaResponse";
import { Observable } from "rxjs";
import { environment } from "src/environments/environment";

@Injectable()
export class TemaDao {
    
    constructor(
        private http: HttpClient,
        private utils: Utils
    ) { }

    public getTemas(): Observable<TemaResponse> {
        return this.http.get<TemaResponse>(environment.apiUrl + 'school/temas', { headers: this.utils.getHeaders() });
    }
}