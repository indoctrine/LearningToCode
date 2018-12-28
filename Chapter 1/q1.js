/*function addinput(div){
  if(counter === limit){
    var removebutton = document.getElementById("addmore");
    document.getElementById("form").removeChild(removebutton);
    document.getElementById("errormsg").innerHTML = "Maximum number of inputs reached";
  }

    var newp = document.createElement('p');
    newp.innerHTML = "Number " + parseInt(counter + 1)  + ": ";
    var newinput = document.createElement('input');
    newinput.type = "number";
    newinput.name = "numberlist[]";
    newinput.step = "any";

    document.getElementById('inputs').appendChild(newp);
    document.getElementById('inputs').appendChild(newinput);
    document.getElementById('inputs').appendChild(document.createElement('br'));
    counter++;
}*/

var limit = 9;
var counter = 1;

$(document).ready(() => {
  $('#addmore').on('click', () => {
    if(counter === limit){
      $('#addmore').hide();
      $('#errormsg').html("Maximum number of inputs reached");
    }

    $('#inputs').append('<p>Number ' + (counter + 1) + ': </p><input type="number" name="numberlist[]" step="any"><br>');
    counter++;
  });

  $(function(){
      $('form').on('submit', event =>{ //On form submission
          event.preventDefault(); //Prevent page refresh
          const numberlistArray = [];

          $('input[name^="numberlist"]').each(function(){ //For each element named "numberlist"
              numberlistArray.push($(this).val());
          });
          $.post(
              'q1.php',
              {'submit': true, 'numberlist': numberlistArray},
              response => {
                  $('#output').html(response);
          });
      });
  });
});
