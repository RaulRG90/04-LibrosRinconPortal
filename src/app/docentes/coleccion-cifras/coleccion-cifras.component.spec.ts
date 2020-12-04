import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ColeccionCifrasComponent } from './coleccion-cifras.component';

describe('ColeccionCifrasComponent', () => {
  let component: ColeccionCifrasComponent;
  let fixture: ComponentFixture<ColeccionCifrasComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ColeccionCifrasComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ColeccionCifrasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
