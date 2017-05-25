import { Component } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import { Router } from '@angular/router';

@Component({
  selector: 'AddTour',
  templateUrl: 'addtour.html'
})

export class AddTourComponent {

  http: Http;
  router: Router;

  addtourForm = new FormGroup({
    ime: new FormControl(),
    prezime: new FormControl(),
    indeks: new FormControl(),
    smer: new FormControl()
  });


  constructor(http: Http, router: Router){
      this.http = http;
      this.router = router;
  }


  addTour(){
    var data = "&country="+this.addtourForm.value.country + "&name=" +
      this.addtourForm.value.name + "&location=" +
      this.addtourForm.value.location + "&num_of_days=" +
      this.addtourForm.value.num_of_days;
      console.log(data);
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    this.http.post('http://localhost/dz11/addTour.php',
    data, { headers: headers }).subscribe(
      data => {
          var obj = JSON.parse(data["_body"]);
          if (obj.success) {
              this.router.navigate(['./']);
            }
          }
      );
  }




}
