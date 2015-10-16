
<html xmlns="http://www.w3.org/1999/xhtml">
<head>Welcom Mr.John
	<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="%description%" />
    <meta name="keywords" content="" />
    <meta name="author" content="ComponentOne" />

	

<!--------open database------------->
<?php
/********when you need to connect to the database in your computer with
********postgreSQL please change the query comments here with synax of 
********php to connect to the postgreSQL******************************/
/*--------Postgresql-------------*/
   $db = pg_connect("host=127.0.0.1 port=5432 dbname=SmartCapV21 user=postgres password=root");
   //$db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db){
      echo "Error : Unable to open database\n";
   } else {
     // echo "Opened database successfully\n";
   }
  
$PatientID = "1";

$sql_name =<<<EOF
                            SELECT patient_name from patient where patient_id='$AccountID';
EOF;
$name_query = pg_query($db, $sql_name);
   if(!$name_query){
      echo pg_last_error($db);
      exit;
   }  

   while( $name_row = pg_fetch_row($name_query)){
     $name=($name_row[0]);
   }

/*--------Mysql-------------*/
/*
try{  
//$mysql_host="mysql5.000webhost.com";
//$mysql_database="a1896209_MUSC";
$dbh=new PDO('mysql:host=mysql5.000webhost.com;dbname=a1896209_NUSC','a1896209_NUSC','Smartcap.2014');  
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  
  //$dbh=null; //close connection  
}catch(PDOException$e){  
print"Error!:".$e->getMessage()."<br/>";  
die();  
}  
$pill = "";
  //$sql = "SELECT `pill_name` FROM `pill` WHERE `pill_id`='A1234'";   
$PatientID = "1234567";
$sql = "SELECT `pill_name` from `pill` where `pill_id` in (SELECT `pill_id` from `prescription` where `patient_id`='$PatientID')"; 
          $stmt = $dbh->prepare($sql);    
          $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

   for($i=0; $row = $stmt->fetch(); $i++){
        echo $i." - ".$row['pill_name']."<br/>";
      }

echo $pill;*/
?>
 <script type="text/javascript">
      function getSelectedText(name){        var obj=document.getElementById(name);        for(i=0;i<obj.length;i++){            if(obj[i].selected==true){                return obj[i].innerText;              }        }        }

       function getSelectedValue(name){        var obj=document.getElementById(name);        return obj.value;              }

        function PillAdding(year, name){        alert(year + name);           var postUrl = "./History.php";  
        var postData = year;//第一个数据  
        var msgData = name;//第二个数据  
        var ExportForm = document.createElement("FORM");  
        document.body.appendChild(ExportForm);  
        ExportForm.method = "POST";  
        var newElement = document.createElement("input");  
        newElement.setAttribute("name", "PillSelection");  
        newElement.setAttribute("type", "hidden");  
        var newElement2 = document.createElement("input");  
        newElement2.setAttribute("name", "YearSelection");  
        newElement2.setAttribute("type", "hidden");  
        ExportForm.appendChild(newElement);  
        ExportForm.appendChild(newElement2);  
        newElement.value = postData;  
        newElement2.value = msgData;  
        ExportForm.action = postUrl;  
        ExportForm.submit();                     }

        function displayAll(){        window.open("./HistoryAllDisplay.php");         }




  </script>


</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Individual Calendar</title>
<body>
	<div class="nav">
		<nav>
					<ul id="menu">
						<li id="menu_active"><a href="index.php">Home</a></li>
						<li><a href="Mission.html">Our Mission</a></li>
						<li><a href="News.html">News &amp; Press</a></li>
						<li><a href="Help.html">Information</a></li>
						<li><a href="Contact.cshtml">Contact</a></li>
						<li><a href="Home.cshtml">Log Out</a></li>
					</ul>
				</nav>
		</div> <!---Here goes nav bar----->
      
   
		
		<h1>History for John</h1>
		
	<div class="contain">     <!---Here goes the container of the main part----->
		  <div class="form_part">                <!---Here goes left part----->
                                   <form method="post"> 
		         	   <div>Patient ID:1234567
		         	   	Year
		         	   	<select name="YearSelection" class="YearSelection" id="YearSelection">
		  		         <?php 
       
                                                     
                                                    /* ****** below is for postgres***********/
