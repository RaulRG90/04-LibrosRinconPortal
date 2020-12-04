import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MaterialesEducativosDocenteComponent } from './materiales-educativos-docente.component';

describe('MaterialesEducativosDocenteComponent', () => {
  let component: MaterialesEducativosDocenteComponent;
  let fixture: ComponentFixture<MaterialesEducativosDocenteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MaterialesEducativosDocenteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MaterialesEducativosDocenteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
