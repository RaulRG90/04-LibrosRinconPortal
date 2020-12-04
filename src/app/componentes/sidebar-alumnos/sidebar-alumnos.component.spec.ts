import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SidebarAlumnosComponent } from './sidebar-alumnos.component';

describe('SidebarAlumnosComponent', () => {
  let component: SidebarAlumnosComponent;
  let fixture: ComponentFixture<SidebarAlumnosComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SidebarAlumnosComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SidebarAlumnosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
