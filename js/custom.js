
var vm = new Vue({
  el: "#app",
  created: function () {
    if ($cookies.get("user_logged_in")) {
      this.userLoggedIn = true;
    }
    if ($cookies.get("admin_logged_in")) {
      this.isAdmin = true;
    }
  },
  data: function () {
    return {
      loading: false,
      modalTitle: "",
      modalContentType: "",
      userLoggedIn: false,
      isAdmin: false,
      adsModal: false, 
      adsFileCount: 1,
      maxAdsFileCount: 5,
      adsFileArray: [],
      adsCategoryModalSelected: '',
      registerForm: {
        fullName: "",
        phone: "",
        password: "",
        passwordConfirm: "",
      },
      loginForm: {
        phone: "",
        password: "",
      },
      categoryForm: {
        categoryName: "",
        catIdTemp: "",
      },
      categoryList: [],
      usersList: []
    };
  },
  methods: {
    showLoginModal() {
      this.modalTitle = "ورود به حساب کاربری";
      this.modalContentType = "login";
      this.showModal();
    },
    closeModal() {
      this.modalTitle = "";
      this.modalContentType = "";
      this.categoryForm.catIdTemp = "";
      this.categoryForm.categoryName = "";

      this.$refs.modal.style.opacity = 0;
      this.$refs.modal.style.display = "none";
    },
    showRegisterModal() {
      this.modalTitle = "نام نویسی در سایت";
      this.modalContentType = "register";
      this.showModal();
    },
    showModal() {
      this.$refs.modal.style.opacity = 1;
      this.$refs.modal.style.display = "block";
    },
    openAddCategoryModal() {
      this.modalTitle = "اضافه کردن دسته‌بندی‌ جدید";
      this.modalContentType = "add-category";
      this.showModal();
    },
    addCategory() {
      const data = new FormData();
      data.append("api", "add-category");
      data.append("category_name", this.categoryForm.categoryName);
      axios.post("/index.php", data).then(({ data }) => {
        console.log(data);
        this.getCategory();
        this.closeModal();
      });
    },
    getCategory() {
      const data = new FormData();
      data.append("api", "get-categories");
      axios.post("/index.php", data).then(({ data }) => {
        const { categories } = data;
        this.categoryList = categories;
      });
    },
    deleteCategory(id) {
      const data = new FormData();
      data.append("api", "delete-category");
      data.append("cat_id", id);
      axios.post("/index.php", data).then(({ data }) => {
        const { status } = data;
        if (status === 200) {
          this.getCategory();
        }
      });
    },
    updateCategory() {
      const id = this.categoryForm.catIdTemp;
      const title = this.categoryForm.categoryName;
      const data = new FormData();
      data.append("api", "update-category");
      data.append("cat_id", id);
      data.append("cat_title", title);
      axios.post("/index.php", data).then(({ data }) => {
        const { status } = data;
        if (status === 200) {
          this.getCategory();
          this.categoryForm.catIdTemp = "";
          this.categoryForm.categoryName = "";
          this.closeModal();
        }
      });
    },
    openUpdateCategoryModal(id, title) {
      this.categoryForm.catIdTemp = id;
      this.categoryForm.categoryName = title;
      this.modalTitle = "ویرایش نام دسته‌بندی";
      this.modalContentType = "update-category";
      this.showModal();
    },
    getUsers(){
      const data = new FormData();
      data.append("api", "get-users");
      axios.post("/index.php", data).then(({ data }) => {
        const { status , users} = data;
        if (status === 200) {
          this.usersList = users;
        }
      });
    },
    toggleUserStatus(user_id){
      const data = new FormData();
      data.append("api", "toggle-user-status");
      data.append("user_id", user_id);
      axios.post("/index.php", data).then(({ data }) => {
        const { status } = data;
        // console.log(data);
        if (status === 200) {
          this.getUsers();
        }
      });
    },
    showAdsModal() {
      this.modalTitle = "ایجاد آگهی جدید";
      this.modalContentType = "new-ads";
      this.adsModal = true;
      this.showModal();
      if(this.categoryList.length == 0){
        this.getCategory();
      }
    },
    addNewAdsPicture(){
      if(this.adsFileCount <= this.maxAdsFileCount){
        this.adsFileCount = this.adsFileCount + 1;
        this.adsFileArray.push({
          id: this.makeId(30),
          content: '', 
        });
      }
    },
    makeId(length) {
      let result = ''
      const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
      const charactersLength = characters.length
      for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength))
      }
      return result
    },
    register() {
      if (this.registerForm.fullName !== "") {
        if (this.registerForm.phone !== "") {
          if (this.registerForm.password !== "") {
            if (this.registerForm.passwordConfirm !== "") {
              if (
                this.registerForm.password === this.registerForm.passwordConfirm
              ) {
                let data = new FormData();
                data.append("name", this.registerForm.fullName);
                data.append("phone", this.registerForm.phone);
                data.append("password", this.registerForm.password);
                data.append(
                  "password_confirm",
                  this.registerForm.passwordConfirm
                );
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
    login() {
      if (this.loginForm.phone !== "") {
        if (this.loginForm.password !== "") {
          let data = new FormData();
          data.append("phone", this.loginForm.phone);
          data.append("password", this.loginForm.password);
          axios.post("/login.php", data).then(({ data }) => {
            if (data.status === "ok") {
              window.location.reload();
            }
          });
        } else {
          console.log("رمز عبور نمیتواند خالی باشد");
        }
      } else {
        console.log("شماره موبایل را وارد کنید");
      }
    },
    logout() {
      axios.post("/logout.php").then((res) => {
        if (res.status === 200) {
          window.location.reload();
        }
      });
    },
  },
});
if (window.location.search === "?page=categories") {
  vm.getCategory();
}
if (window.location.pathname === "/") {
  vm.getCategory();
}
if (window.location.search === "?page=users") {
  vm.getUsers();
}

// Add a request interceptor
axios.interceptors.request.use(function (config) {
  // Do something before request is sent
  vm.loading = true;
  return config;
}, function (error) {
  // Do something with request error
  return Promise.reject(error);
});

// Add a response interceptor
axios.interceptors.response.use(function (response) {
  // Any status code that lie within the range of 2xx cause this function to trigger
  // Do something with response data
  vm.loading = false;
  return response;
}, function (error) {
  // Any status codes that falls outside the range of 2xx cause this function to trigger
  // Do something with response error
  return Promise.reject(error);
});
