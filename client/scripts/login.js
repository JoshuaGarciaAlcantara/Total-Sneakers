inputs = document.getElementsByClassName("signInputs")
forms =document.querySelector("form")
submitbutton = document.getElementsByClassName("buttonInputs")
//rthe button event it's pending, but it'd just turn into blue or green color when mouseover it
for(i=0;i<=1; i++){
inputs[i].addEventListener("mouseover", ()=>{
    forms.classList.add("red")
})
inputs[i].addEventListener("mouseout", ()=>{
     forms.classList.remove("red")
 })
}