$sql =<<<EOF
SELECT DISTINCT ON(EXTRACT(YEAR FROM start_time)) EXTRACT(YEAR FROM start_time) from prescription where patient_id='$PatientID'
ORDER BY EXTRACT(YEAR FROM start_time) ASC;
EOF;




$ret = pg_query($db, $sql);
if(!$ret){
 echo pg_last_error($db);
 exit;
}
 $yearArray  = array();
 unset($yearArray);
 $i = 0;
while($row = pg_fetch_row($ret)){
 $yearArray[$i]=($row[0]);
 $i++;
echo "<option >";
echo $row[0];
echo "</option>";}
/************end of postgres**********************************************/

/************below is for Mysql****************************/
/*$pill_sql = "SELECT `pill_name` from `pill` where `pill_id` in (SELECT `pill_id` from `prescription` where `patient_id`='$PatientID')"; 
          $pill_stmt = $dbh->prepare($pill_sql);    
          $pill_stmt->execute();

    // set the resulting array to associative
    $pill = $pill_stmt->setFetchMode(PDO::FETCH_ASSOC); 
    for($i=0; $row = $pill_stmt->fetch(); $i++){
       echo "<option >";
       echo $row['pill_name'];
       echo "</option>";
        //echo $i." - ".$row['pill_name']."<br/>";
      }
   

   */
    ?>   	
		  		          </select>
		  	           <span>Pill Name</span>
		  		         <select name="PillSelection" class="PillSelection" id="PillSelection">
		  		         <?php 
       
                                                     
                                                    /* ****** below is for postgres***********/
$sql =<<<EOF

SELECT pill_name from pill where pill_id in (SELECT pill_id from prescription where patient_id='$PatientID')
ORDER BY pill_name;
EOF;




$ret = pg_query($db, $sql);
if(!$ret){
 echo pg_last_error($db);
 exit;
}
$pillArray  = array();
 unset($pillArray);
 $j = 0;
while($row = pg_fetch_row($ret)){
 $pillArray[$j]=($row[0]);
 $j++;
echo "<option >";
echo $row[0];
echo "</option>";}
/************end of postgres**********************************************/

/************below is for Mysql****************************/
/*$pill_sql = "SELECT `pill_name` from `pill` where `pill_id` in (SELECT `pill_id` from `prescription` where `patient_id`='$PatientID')"; 
          $pill_stmt = $dbh->prepare($pill_sql);    
          $pill_stmt->execute();

    // set the resulting array to associative
    $pill = $pill_stmt->setFetchMode(PDO::FETCH_ASSOC); 
    for($i=0; $row = $pill_stmt->fetch(); $i++){
       echo "<option >";
       echo $row['pill_name'];
       echo "</option>";
        //echo $i." - ".$row['pill_name']."<br/>";
      }
   

   */
    ?>   
		  	           </select>
		  	           
                   <button class="inputB" id="inpB" onclick="PillAdding(getSelectedText('YearSelection'),getSelectedText('PillSelection'))">Choose a pill</button>
                   <button class="inputC" id="inpC" onclick="displayAll()">Display All</button>
                 
             </form>
		  	</div> <!---Here goes form----->
		  	<div class="calender_part"><div id="calendar_postgre" style="width: 1000px; height: 500px; float:left "></div> 
		  </div>
		  
		  	
      
	</div>
	
    <?php
       

        //print_r($_SERVER["REQUEST_METHOD"]);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $Selected_pillname = $_POST["PillSelection"];
                $Selected_year = $_POST["YearSelection"];

         }
         else{
             $Selected_pillname = $pillArray[0];
             $Selected_year = $yearArray[0];
         }
   
        //print_r($pillArray[0]);
        $firstDayofYear = "1" . "January" . $Selected_year;
        $firstDayofYear=strtotime("$firstDayofYear");
        $firstDayofYear = $firstDayofYear + 0;
        $firstDayofYear=date('Y-m-d',"$firstDayofYear");

        $lastDayofYear = "31" . "December" . $Selected_year;
        $lastDayofYear=strtotime("$lastDayofYear");
        $lastDayofYear=$lastDayofYear+60*24*60-1;
        $lastDayofYear=date('Y-m-d',"$lastDayofYear");
        //print_r($firstDayofYear);
        //print_r($lastDayofYear);
        $sql_name =<<<EOF
        SELECT * from prescription JOIN pill on prescription.pill_id = pill.pill_id where (prescription.patient_id = '$PatientID' and pill.pill_name ='$Selected_pillname') and ((start_time <= '$lastDayofYear' and start_time >= '$firstDayofYear') or (stop_time <= '$lastDayofYear'and stop_time >= '$firstDayofYear'));
