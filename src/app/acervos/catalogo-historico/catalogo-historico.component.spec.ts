import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CatalogoHistoricoComponent } from './catalogo-historico.component';

describe('CatalogoHistoricoComponent', () => {
  let component: CatalogoHistoricoComponent;
  let fixture: ComponentFixture<CatalogoHistoricoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CatalogoHistoricoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CatalogoHistoricoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
