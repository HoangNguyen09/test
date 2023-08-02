let login = document.getElementById('login-h');
    let signup = document.getElementById('signup-h');
    let loginPanel = document.getElementById('login-panel');
    let signupPanel = document.getElementById('signup-panel');

    signup.addEventListener('click', openSignupPage);

    login.addEventListener('click', openLoginPage);

    function openSignupPage(){
      login.classList.remove('active-login');
      loginPanel.style.display = "none";
      signup.classList.add('active-signup');
      signupPanel.style.display = "block";
      //alert('hi');
    }

    function openLoginPage(){
      signup.classList.remove('active-signup');
      signupPanel.style.display = "none";
      login.classList.add('active-login');
      loginPanel.style.display = "block";
    }

    