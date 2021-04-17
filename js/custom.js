var vm = new Vue({
  el: "#app",
  data: function(){
    return {
      modalTitle: '',
      modalContentType: 0,
      registerForm: {
        fullName: '',
        phone: '',
        password: '',
        passwrodConfirm: '',
      },
    }
  },
  methods: {
    showLoginModal(){
      this.modalTitle = 'ورود به حساب کاربری';
      this.modalContentType = 1;
      this.showModal();
    },
    closeModal(){
      this.modalTitle = 0;
      this.modalContentType = '';
      
        this.$refs.modal.style.opacity = 0;
        this.$refs.modal.style.display = 'none';
      
      },
    showRegisterModal(){
      this.modalTitle = 'نام نویسی در سایت';
      this.modalContentType = 2;
      this.showModal();
      
    },
    showModal(){
      
        this.$refs.modal.style.opacity = 1;
        this.$refs.modal.style.display = 'block';
      

    }

  },
});