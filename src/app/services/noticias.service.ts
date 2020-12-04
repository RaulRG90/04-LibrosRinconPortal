import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
@Injectable({
  providedIn: 'root'
})
export class NoticiasService {

  constructor(private http: HttpClient) { }
  public noticias(){
    return this.http.get("http://librosdelrincon.sep.gob.mx/php/noticias.php");
  }
}
