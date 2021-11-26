const form = document.querySelector(".modals form"),
continueBtn = form.querySelector(".login input"),
errorText = form.querySelector(".error-text");
var kho= form.querySelector("#herum");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../classes/login.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href = "productdetails.php?id="+kho.value;
              }else{
                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
      }
    }
    let formData = new FormData(form);
    //console.log();
    xhr.send(formData);
}