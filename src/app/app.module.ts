import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HashLocationStrategy, LocationStrategy } from '@angular/common';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { InicioComponent } from './inicio/inicio.component';
import { MenugobComponent } from './componentes/menugob/menugob.component';
import { FootergobComponent } from './componentes/footergob/footergob.component';
import { AcervosComponent } from './acervos/acervos.component';
import { HomeAcervosComponent } from './acervos/home-acervos/home-acervos.component';
import { SobrecoleccionComponent } from './acervos/sobrecoleccion/sobrecoleccion.component';
import { MenuComponent } from './componentes/menu/menu.component';
import { SidebarComponent } from './componentes/sidebar/sidebar.component';
import { SeriesComponent } from './acervos/series/series.component';

import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import { ModalfichaComponent } from './componentes/modalficha/modalficha.component';

import { TitulosMonolinguesComponent } from './acervos/titulos-monolingues/titulos-monolingues.component';
import { TitulosBilinguesComponent } from './acervos/titulos-bilingues/titulos-bilingues.component';
import { ProduccionEstatalComponent } from './acervos/produccion-estatal/produccion-estatal.component';
import { CategoriasComponent } from './acervos/categorias/categorias.component';
import { ProcesoComponent } from './proceso/proceso.component';
import { HomeprocesoComponent } from './proceso/homeproceso/homeproceso.component';
import { SobreprocesoComponent } from './proceso/sobreproceso/sobreproceso.component';
import { IngresomatComponent } from './proceso/ingresomat/ingresomat.component';
import { PreseleccionComponent } from './proceso/preseleccion/preseleccion.component';
import { SeleccionComponent } from './proceso/seleccion/seleccion.component';
import { AlumnosComponent } from './alumnos/alumnos.component';
import { DocentesComponent } from './docentes/docentes.component';
import { HomeAlumnosComponent } from './alumnos/home-alumnos/home-alumnos.component';
import { LibrosSugeridosComponent } from './alumnos/libros-sugeridos/libros-sugeridos.component';
import { HomeDocentesComponent } from './docentes/home-docentes/home-docentes.component';
import { OrientacionComponent } from './docentes/orientacion/orientacion.component';
import { ArchivosComponent } from './archivos/archivos.component';
import { HomeArchivosComponent } from './archivos/home-archivos/home-archivos.component';
import { ConvocatoriasComponent } from './archivos/convocatorias/convocatorias.component';
import { SobreLibroComponent } from './archivos/sobre-libro/sobre-libro.component';
import { EstrategiasLecturaComponent } from './archivos/estrategias-lectura/estrategias-lectura.component';
import { MediatecaComponent } from './archivos/mediateca/mediateca.component';


import { HttpClientModule } from '@angular/common/http';
import { SidebarArchivosComponent } from './componentes/sidebar-archivos/sidebar-archivos.component';
import { SidebarProcesoComponent } from './componentes/sidebar-proceso/sidebar-proceso.component';
import { SidebarDocentesComponent } from './componentes/sidebar-docentes/sidebar-docentes.component';
import { AcervosBeBaComponent } from './acervos/acervos-be-ba/acervos-be-ba.component';
import { CatalogosSeleccionComponent } from './acervos/catalogos-seleccion/catalogos-seleccion.component';
import { CatalogoHistoricoComponent } from './acervos/catalogo-historico/catalogo-historico.component';
import { CaminosLecturaComponent } from './alumnos/caminos-lectura/caminos-lectura.component';
import { SidebarAlumnosComponent } from './componentes/sidebar-alumnos/sidebar-alumnos.component';
import { ColeccionCifrasComponent } from './docentes/coleccion-cifras/coleccion-cifras.component';
import { MaterialesEducativosDocenteComponent } from './docentes/materiales-educativos-docente/materiales-educativos-docente.component';
import { ScrollTopComponent } from './componentes/scroll-top/scroll-top.component';



@NgModule({
  declarations: [
    AppComponent,
    InicioComponent,
    MenugobComponent,
    FootergobComponent,
    AcervosComponent,
    HomeAcervosComponent,
    SobrecoleccionComponent,
    MenuComponent,
    SidebarComponent,
    SeriesComponent,
    ModalfichaComponent,
    TitulosMonolinguesComponent,
    TitulosBilinguesComponent,
    ProduccionEstatalComponent,
    CategoriasComponent,
    ProcesoComponent,
    HomeprocesoComponent,
    SobreprocesoComponent,
    IngresomatComponent,
    PreseleccionComponent,
    SeleccionComponent,
    AlumnosComponent,
    DocentesComponent,
    HomeAlumnosComponent,
    LibrosSugeridosComponent,
    HomeDocentesComponent,
    OrientacionComponent,
    ArchivosComponent,
    HomeArchivosComponent,
    ConvocatoriasComponent,
    SobreLibroComponent,
    EstrategiasLecturaComponent,
    SidebarArchivosComponent,
    SidebarProcesoComponent,
    SidebarDocentesComponent,
    AcervosBeBaComponent,
    CatalogosSeleccionComponent,
    CatalogoHistoricoComponent,
    MediatecaComponent,
    CaminosLecturaComponent,
    SidebarAlumnosComponent,
    ColeccionCifrasComponent,
    MaterialesEducativosDocenteComponent,
    ScrollTopComponent,

    

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    HttpClientModule
  ],
  entryComponents:[
    ModalfichaComponent
  ],
  providers: [{provide: LocationStrategy, useClass: HashLocationStrategy}],
  bootstrap: [AppComponent]
})
export class AppModule { }
