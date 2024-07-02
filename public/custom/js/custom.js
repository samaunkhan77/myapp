
function showLoader() {
    document.getElementById('loader').classList.remove('d-none')
}
function hideLoader() {
    document.getElementById('loader').classList.add('d-none')
}
function setToken(token) {
    localStorage.setItem("token", `Bearer ${token}`);
}

function getToken(){
    localStorage.getItem("token");
}

function HasToken() {
   let token = getToken();
   return {
       headers: {
           Authorization: token
       }
   }
}
