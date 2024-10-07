/* δημιουργία συνάρτησης για εμφάνιση και μη του κωδικού στα πεδία register και login */
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}