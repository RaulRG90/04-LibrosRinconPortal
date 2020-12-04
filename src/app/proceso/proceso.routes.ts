import { Routes } from '@angular/router';
import { HomeprocesoComponent } from './homeproceso/homeproceso.component';
import { SobreprocesoComponent } from './sobreproceso/sobreproceso.component';
import { IngresomatComponent } from './ingresomat/ingresomat.component';
import { PreseleccionComponent } from './preseleccion/preseleccion.component';
import { SeleccionComponent } from './seleccion/seleccion.component';


export const PROCESO_ROUTES: Routes = [

    { path: 'proceso', component: HomeprocesoComponent },
    { path: 'sobre-proceso',component: SobreprocesoComponent },
    { path: 'ingreso-materiales', component: IngresomatComponent },
    { path: 'preseleccion', component: PreseleccionComponent },
    { path: 'seleccion', component: SeleccionComponent },
    { path: '**', component: HomeprocesoComponent }
  ];