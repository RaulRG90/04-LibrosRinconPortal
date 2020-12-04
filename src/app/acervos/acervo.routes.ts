import { Routes } from '@angular/router';
import { HomeAcervosComponent } from './home-acervos/home-acervos.component';
import { SobrecoleccionComponent } from './sobrecoleccion/sobrecoleccion.component';
import { SeriesComponent } from './series/series.component';
import { TitulosMonolinguesComponent } from './titulos-monolingues/titulos-monolingues.component';
import { TitulosBilinguesComponent } from './titulos-bilingues/titulos-bilingues.component';
import { ProduccionEstatalComponent } from './produccion-estatal/produccion-estatal.component';
import { CategoriasComponent } from './categorias/categorias.component';
import { AcervosBeBaComponent} from './acervos-be-ba/acervos-be-ba.component';
import { CatalogoHistoricoComponent} from './catalogo-historico/catalogo-historico.component';
import { CatalogosSeleccionComponent} from './catalogos-seleccion/catalogos-seleccion.component';


export const ACERVOS_ROUTES: Routes = [

    { path: 'home-acervos', component: HomeAcervosComponent },
    { path: 'sobre-coleccion', component: SobrecoleccionComponent },
    { path: 'series', component: SeriesComponent },
    { path: 'categorias', component: CategoriasComponent }, 
    { path: 'titulos-monolingues', component: TitulosMonolinguesComponent },
    { path: 'titulos-bilingues', component: TitulosBilinguesComponent },
    { path: 'produccion-estatal', component: ProduccionEstatalComponent },
    { path: 'acervos-be-ba', component: AcervosBeBaComponent },
    { path: 'catalogo-historico', component: CatalogoHistoricoComponent },
    { path: 'catalogos-seleccion', component: CatalogosSeleccionComponent },
    { path: '**', component: HomeAcervosComponent }
  ];