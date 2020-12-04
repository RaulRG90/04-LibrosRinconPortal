import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AcervosBeBaComponent } from './acervos-be-ba.component';

describe('AcervosBeBaComponent', () => {
  let component: AcervosBeBaComponent;
  let fixture: ComponentFixture<AcervosBeBaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AcervosBeBaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AcervosBeBaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
