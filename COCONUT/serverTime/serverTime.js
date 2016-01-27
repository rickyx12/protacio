function DisplayTime(){
if (!document.all && !document.getElementById)
return
timeElement=document.getElementById? document.getElementById("curTime"): document.all.tick2
var CurrentDate=new Date()
var hours=CurrentDate.getHours()
var minutes=CurrentDate.getMinutes()
var seconds=CurrentDate.getSeconds()



if (minutes<=9) minutes="0"+minutes;
if (seconds<=9) seconds="0"+seconds;
if (hours<=9) hours="0"+hours;
var currentTime=hours+":"+minutes+":"+seconds;
timeElement.innerHTML="<input type='hidden' name='serverTime' value='"+currentTime+"' readonly='readonly' maxlength='100'>";
setTimeout("DisplayTime()",2000)
}
