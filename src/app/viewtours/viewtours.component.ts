import { Component, Directive } from '@angular/core';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/Rx';
import {Router} from '@angular/router';

@Component({
  selector: 'ViewTours',
  templateUrl: 'viewtours.html'
})
export class ViewToursComponent {
private data : Object[];
private router: Router;
constructor(private http: Http, router: Router) {
this.router = router;
var headers = new Headers();
headers.append('Content-Type', 'application/x-www-form-urlencoded');

http.get('http://localhost/dz11/gettour.php', {headers: headers})
.map(res => res.json()).share()
.subscribe(data => {
this.data = data.tours;
},
err => {
this.router.navigate(['./']);
}
);
}
public removeTour(event: Event, item: Number) {
var headers = new Headers();
headers.append('Content-Type', 'application/x-www-form-urlencoded');
headers.append('token', localStorage.getItem('token'));
this.http.get('http://localhost/dz11/deletetour.php?id='+item,{headers:headers}) .subscribe( data => {
event.srcElement.parentElement.parentElement.remove();
});
}
public viewTour(item: Number){
this.router.navigate(['/tour', item]);
}


}
