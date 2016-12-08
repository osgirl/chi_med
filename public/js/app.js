function deleteBtn(button){
  swal({
    title:"Are you sure?",
    text: "You will not be able to recover !",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false },
    function(){
      button.form.submit();
      swal("Deleted!", "", "success");
    });
}
function saveBtn(button){
  swal({
    title:"Success",
    text: "Updated !",
    type: "success",
  },function(){
    button.form.submit();
  });
}
function warningBtn(link){
  swal({
    title:"Warning !",
    text: "Are you sure ?",
    type: "warning",
    showCancelButton: true,
  },function(){
    window.location.href = link;
  });
}
var now = new Date();
var dd = now.getDate();
var mm = now.getMonth()+1; //January is 0!
var yyyy = now.getFullYear();
if(dd<10) {
    dd='0'+dd
}
if(mm<10) {
    mm='0'+mm
}
today = dd+'/'+mm+'/'+yyyy;
document.getElementById('date_now').innerHTML = today;
var weekday = new Array(7);
weekday[0]=  "Sunday";
weekday[1] = "Monday";
weekday[2] = "Tuesday";
weekday[3] = "Wednesday";
weekday[4] = "Thursday";
weekday[5] = "Friday";
weekday[6] = "Saturday";
document.getElementById('weekday_now').innerHTML = weekday[now.getDay()];
