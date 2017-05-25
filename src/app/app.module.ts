import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule, Routes } from '@angular/router';
import { AppComponent } from './app.component';
import { MainPageComponent } from './mainpage/mainpage.component';
import { AboutUsComponent } from './aboutus/aboutus.component';
import { AddTourComponent } from './addtour/addtour.component';

const appRoutes: Routes = [
  { path: '', component: MainPageComponent },
  { path: 'aboutus', component: AboutUsComponent },
  { path: 'dodajstudenta', component: AddTourComponent },

];

@NgModule({
  declarations: [
    AppComponent, AboutUsComponent, MainPageComponent, AddTourComponent
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
