function check() {
    
    var username = document.getElementById('inputUser');
    var pass = document.getElementById('inputPassword');
    
    var reg_username = /^[A-Za-z0-9]{3,}$/;
    var reg_pass = /^[A-Za-z0-9]{5,}$/;
    
    if(!username.value.match(reg_username)){
		window.alert("Username must be one word,can contain only letters and numbers and must be at least 3 characters long.");
	}
    
    if(!pass.value.match(reg_pass)){
		window.alert("Password can contain only letters and numbers and must be at least 6 characters long.");
	}
}