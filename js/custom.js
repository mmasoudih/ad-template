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
      modalTitle: "",
      modalContentType: "",
      userLoggedIn: false,
      isAdmin: false,
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