EOF;
$name_query = pg_query($db, $sql_name);
   if(!$name_query){
      echo pg_last_error($db);
      exit;
   }  
   $startDates = array();
   $endDates = array();
   $timesBetweenDates = array();
   $k = 0;
   while( $name_row = pg_fetch_row($name_query)){
       $startDates[$k] = ($name_row[3]);
       $endDates[$k] = ($name_row[4]);
       $timesBetweenDates[$k] = ($name_row[5]);
       $k = $k + 1; 
   }

   //print_r($startDates);
   //print_r($endDates);
   //print_r($timesBetweenDates);

   $actualTimes = array();
   //print_r($startDates);

    echo "<script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script><script language=\"javascript\">";
    echo  "google.load(\"visualization\", \"1.1\", {packages:[\"calendar\"]});";
    echo  "google.setOnLoadCallback(drawChart);";
    echo "function drawChart() {";
    echo "var dataTable = new google.visualization.DataTable();";
    echo "dataTable.addColumn({ type: 'date', id: 'Date' });";
    echo "dataTable.addColumn({ type: 'number', id: 'Won/Loss' });";
    echo "dataTable.addRows(["; 
    
   //for loop for date range from prescription
   for($prescriptionIndex = 0; $prescriptionIndex < $k; $prescriptionIndex ++ ){
       //print_r($startDates);
       //print_r($startDates[$prescriptionIndex]);
        $sql_timesInRange =<<<EOF
        SELECT count(*), image_timestamp::DATE from photo where patient_id = '$PatientID' and pill_id in (select pill_id from pill where pill_name= '$Selected_pillname') and image_timestamp >= '$startDates[$prescriptionIndex]' and image_timestamp <= '$endDates[$prescriptionIndex]' GROUP BY image_timestamp::DATE;
EOF;
$sql_timesInRange = pg_query($db, $sql_timesInRange);
   if(!$sql_timesInRange){
      echo pg_last_error($db);
      exit;
   }     

   $actualTimes = array();
   $actualDates = array();
   $actualDateTimeHash = array();
   $actualResultIndex = 0;
   while( $timesInRange_row = pg_fetch_row($sql_timesInRange)){
       $actualTimes[$actualResultIndex] = ($timesInRange_row[0]);
       $actualDates[$actualResultIndex] = ($timesInRange_row[1]);
       $actualResultIndex = $actualResultIndex + 1; 
   }

   $actualDateTimeHash = array_combine($actualDates, $actualTimes);
   //print_r($actualDateTimeHash);

   $days = abs(ceil(strtotime($startDates[$prescriptionIndex])-strtotime($endDates[$prescriptionIndex]))/86400) + 1;
   $displayTimes = array();
   $displayDates = array();
   $displayIndex = 0;
   //print_r($days);
   //second for loop to composite data and add to display
   for($displayIndex = 0; $displayIndex < $days; $displayIndex ++ ){
         $displayDay = strtotime($startDates[$prescriptionIndex]) + $displayIndex*60*24*60;
         $displayDay=date('Y-m-d',"$displayDay");
         if(array_key_exists($displayDay, $actualDateTimeHash )){
             $displayTimes[$displayIndex] = $timesBetweenDates[$prescriptionIndex] - $actualDateTimeHash[$displayDay];
         }  
         else{
             $displayTimes[$displayIndex] = $timesBetweenDates[$prescriptionIndex];
         }
         $displayDates[$displayIndex] = str_replace("-", "," , $displayDay );
   }//end for second loop
   //print_r($displayDates);
   //print_r($displayTimes);

    for($setDisplayIndex = 0; $setDisplayIndex < $displayIndex; $setDisplayIndex ++  ){
        echo"[ new Date(";
        echo $displayDates[$setDisplayIndex];
        echo"),";
        echo $displayTimes[$setDisplayIndex];
        echo"],";
    }
   

   }//end of first loop

    echo " ]);";
    echo "for (var y = 0, maxrows = dataTable.getNumberOfRows(); y < maxrows; y++) {";
    echo "var oldDate = dataTable.getValue(y,0); ";
    echo "dataTable.getValue(y,0).setMonth(oldDate.getMonth()-1);";
    echo "}";
    echo "var chart = new google.visualization.Calendar(document.getElementById(\"calendar_postgre\"));";
    echo "var options = {";
    echo "title:\"";
    echo  $Selected_pillname;
    echo "\",";
    echo "height: 350,";
    echo "calendar: {";
    echo "cellColor:{";
    echo "color: 'red', ";
    echo "strokeOpacity: 0.5,";
    echo "strokeWidth: 2";
    echo "}";
    echo "}";
    echo "};";
    echo "chart.draw(dataTable, options);";
    echo "}";
    echo "</script>";
       
        


        
    ?>
  
	
	 <?php
	 /*********************calender chart code**********************************************************/
	 /*Pair A-1<---please delete the comments tag "/*" here to use the following code. The following part is used for postgreSQL
      //javascript for calender goes here
      $Selected_pillname=$Selected_year="";//variables for collect user input
      
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $Selected_pillname = test_input($_POST["PillSelection"]);
          $Selected_year = test_input($_POST["YearSelection"]);
 
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

//$sql_Fulltimestamp =<<<EOF
     // SELECT image_timestamp from photo where patient_id='$PatientID' and pill_id in (select pill_id from pill where pill_name='$Selected_pillname') order by (image_timestamp);
//EOF;

//start date
$pillTimeStart=0;
$pillTimeStop=0;
$sql_start=<<<EOF
     SELECT start_time from prescription where patient_id='$AccountID' and pill_id in (select pill_id from pill where pill_name='$Selected_pillname');
EOF;


$start_result = pg_query($db, $sql_start);
   if(!$start_result){
      echo pg_last_error($db);
      exit;
   } 
 
 
   while( $start_row = pg_fetch_row($start_result)){
       $startDate[$pillTimeStart]=substr($start_row[0],0,10);
       $start_year[$pillTimeStart]=substr($start_row[0],0,4);
       $start_month[$pillTimeStart]=substr($start_row[0],5,2);
       $start_day[$pillTimeStart]=substr($start_row[0],8,2);
       $pillTimeStart++;
   }
//stop date
$sql_stop=<<<EOF
     SELECT stop_time from prescription where patient_id='$AccountID' and pill_id in (select pill_id from pill where pill_name='$Selected_pillname');
EOF;


$stop_result = pg_query($db, $sql_stop);
   if(!$stop_result){
      echo pg_last_error($db);
      exit;
   } 
 
 
   while( $stop_row = pg_fetch_row($stop_result)){
       $stopDate[$pillTimeStop]=substr($stop_row[0],0,10);
       $stop_year[$pillTimeStop]=substr($stop_row[0],0,4);
       $stop_month[$pillTimeStop]=substr($stop_row[0],5,2);
       $stop_day[$pillTimeStop]=substr($stop_row[0],8,2);
       $pillTimeStop++;
   }   
  
   $times_index=0;
   $sql_imageTimestamp =<<<EOF
     SELECT image_timestamp from photo where patient_id='$AccountID' and pill_id in (select pill_id from pill where pill_name='$Selected_pillname') order by (image_timestamp);
EOF;

   $timeStamp_result = pg_query($db, $sql_imageTimestamp);
   if(!$timeStamp_result){
      echo pg_last_error($db);
      exit;
   } 
 
 
   while( $timeStamp_row = pg_fetch_row($timeStamp_result)){
   
      //echo "oldvalue is ="; SELECT extract (year from timestamp '$row[0]');
       $sql_timetrunc =<<<EOF
     SELECT date_trunc('day', timestamp '$timeStamp_row[0]');
EOF;

   $timestamp_trunc_query = pg_query($db, $sql_timetrunc);
   
   if(!$timestamp_trunc_query){
      echo pg_last_error($db);
      exit;
   } 
       while( $Target_row = pg_fetch_row($timestamp_trunc_query)){
       $trunc_imageTimestamp[$times_index]=$Target_row[0];
       
       }
    
      echo $trunc_imageTimestamp[$times_index];
      echo "<br>";
      $times_index++;
   }

    
    
    $source_index=1;//the index of the trunc timestamp
    $target_range=count($trunc_imageTimestamp);

    $targetTimes_array=array();//save the times of the pill
    $targetDate_array= array();//save the date

    $date_index=0;//for the index to trace the date and times
    $times_index=0;

    //initialize
    $targetDate_array = $targetTimes_array[0]="";
    $targetDate_array[0]=$trunc_imageTimestamp[0];
    $targetTimes_array[0]=1;
    echo "initialize: ".$targetDate_array[0];
    echo "<br>";
    while($target_range--){
          if($targetDate_array[$date_index]!=$trunc_imageTimestamp[$source_index])//different date
          {   
              $date_index++;
              $times_index++;
              $targetDate_array[$date_index]=$trunc_imageTimestamp[$source_index];
              $targetTimes_array[$times_index]=1;
          }
          else //same date
          {
              $targetTimes_array[$times_index]++;
          }
          $source_index++;
           
        }
        //test
 $trace_times=count($targetDate_array)-1;   
 $js_index=$trace_times;
 while ($trace_times--){
     echo  "date: ".$targetDate_array[$trace_times];
     echo "<br>";
     echo  "Times: ".$targetTimes_array[$trace_times];
     echo "<br>";
    
 }
// $startDate[0]=$startDate[0]+1;
if ($startDate<$stopDate){
     echo "startDate:".$startDate[0];
     echo "<br>";
     $Y = 2013;
     $M = "09";
     $D = "01";
     $DA = $Y."-".$M."-".$D;
     echo $DA;
     }
 //test end
      $array_index=0;
      echo "<script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script><script language=\"javascript\">";
      echo  "google.load(\"visualization\", \"1.1\", {packages:[\"calendar\"]});
      google.setOnLoadCallback(drawChart);";
      echo "function pillname(){
          alert(\"".$Selected_pillname;
          echo "\");
      }";
   echo      "var PillDate_Year =new Array();
              var PillDate_Month =new Array();
              var PillDate_Day =new Array();
              var PillTimes =new Array();";

  //echo       "var starDate=".$startDate;
  //echo       "var stopDate=".$stopDate;
  //echo       ";";

 /* echo       "var startYear=". $start_year;
  echo       ";var startMonth=".$start_month;
  echo       ";var startDay=".$start_day;
  echo       ";";
  
  echo       "var stopYear=".$stop_year;
  echo       ";var stopMonth=".$stop_month;
  echo       ";var stopDay=".$stop_day;
  echo       ";";*/
 
   //*/ Pair A-2<-please delete these two comments tag here to use code above please do not delete any comments tag inside the pair A

   
           
   
