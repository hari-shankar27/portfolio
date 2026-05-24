

const theBtn = document.createElement("button");
theBtn.id="themeToogle";
theBtn.innerText="🌙";
document.body.appendChild(theBtn);

theBtn.addEventListener("click", ()=>{
    document.body.classList.toggle("light");

    if(document.body.classList.contains("light")){
        theBtn.innerText="☀️";
    }else{
        theBtn.innerText="🌙";
    }
    
});