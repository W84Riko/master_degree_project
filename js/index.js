function loadLoginWindowCreation() {
    document.getElementById("login").onclick=createLoginWindow;
}

function createLoginWindow() {
    let loginDiv = document.createElement('div');
    loginDiv.id = "loginWindow";
    document.body.append(loginDiv);
    let form = document.createElement('form');
    loginDiv.append(form);
    let exitBtn = document.createElement('button');
    exitBtn.innerText = "x";
    exitBtn.id = "exitBnt";
    exitBtn.onclick = deleteLoginWindow;     
    loginDiv.append(exitBtn); 
    let nicknameInput = document.createElement('input');
    nicknameInput.type = "text";
    let passwordInput = document.createElement('input');
    passwordInput.type = "password";
    let nicknameLabel = document.createElement('label');
    nicknameLabel.innerText = "Нікнейм";
    let passwordLabel = document.createElement('label');
    passwordLabel.innerText = "Пароль";
    let submitBtn = document.createElement('input');
    submitBtn.type = "submit";
    submitBtn.value = "Увійти";  
    form.append(nicknameLabel);
    form.append(nicknameInput);
    form.append(passwordLabel);
    form.append(passwordInput);
    form.append(submitBtn);
}

function deleteLoginWindow(){
    let loginDiv = document.getElementById("loginWindow");
    loginDiv.remove();
}