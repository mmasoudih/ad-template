var vm = new Vue({
  el: "#app",
  created: function(){
    if($cookies.get('user_logged_in')){
      this.userLoggedIn = true;
    }
    if($cookies.get('admin_logged_in')){
      this.isAdmin = true;
    }
  },
  data: function () {
    return {
      modalTitle: "",
      modalContentType: 0,
      userLoggedIn: false,
      isAdmin: false,
      registerForm: {
        fullName: "",
        phone: "",
        password: "",
        passwordConfirm: "",
      },
      loginForm:{
        phone: "",
        password: ""
      }
    };
  },
  methods: {
    showLoginModal() {
      this.modalTitle = "ورود به حساب کاربری";
      this.modalContentType = 1;
      this.showModal();
    },
    closeModal() {
      this.modalTitle = 0;
      this.modalContentType = "";

      this.$refs.modal.style.opacity = 0;
      this.$refs.modal.style.display = "none";
    },
    showRegisterModal() {
      this.modalTitle = "نام نویسی در سایت";
      this.modalContentType = 2;
      this.showModal();
    },
    showModal() {
      this.$refs.modal.style.opacity = 1;
      this.$refs.modal.style.display = "block";
    },
    register() {
      if (this.registerForm.fullName !== "") {
        if (this.registerForm.phone !== "") {
          if (this.registerForm.password !== "") {
            if (this.registerForm.passwordConfirm !== "") {
              if (this.registerForm.password === this.registerForm.passwordConfirm) {
                let data = new FormData();
                data.append("name", this.registerForm.fullName);
                data.append("phone", this.registerForm.phone);
                data.append("password", this.registerForm.password);
                data.append("password_confirm",this.registerForm.passwordConfirm);
                axios.post("/register.php", data);
              } else {
                console.log("رمز عبور یکسان نیست");
              }
            } else {
              console.log("تکرار رمز عبور نمیتواند خالی باشد");
            }
          } else {
            console.log("رمز عبور نمیتواند خالی باشد");
          }
        } else {
          console.log("شماره موبایل را وارد کنید");
        }
      } else {
        console.log("نام را وارد کنید");
      }
    },
    login(){
      if (this.loginForm.phone !== "") {
        if (this.loginForm.password !== "") {
          let data = new FormData();
          data.append("phone", this.loginForm.phone);
          data.append("password", this.loginForm.password);
          axios.post("/login.php", data).then(({data})=>{
            if(data.status === 'ok'){
              window.location.reload();
            }
          });
        }else{
          console.log("رمز عبور نمیتواند خالی باشد");
        }
      }else{
        console.log("شماره موبایل را وارد کنید");
      }
    },
    logout(){
      axios.post("/logout.php").then( res =>{
        if(res.status === 200){
          window.location.reload();
        }
      });
    }
  },
});
