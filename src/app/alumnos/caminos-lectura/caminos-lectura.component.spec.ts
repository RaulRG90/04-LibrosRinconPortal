import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CaminosLecturaComponent } from './caminos-lectura.component';

describe('CaminosLecturaComponent', () => {
  let component: CaminosLecturaComponent;
  let fixture: ComponentFixture<CaminosLecturaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CaminosLecturaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CaminosLecturaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
