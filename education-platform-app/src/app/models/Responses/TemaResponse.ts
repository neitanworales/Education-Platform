import { DefaultResponse } from "../DefaultResponse";
import { Tema } from "../Tema";

export class TemaResponse extends DefaultResponse {
    temas?: Tema[];
}