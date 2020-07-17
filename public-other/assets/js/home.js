$(document).ready(function() {
$("#registerme").click(function() {
$("#slogin").slideUp("slow", function() {
$("#register").slideDown("slow");
});
});
// On Click SignIn It Will Hide Registration Form and Display Login Form
$("#logmein").click(function() {
$("#register").slideUp("slow", function() {
$("#slogin").slideDown("slow");
});
});
});
