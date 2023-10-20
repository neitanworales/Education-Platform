import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { Observable, map } from 'rxjs';
import { environment } from 'src/environments/environment';
import { Utils } from "../Utils";
import { LoginResponse } from "src/app/models/Responses/LoginResponse";

@Injectable()
export class LoginDao {

    constructor(
        private http: HttpClient,
        private utils: Utils
    ) { }

    public login(username: String, password: String): Observable<LoginResponse> {
        var credentials = {
            email : username,
            password : password
        }
        return this.http.post<LoginResponse>(environment.apiUrl + 'authorization/token.php', credentials ,{ headers: this.utils.getHeaders() });
    }
}