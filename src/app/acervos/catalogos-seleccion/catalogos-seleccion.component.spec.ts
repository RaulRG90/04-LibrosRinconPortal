import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CatalogosSeleccionComponent } from './catalogos-seleccion.component';

describe('CatalogosSeleccionComponent', () => {
  let component: CatalogosSeleccionComponent;
  let fixture: ComponentFixture<CatalogosSeleccionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CatalogosSeleccionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CatalogosSeleccionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
