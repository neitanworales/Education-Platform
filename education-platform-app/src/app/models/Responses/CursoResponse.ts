import { Curso } from "../Curso";
import { DefaultResponse } from "../DefaultResponse";

export class CursoResponse extends DefaultResponse {
    cursos?: Curso[];
}