import { Routes } from '@angular/router';
import { HomeDocentesComponent } from './home-docentes/home-docentes.component';
import { OrientacionComponent } from './orientacion/orientacion.component';
import { ColeccionCifrasComponent } from './coleccion-cifras/coleccion-cifras.component';
import { MaterialesEducativosDocenteComponent } from './materiales-educativos-docente/materiales-educativos-docente.component';

export const DOCENTES_ROUTES: Routes = [

    { path: 'HomeDocentes', component: HomeDocentesComponent },
    { path: 'orientaciones-docente', component: OrientacionComponent },
    { path: 'materiales-educativos-docente', component: MaterialesEducativosDocenteComponent },
    { path: 'coleccion-en-cifras', component: ColeccionCifrasComponent },
    { path: '**', component: HomeDocentesComponent }
  ];