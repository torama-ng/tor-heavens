var count = 0;
function openNav() {
count++
document.getElementById("mySidenav").style.width = "250px";
document.getElementById("main").style.marginLeft = "250px";

if(count%2==0){
document.getElementById("mySidenav").style.width = "0";
document.getElementById("main").style.marginLeft= "0";
}
}