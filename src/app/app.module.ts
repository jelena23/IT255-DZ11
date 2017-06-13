import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule, Routes } from '@angular/router';
import { AppComponent } from './app.component';
import { MainPageComponent } from './mainpage/mainpage.component';
import { ViewToursComponent } from './viewtours/viewtours.component';
import { AddTourComponent } from './addtour/addtour.component';
import { TourComponent } from './tour/tour.component';
import { UpdateTourComponent } from './updatetour/updatetour.component';

const appRoutes: Routes = [
  { path: '', component: MainPageComponent },
  { path: 'viewtours', component: ViewToursComponent },
  { path: 'addtour', component: AddTourComponent },
  { path: 'tour/:id', component: TourComponent},
  { path: 'updatetour', component: UpdateTourComponent }

];

@NgModule({
  declarations: [
    AppComponent, ViewToursComponent, MainPageComponent, AddTourComponent, TourComponent, UpdateTourComponent
  ],
  imports: [
    RouterModule.forRoot(appRoutes),
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    HttpModule,
    RouterModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})


export class AppModule { }
