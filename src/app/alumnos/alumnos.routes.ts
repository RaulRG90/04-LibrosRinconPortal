import { Routes } from '@angular/router';
import { HomeAlumnosComponent } from './home-alumnos/home-alumnos.component';
import { LibrosSugeridosComponent } from './libros-sugeridos/libros-sugeridos.component';
import { CaminosLecturaComponent } from './caminos-lectura/caminos-lectura.component';


export const ALUMNOS_ROUTES: Routes = [

    { path: 'HomeAlumnos', component: HomeAlumnosComponent },
    { path: 'libros-sugeridos', component: LibrosSugeridosComponent },
    { path: 'caminos-lectura', component: CaminosLecturaComponent },
    { path: '**', component: HomeAlumnosComponent }
  ];