/*   Pair B-1<---please delete the comments tag "/*" here to use the following code.
   if ($targetDate_array[0]==""){
                echo  "alert(\"Not Found!\");";
              }
              else{
while($js_index--){//put the data of date and pill taking times in to javasctript variable
echo          "var times=".$array_index;
echo          ";PillDate_Year[times]=".substr($targetDate_array[$array_index],0,4);
echo          ";PillDate_Month[times]=".substr($targetDate_array[$array_index],5,2);
echo          ";PillDate_Day[times]=".substr($targetDate_array[$array_index],8,2);
echo          ";PillTimes[times]=".$targetTimes_array[$array_index];
echo          ";";


$array_index++;
} }  
echo "var total_days =".$array_index;
   echo ";function drawChart() {
      
   	   var i=0;
       var year,month,day,times,Syear,Smonth,Sday;
       var dataTable = new google.visualization.DataTable();
       dataTable.addColumn({ type: 'date', id: 'Date' });
       dataTable.addColumn({ type: 'number', id: 'Won/Loss' });";

              $i=0;
              $initial=1;
       while($i<$pillTimeStart){
       while($startDate[$i]<$stopDate[$i]){
           if( $initial==1){
             echo       "startYear=". $start_year[$i];
             echo       ";startMonth=".$start_month[$i];
             echo       ";startDay=".$start_day[$i];
             echo       ";";
             $initial=0;
           }
           /*$start_year=substr($startDate[$i],0,4);
           $start_month=substr($startDate[$i],5,2);
           $start_day=substr($startDate[$i],8,2);*/
           
          //*/Pair B-2<-please delete these two comments tag here to use code above please do not delete any comments tag inside the pair B
         
         /*Pair C-1<---please delete the comments tag "/*" here to use the following code.
           echo "if(startMonth<12){
                   if(startMonth==02 && (startYear%4)==0){
                    if(startDay>29){";
                    $start_month[$i]++;
                    $start_day[$i]=01;
            echo   "         startMonth++;
                        startDay=1;
                    }
                       
                    }
                    else if(startMonth==02 && (startYear%4)!=0){
                      if(startDay>28){";
                    $start_month[$i]++;
                    $start_day[$i]=01;
            echo   " 

                        startMonth++;
                        startDay=1;
                    }
                      
                    }
                    
                    else if(startMonth==01 && startMonth==03 && startMonth==05 && startMonth==07 && startMonth==08 && startMonth==10 && startMonth==12){
                    	if(startDay>31){";
                    $start_month[$i]++;
                    $start_day[$i]=01;
            echo   " 
                        startMonth++;
                        startDay=1;
                    }
                       
                    }
                    
                    else if(startMonth==04 && startMonth==06 && startMonth==09 && startMonth==11){
                    	if(startDay>30){";
                    $start_month[$i]++;
                    $start_day[$i]=01;
            echo   " 
                        startMonth++;
                        startDay=1;
                    }
                        
                    }
                    	}
else {";

                    $start_year[$i]++;
                    $start_month[$i]=01;
                    $start_day[$i]=01;
           
	echo "startYear++;
	startMonth=01;
	startDay=01;
	}
                        Syear=startYear;
                        Smonth=startMonth;
                        Sday=startDay;                  
                        dataTable.addRows([
         
                        [ new Date(Syear,Smonth,Sday), 0]
                        ]);

                        startDay++;";
       $startDate[$i]=$start_year[$i]."-"."$start_month[$i]"."-"."$start_day[$i]";
       echo "var news=".$startDate[$i];
       echo ";";
       }
       $i++;
      }
       //get the range from database

    echo  " var pill_name=\"".$Selected_pillname;
    echo   "\";
          var report_title=\"History of \"+\" \"+pill_name;
           while(i<total_days){
           year = PillDate_Year[i];
           month = PillDate_Month[i]-1;
           day = PillDate_Day[i];
           times =PillTimes[i];
       dataTable.addRows([
         
          [ new Date(year,month,day), times]//add rows in calender
        ]);
        i++;
        }
       var chart = new google.visualization.Calendar(document.getElementById('calendar_postgre'));

       var options = {
         title: report_title,
         height: 500,
        calendar: { cellSize: 25},//whole size
         noDataPattern: {//background color without value
           backgroundColor: '#FDFDFD',
           color: '#4BB148'
         },
         calendar: {//cell boder color
      cellColor: {
        stroke: '#76a7fa',
        strokeOpacity: 0.7,
        strokeWidth: 1.5,
      }
    },
    calendar: {//focused cell color
      focusedCellColor: {
        stroke: '#d3362d',
        strokeOpacity: 1,
        strokeWidth: 1,
      },
       calendar: {//week label style
      dayOfWeekLabel: {
        fontName: 'Times-Roman',
        fontSize: 12,
        color: '#1a8763',
        bold: true,
        italic: true,
      },
      dayOfWeekRightSpace: 40,
      daysOfWeek: 'DLMMJVS',
    }

    },
    calendar: {//month style
      monthLabel: {
        fontName: 'Times-Roman',
        fontSize: 12,
        color: '#981b48',
        bold: true,
        italic: true
      },
      monthOutlineColor: {
        stroke: '#981b48',
        strokeOpacity: 0.8,
        strokeWidth: 2
      },
      unusedMonthOutlineColor: {
        stroke: '#bc5679',
        strokeOpacity: 0.8,
        strokeWidth: 1
      },
      underMonthSpace: 16,
    },
     calendar: {//year style
      underYearSpace: 10, // Bottom padding for the year labels.
      yearLabel: {
        fontName: 'Times-Roman',
        fontSize: 32,
        color: '#1A8763',
        bold: true,
        italic: true
      }
    }
         
       };

       chart.draw(dataTable, options);
   }   ";
      echo	"</script>"; 
      
  *///*/Pair C-2<-please delete these two comments tag here to use code above please do not delete any comments tag inside the pair C
  
  ?>  
  

