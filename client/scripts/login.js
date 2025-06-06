
// the button event it's pending, but it'd just turn into blue or green color when mouseover it
//  for(i=0;i<=1; i++){
//  inputs[i].addEventListener("mouseover", ()=>{
//      forms.classList.add("red")
//  })
//  inputs[i].addEventListener("mouseout", ()=>{
//       forms.classList.remove("red")  })
//  }

document.addEventListener("DOMContentLoaded", function () {
    const inputs = Array.from(document.getElementsByClassName("signInputs"));
    const forms = document.querySelector("form");
    const submitbutton = document.getElementsByClassName("buttonInputs")

    inputs.forEach((input) => {
      input.addEventListener("mouseover", () => {
        forms.classList.add("red");
      });
      input.addEventListener("mouseout", () => {
        forms.classList.remove("red");
      });
    });
  });

