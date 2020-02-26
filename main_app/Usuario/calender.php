<?php
session_start();
if (isset($_SESSION['usuario'])){
  if($_SESSION['usuario']['tipo'] != "Usuario"){
    header('location: ../Admin/');
  }
} else {
    header('location: ../../');
    }
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139134363-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-139134363-1');
</script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Portal de Consultas Comercializadora Hamse</title>
  <div class="header">
  <img src="../../img/logop.png">
</div> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.8/angular.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .strong {
      display: block;
      font-size: 20px;
      margin-bottom: 10px !important
     
    }

    td {
      text-align: left;
    }

    th {
      line-height: 1
    }

    thead { color: white;
      background-color: #192970;
      
    }

    .yellow {
      color: black;
      font-weight: bold;
      background-color: #e68a00;
      opacity: 0.6;
    }

    .green {
      color: black;
      font-weight: bold;
      background-color: #7aa33d;
      opacity: 0.7;
    }

    .prog {
      color: #4d4d4d;
      font-style: italic;
      background-color: white
    }
	 .canc {
      color: black;
      background-color: #ff6633;
	  opacity: 0.8;
    }
    .header {
      width: 100%; 
                height: 100%; 
                weight: 100%;
                text-align: center;
                object-fit: contain ; 
                position: relative;
    }
    .bvb {
          color: #f4bd3e;
    }

    .button {
    display: inline-block;
    text-align: center;
    vertical-align: middle;
    padding: 13px 58px;
    border: 1px solid #172565;
    border-radius: 0px;
    background: #3f67ff;
    background: -webkit-gradient(linear, left top, left bottom, from(#3f67ff), to(#172565));
    background: -moz-linear-gradient(top, #3f67ff, #172565);
    background: linear-gradient(to bottom, #3f67ff, #172565);
    -webkit-box-shadow: #4c7cff 0px 0px 0px 0px;
    -moz-box-shadow: #4c7cff 0px 0px 0px 0px;
    box-shadow: #4c7cff 0px 0px 0px 0px;
    text-shadow: #0d1538 1px 1px 0px;
    font: normal normal bold 20px verdana;
    color: #f5f5f5;
    text-decoration: none;
    }
    .button:hover,
    .button:focus {
        border: 1px solid #192970;
        background: #4c7cff;
        background: -webkit-gradient(linear, left top, left bottom, from(#4c7cff), to(#1c2c79));
        background: -moz-linear-gradient(top, #4c7cff, #1c2c79);
        background: linear-gradient(to bottom, #4c7cff, #1c2c79);
        color: #f5f5f5;
        text-decoration: none;
    }
    .button:active {
        background: #172565;
        background: -webkit-gradient(linear, left top, left bottom, from(#172565), to(#172565));
        background: -moz-linear-gradient(top, #172565, #172565);
        background: linear-gradient(to bottom, #172565, #172565);
    }
    .book-green {
      background: green;
      color: white;
      padding: 2%;
    }
    .book-red {
      background: red;
      color: white;
      padding: 2%;
    }
  </style>
</head>
<body ng-app="myApp" ng-controller="Ctrl" class="ng-cloak">

<div class="row" ng-show="active == 'showCalender'">
  <div class="col-md-3"></div>
  <div class="col-md-2">
    <button class="button" ng-disabled="calender==undefined" ng-click="pmonth()">Previous Month</button>
  </div>
  <div class="col-md-2">
    <button class="button" ng-disabled="calender==undefined" ng-click="cmonth()">Current Month</button>
  </div>
  <div class="col-md-2">
    <button class="button" ng-disabled="calender==undefined" ng-click="nmonth()">Next Month</button>
  </div>
  <div class="col-md-3"></div>
</div>

<div class="container" ng-show="active == 'showCalender'">
  <h2>{{currentmonthname}} {{currentyear}}</h2>
  <p hidden id="userid"><?php echo $_SESSION['usuario']['id'] ?></p>            

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Sunday</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
        <th>Saturday</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-show="calender==undefined">
        <td>Loading</td>
      </tr>
      <tr ng-repeat="clanederrow in calender" id="{{rowid}}" ng-init="rowid=calculateid(clanederrow)">
        <td ng-repeat="r1 in clanederrow track by $index">
            <div ng-show=clanederrow[$index] == ''>
              <div>
                {{clanederrow[$index]}}
              </div>
              <button ng-show="$index==0" class="btn btn-danger"  disabled>
                Unavaiable
              </button>
              <button ng-show="rowid!=activerowid && $index!=0" class="btn btn-danger" disabled>
                  N/A
              </button>
              <button ng-show="rowid==activerowid && $index!=0" class="btn btn-success" ng-click="selectdate(clanederrow[$index], rowid)">
                  <span>
                    {{bookingcount(clanederrow[$index]+""+currentmonthname+""+currentyear)}}
                  </span>
                  Book
              </button>
              <!-- <button ng-show="!($index==0)" class="btn" ng-class="calculat(clanederrow[$index], currentmonthname, currentyear)=='N/A' || calculat(clanederrow[$index], currentmonthname, currentyear)=='Booked'? 'btn-danger': 'btn-success'" 
                  ng-disabled="calculat(clanederrow[$index], currentmonthname, currentyear) == 'Booked' || calculat(clanederrow[$index], currentmonthname, currentyear)=='N/A'" ng-click="selectdate(clanederrow[$index])">
                <span id="{{clanederrow[$index]}}{{currentmonthname}}{{currentyear}}">
                  {{bookingcount(clanederrow[$index]+""+currentmonthname+""+currentyear)}}
                </span>
                <span>
                  {{calculat(clanederrow[$index], currentmonthname, currentyear)}}
                </span>
              </button> -->
            </div>
        </td>
        <td>
            <button ng-show="rowid==activerowid" class="btn btn-success"  
                  ng-disabled="" ng-click="showallweekbooking(rowid)">
                Confirm
            </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<div class="container" ng-show="active == 'bookform'">
    <div class="row">
        <div class="col-md-12">
            <a class="button" ng-click="selectactive('showCalender')">Back</a>
        </div>
        <div class="col-md-12 text-center">
            <h2>{{selecteddate}} {{currentmonthname}} {{currentyear}}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form name="bookForm">
                <div class="form-group" ng-init="data.userid='<?php echo $_SESSION['usuario']['id'] ?>'">
                    <label for="sel1">Select Product:</label>
                    <select required class="form-control" id="sel1" ng-model="data.product">
                        <option value="">Select</option>
                        <?php
                            $allproducts = explode(",", $_SESSION['usuario']["producto"] );
                            for ($x = 0; $x <= count($allproducts); $x++) {
                                if (count($allproducts[$x]) != 0){
                                    echo "<option value='$allproducts[$x]'>$allproducts[$x]</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1">Select Capacity:</label>
                    <select required class="form-control" id="sel1" ng-model="data.capacity">
                        <option value="">Select</option>
                        <?php
                            $allcapacidad = explode(",", $_SESSION['usuario']["capacidad"] );
                            for ($x = 0; $x <= count($allcapacidad); $x++) {
                                if (count($allcapacidad[$x]) != 0){
                                    echo "<option value='$allcapacidad[$x]'>$allcapacidad[$x]</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1">Select Turn:</label>
                    <select required class="form-control" id="sel1" ng-model="data.turn">
                        <option value="">Select</option>
                        <?php
                            $allturno = explode(",", $_SESSION['usuario']["turno"] );
                            for ($x = 0; $x <= count($allturno); $x++) {
                                if (count($allturno[$x]) != 0){
                                    echo "<option value='$allturno[$x]'>$allturno[$x]</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group" style="float: right !important;">
                    <button type="submit" ng-click="book($event)" class="btn btn-default button">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm Booking</h4>
      </div>
      <div class="modal-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Product</th>
            <th>Capacity</th>
            <th>Turn</th>
            <th>date</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-show="allweeklybookings==undefined">
            <td>Loading...</td>
          </tr>
          <tr ng-repeat="eachwbook in allweeklybookings" ng-show="allweeklybookings!=undefined">
            <td>{{eachwbook[0]}}</td>
            <td>{{eachwbook[1]}}</td>
            <td>{{eachwbook[2]}}</td>
            <td>{{eachwbook[3]}}</td>
            <td>
              <button ng-click="deletebooking(eachwbook[4], $event)" class="btn btn-danger">
                delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="modal-footer">
          <button ng-click="sendbooking($event)" class="button float-right" ng-show="allweeklybookings!=undefined">
                            Send
          </button>
      </div>
    </div>

  </div>
</div>

<script>
var app = angular.module('myApp', []);
app.controller('Ctrl', function($scope, $http) {
    $scope.userid= angular.element('#userid')[0].innerText
    $scope.data = {}
    $scope.active = "showCalender"
    $scope.allmonthNames = [ "January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December" ];
    
    $http.post('./lastbookingid.php', {userid : $scope.userid}).then(function (response) {
      let now = new Date()
      let nextweekdate=new Date(now.getTime() + 1000*60*60*24*14 )
      let nextweekstart = new Date(new Date(nextweekdate.getFullYear()+"/"+(nextweekdate.getMonth()+1)+"/"+nextweekdate.getDate()) - nextweekdate.getDay()*1000*60*60*24)
      let nextweekend = new Date(new Date(new Date(nextweekdate.getFullYear()+"/"+(nextweekdate.getMonth()+1)+"/"+nextweekdate.getDate()) - nextweekdate.getDay()*1000*60*60*24).getTime() + 1000*60*60*24*6)
      $scope.activerowid = nextweekstart.getDate()+""+$scope.allmonthNames[nextweekstart.getMonth()]+""+nextweekstart.getFullYear()
      if (response.data.data.length != 0){
        if(nextweekstart.getTime() < new Date(response.data.data[0][2]).getTime()){
          while ( nextweekstart.getTime() < new Date(response.data.data[0][2]).getTime()  ){
            console.log("stepup")
            nextweekstart = new Date(nextweekstart.getTime() + 1000*60*60*24*7)
            nextweekend = new Date(nextweekend.getTime() + 1000*60*60*24*7)
            if (nextweekstart.getMonth() != nextweekend.getMonth()){
              let dday = nextweekstart
              while(dday.getMonth() == nextweekstart.getMonth()){
                dday = new Date(dday.getTime() + 1000*60*60*24)
              }
              nextweekend = dday
              // nextweekstart = nextweekend
            }

          }
          $scope.activerowid = nextweekstart.getDate()+""+$scope.allmonthNames[nextweekstart.getMonth()]+""+nextweekstart.getFullYear()
        }
      }
    })

    $scope.changecalender = (month, year) => {
        $scope.calender = [
            ["", "", "", "", "", "", ""],
        ]
        $scope.currentmonthname = $scope.allmonthNames[month]
        $scope.currentyear = year
        let dindex=1
        let startdate = new Date(`${month+1}/${dindex}/${year}`)
        let line = 0
        let lineindex = startdate.getDay()
        for (dindex=1; dindex<=31; dindex++){
            $scope.calender[line][lineindex] = dindex
            lineindex = lineindex + 1
            if (new Date(`${month+1}/${dindex}/${year}`).getMonth() != new Date(`${month+1}/${dindex+1}/${year}`).getMonth()) {
                break
            }
            if ((lineindex)%7 == 0) { 
                line = line + 1; 
                lineindex=0
                $scope.calender.push(["", "", "", "", "", "", ""])
            }
        }
        
    }
    
    $http.post('./getallbookings.php', {userid : $scope.userid}).then(function (response) {
      $scope.allbookeddates = {}
      for (each of response.data.data){
        $scope.allbookeddates[each[0]] = each[1]
      }
      $scope.changecalender($scope.currentmonth, $scope.currentyear)
    })

    now = new Date()
    $scope.currentmonth =  now.getMonth()
    $scope.currentyear =  now.getFullYear()
    
    console.log($scope.calender)

    $scope.pmonth = () => {
        $scope.currentmonth = $scope.currentmonth - 1
        console.log($scope.currentmonth )
        if ( ( $scope.currentmonth  ) == -1 ){
            $scope.currentmonth= 11
            $scope.currentyear = $scope.currentyear - 1
        }
        $scope.changecalender($scope.currentmonth, $scope.currentyear)
    }
    $scope.cmonth = () => {
        now = new Date()
        $scope.changecalender(now.getMonth(), now.getFullYear())
        $scope.currentmonth =  now.getMonth()
        $scope.currentyear =  now.getFullYear()
    }
    $scope.nmonth = () => {
        $scope.currentmonth = $scope.currentmonth + 1
        console.log($scope.currentmonth )
        if ( ( $scope.currentmonth  ) % 12==0 ){
            $scope.currentmonth=0
            $scope.currentyear = $scope.currentyear + 1
        }
        $scope.changecalender($scope.currentmonth, $scope.currentyear)
    }

    $scope.selectactive = (name) => {
        $scope.active = name
    }

    $scope.selectdate = (date, bookrowid) => {
        $scope.selecteddate = date
        $scope.data.bookid = date + $scope.currentmonthname + $scope.currentyear
        $scope.data.bookrowid = bookrowid
        $scope.selectactive("bookform")
    }

    $scope.book = ($event) => {
      $event.target.disabled=true
        if ($scope.bookForm.$invalid){
            alert("Select All Fields.")
            $event.target.disabled=false
            return
        }
        // $scope.data.date = new Date(`${$scope.currentmonthname}/${$scope.selecteddate}/${$scope.currentyear}`)
        $scope.data.date = `${$scope.currentyear}/${$scope.allmonthNames.indexOf($scope.currentmonthname)+1}/${$scope.selecteddate}`
        console.log($scope.data, $http)
        $http.post('./onfirmbooking.php', $scope.data).then(function (response) {
        $event.target.disabled=false
          location.reload();
          alert("inserted")
          // $scope.allbookeddates.push($scope.data.date)
        })
    }

    $scope.calculat = (date, month, year) => {
      let calenderdate = new Date(`${date}/${month}/${year}`)
      let now = new Date()
      let nextweekdate=new Date(now.getTime() + 1000*60*60*24*14 )
      let nextweekstart = new Date(new Date(nextweekdate.getFullYear()+"/"+(nextweekdate.getMonth()+1)+"/"+nextweekdate.getDate()) - nextweekdate.getDay()*1000*60*60*24)
      let nextweekend = new Date(new Date(new Date(nextweekdate.getFullYear()+"/"+(nextweekdate.getMonth()+1)+"/"+nextweekdate.getDate()) - nextweekdate.getDay()*1000*60*60*24).getTime() + 1000*60*60*24*6)
      if ( calenderdate.getTime() >= nextweekstart.getTime() && calenderdate.getTime() <= nextweekend.getTime() ){
        return "Book"
      }
      else {
        return "N/A"
      }
      // for (eachbooked of $scope.allbookeddates){
      //   d1 = new Date(`${year}/${$scope.allmonthNames.indexOf(month)+1}/${date}`)
      //   d2 = new Date(eachbooked)
      //   if ( d1.getDate() == d2.getDate() && d1.getMonth() == d2.getMonth() && d1.getFullYear() == d2.getFullYear() ) {
      //     return "Booked"
      //   }
      // }
      // dd = new Date(`${date}/${month}/${year}`)
    }

    $scope.bookingcount = (id) => {
      return $scope.allbookeddates[id] == undefined ? 0 : $scope.allbookeddates[id]
    }

    $scope.calculateid = (row) => {
      for (let eachitem of row){
        if (eachitem != '') {
          return ""+eachitem+""+$scope.currentmonthname+""+$scope.currentyear
        }
      }
    }

    $scope.showallweekbooking = (id) => {
      $("#myModal").modal()
      $http.post('./getweeklybookings.php', {userid : $scope.userid, bookrowid: id}).then(function (response) {
        $scope.allweeklybookings = response.data.data
      })
    }
    $scope.deletebooking = (id, $event) => {
      $event.target.disabled=true
      $event.target.innerText = "deleting"
      $http.post('./deletebooking.php', {id: id}).then(function (response) {
        alert("deleted")
        location.reload();
      })
    }
    $scope.sendbooking = ($event) => {
      $event.target.disabled=true
      $event.target.innerText = "Processing..."
      $http.post('./sendbooking.php', {bookrowid: $scope.activerowid}).then(function (response) {
        alert("Confirmed")
        location.reload();
      })
    }
    

});
</script>
</body>
</html>