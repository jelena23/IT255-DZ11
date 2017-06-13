import { Component } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import { Router } from '@angular/router';

@Component({
  selector: 'UpdateTour',
  templateUrl: 'updatetour.html'
})

export class UpdateTourComponent {

  http: Http;
  router: Router;

  updatetourForm = new FormGroup({
    country: new FormControl(),
    name: new FormControl(),
    location: new FormControl(),
    num_of_days: new FormControl(),
    id: new FormControl()
  });


  constructor(http: Http, router: Router){
      this.http = http;
      this.router = router;
  }


  updateTour()
  {
    var data = "&country="+this.updatetourForm.value.country + "&name=" + this.updatetourForm.value.name + "&location=" + this.updatetourForm.value.location + "&num_of_days=" + this.updatetourForm.value.num_of_days + "&id=" + this.updatetourForm.value.id;
    console.log(data);
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    this.http.post('http://localhost/dz11/updatetour.php',
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
