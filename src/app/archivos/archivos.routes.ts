import { Routes } from '@angular/router';
import { HomeArchivosComponent } from './home-archivos/home-archivos.component';
import { ConvocatoriasComponent } from './convocatorias/convocatorias.component';
import { SobreLibroComponent } from './sobre-libro/sobre-libro.component';
import { EstrategiasLecturaComponent, } from './estrategias-lectura/estrategias-lectura.component';
import { MediatecaComponent, } from './mediateca/mediateca.component';


export const ARCHIVOS_ROUTES: Routes = [

    { path: 'HomeArchivos', component: HomeArchivosComponent },
    { path: 'convocatorias', component: ConvocatoriasComponent },
    { path: 'sobre-libro', component: SobreLibroComponent },
    { path: 'estrategias-lectura', component: EstrategiasLecturaComponent },
    { path: 'mediateca', component: MediatecaComponent },
    { path: '**', component: HomeArchivosComponent }
  ];