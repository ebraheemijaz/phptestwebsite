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
  </style>
</head>
<body ng-app="myApp" ng-controller="Ctrl" class="ng-cloak">

<div class="row" ng-show="active == 'showCalender'">
  <div class="col-md-3"></div>
  <div class="col-md-2">
    <a class="button" ng-click="pmonth()">Previous Month</a>
  </div>
  <div class="col-md-2">
    <a class="button" ng-click="cmonth()">Current Month</a>
  </div>
  <div class="col-md-2">
    <a class="button" ng-click="nmonth()">Next Month</a>
  </div>
  <div class="col-md-3"></div>
</div>

<div class="container" ng-show="active == 'showCalender'">
  <h2>{{currentmonthname}} {{currentyear}}</h2>
  <p></p>            

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
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="clanederrow in calender">
        <td ng-repeat="r1 in clanederrow track by $index"  ng-click="selectdate(clanederrow[$index])">
            <a href="">
                {{clanederrow[$index]}}
            </a>
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
                <div class="form-group">
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


<script>
var app = angular.module('myApp', []);
app.controller('Ctrl', function($scope, $http) {
    $scope.data = {}
    $scope.active = "showCalender"
    $scope.allmonthNames = [ "January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December" ];
    
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

    now = new Date()
    $scope.currentmonth =  now.getMonth()
    $scope.currentyear =  now.getFullYear()
    $scope.changecalender($scope.currentmonth, $scope.currentyear)
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

    $scope.selectdate = (date) => {
        $scope.selecteddate = date
        $scope.selectactive("bookform")
    }

    $scope.book = ($event) => {
      $event.target.disabled=true
        if ($scope.bookForm.$invalid){
            alert("Select All Fields.")
            return
        }
        $scope.data.date = new Date(`${$scope.currentmonthname}/${$scope.selecteddate}/${$scope.currentyear}`)
        console.log($scope.data, $http)
        $http.post('./onfirmbooking.php', $scope.data).then(function (response) {
        $event.target.disabled=false
          alert("inserted")
        })
    }


});
</script>
</body>
</html>