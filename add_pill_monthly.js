var m=0;
var targetCells=$('.wijmo-wijev-monthcell');//document.getElementsByClassName('wijmo-wijev-monthcell');
var cellYear,Month,cellMon,cellDay,curCellid;
var cur_date;
var sign = "<div class=\"dot";
$('.wijmo-wijev-monthcell').each(function(){
	curCellid=targetCells[m].id;//the m'th cell
	//convert the date into formal type
	cellYear=curCellid.substring(11,15);
  Month=curCellid.substring(4,7);
  switch(Month){
  	case "Jan":
  	     cellMon = "01";
  	     break;
  	case "Feb":
  	     cellMon = "02";
  	     break;
  	case "Mar":
  	     cellMon = "03";
  	     break;
  	case "Apr":
  	     cellMon = "04";
  	     break;
    case "May":
         cellMon = "05";
  	     break;
    case "Jun":
         cellMon = "06";
  	     break;
    case "Jul":
         cellMon = "07";
  	     break;
    case "Aug":
         cellMon = "08";
  	     break;
    case "Sep":
         cellMon = "09";
  	     break;
    case "Oct":
         cellMon = "10";
  	     break;
    case "Nov":
         cellMon = "11";
  	     break;
    case "Dec":
         cellMon = "12";
  	     break;
    default: break;
  	} 	
  cellDay=curCellid.substring(8,10);
  cur_date=cellYear+"-"+cellMon+"-"+cellDay;
  alert(cur_date);
  for(p=0;p<j;p++){
  	$.ajax({
        url:'http://nusctesting2014.comuf.com/personalResponse.php',
        type:'post',
        data: { curdate: cur_date,pillname:pill[p] },
        async:false,
        success:function(result){
            alert(result);
            //receive=result;
            times = result;
           // alert("taking time:"+times);
            },
        error:function(msg){
            alert('Error:'+msg);
        }
    });
    sign = sign + p +"id=\""+cur_date+"_"+pill[p]+"><span>"+times+"</span>"+"</div>";
    $(this).append(sign);
  	
  	}
  
  m=m+1;
	
	});







function AddSign(){
    alert(curYear[0]);
    var targetCells=$('.wijmo-wijev-monthcell');//document.getElementsByClassName('wijmo-wijev-monthcell');
    var cellYear, cellMon, cellDay, curCellid;
    var addStar = new Array();
    var addpilldot = new Array();
    var index_star = 0;
    var dot_class;
    if (targetCells) {
        for (var j = 0, count = targetCells.length; j < count; j = j + 1) {
            curCellid = targetCells[j].id;
            cellYear = curCellid.substring(11, 15);
            cellMon = curCellid.substring(4, 7);
            cellDay = curCellid.substring(8, 10);
//            for (time = 0; time < index_sign; time++){
//                if (curYear[time] == cellYear && curMonth[time] == cellMon && curDay[time] == cellDay){
                    //addStar[index_star]=document.createElement(\"img\");
                    //addStar[index_star].src=\"images/1star.jpg\";
//                    addpilldot[index_star] = document.createElement(\"div\");
//                    addpilldot[index_star].id = \"dot\";
//                            
//                    dot_class=\"dot\";
//                    dot_class=dot_class+index_star;
//                    //addpilldot[index_star].class=dot_class;
//                    addpilldot[index_star].setAttribute(\"class\", dot_class); 
//                    addpilldot[index_star].style.float=\"left\";
//                    //addpilldot[index_star].style.Z-INDEX=index_star;
//                    addpilldot[index_star].style.POSITION=\"relative\";
//                           
//                    addpilldot[index_star].onclick=function new_star(){window.open (\"FullInformationPopup.html\",\"newwindow\", \"height=200, width=600, toolbar= no, menubar=no, scrollbars=yes, resizable=yes, location=no, status=no\")};
//                    targetCells[j].appendChild(addpilldot[index_star]);
//    		      //following is used to get full information of the pill-taking. In dialog.html
//                    //addStar[index_star].onclick=function new_star(){window.open (\"FullInformationPopup.html\", \"newwindow\", \"height=200, width=600, toolbar= no, menubar=no, scrollbars=yes, resizable=yes, location=no, status=no\")};
					//targetCells[j].appendChild(addStar[index_star]);//ele.appendChild(dateVisualp[j]);
//    					    index_star++;
//				}
//			}
		}	
	}
	else{
		alert("no such cell");
	}
    	 
};