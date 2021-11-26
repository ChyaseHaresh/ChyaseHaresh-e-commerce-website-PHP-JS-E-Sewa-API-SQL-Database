const searchBar = document.querySelector(".search input");
searchIcon = document.querySelector(".search button");
usersList = document.querySelector(".userslist");

searchBar.onkeyup = ()=>{
  let searchTerm = searchBar.value;
  if(searchTerm != ""){
    usersList.removeAttribute("hidden");
  }else{
    usersList.setAttribute("hidden","true");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "includes/searches.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          usersList.innerHTML = data;
          console.log(data);
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);

}