<style>
.nav{width:100%;
	   height:10%;
	   //background:blue;
}	
h1{
text-align:center ;
}
.contain{width:90%;
		 height:80%;
		 /*background:#99CCFF;*/
}
.form_part{width:100%;
		 height:10%;
		/*background:#000099;*/
     float:left;

text-align:center ;

	}
.left_top{width:100%;
		 height:15%;
		 background:#FF9933;
		 float:top;}

.left_bottom{width:100%;
		 height:85%;
		 background:#FFFFCC;
		 float:bottom;}	
/*.right_part{width:30%;
		 height:80%;
		 background:#FFC6AA;
		 float:right;
	}*/
	
/*nav*/
#menu {background:#000;width:90%;height:90%px;float:left;padding:0px 0px 0px 0px;margin:0px;}
#menu li {float:left;padding-left:1px}
#menu li a {display:block;padding:0 20px;height:42px;font-size:18px;color:#dad6cc;line-height:42px;text-transform:uppercase;text-decoration:none;font-weight:400}
#menu li a:hover, #menu #menu_active a {background:url(images/menu_active.gif) top repeat-x;color:#fff}
/*calendar*/
 #eventscalendar
        {
            width: 750px;
        }
 .dot1{
	height: 12px;
width: 12px;
/* border: 1px solid; */
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
margin: 2px;
position: relative;
left: 10px;
background:red;
	}
.dot2{
	height: 12px;
width: 12px;
/* border: 1px solid; */
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
margin: 2px;
position: relative;
left: 10px;
background:#660066;
	}
.dot3{
	height: 12px;
width: 12px;
/* border: 1px solid; */
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
margin: 2px;
position: relative;
left: 10px;
background:#000066;
	}
.dot4{
	height: 12px;
width: 12px;
/* border: 1px solid; */
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
margin: 2px;
position: relative;
left: 10px;
background:#009933;
	}
.dot0{
	height: 12px;
width: 12px;
/* border: 1px solid; */
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
margin: 2px;
position: relative;
left: 10px;
background:#663300;
	}
</style>

 <script type="text/javascript">
 /*********show the calendar****************/
    	$(document).ready(function () {
    		$("#eventscalendar").wijevcal();
    	});
    </script>
</body>
</html>