$( document ).ready(function() {
});
function verSupervisorMetro(){
$('#verSupervisorMetro').fadeIn();
$('#verIndividual').fadeOut();
$('#verSupervisorOccdidente').fadeOut();
$('#verSupervisorSureste').fadeOut();
}
function verSupervisorOccdidente(){
  $('#verSupervisorOccdidente').fadeIn();
$('#verSupervisorMetro').fadeOut();
$('#verSupervisorSureste').fadeOut();
$('#verIndividual').fadeOut();
}
function verSupervisorSureste(){
  $('#verSupervisorSureste').fadeIn();
$('#verSupervisorMetro').fadeOut();
$('#verIndividual').fadeOut();
$('#verSupervisorOccdidente').fadeOut();
}
function verIndividual(){
  $('#verIndividual').fadeIn();
$('#verSupervisorMetro').fadeOut();
$('#verSupervisorOccdidente').fadeOut();
$('#verSupervisorSureste').fadeOut();
}
