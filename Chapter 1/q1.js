var limit = 9;
var counter = 1;

function addinput(div){
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
}
