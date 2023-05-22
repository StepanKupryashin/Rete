<template>
    <div>
      <vs-dialog not-close prevent-close v-model="active">
        <template #header>
          <h4 class="not-margin">
            Welcome to <b>Rete</b>
          </h4>
        </template>


        <div class="con-form">
          <vs-input v-model="login" placeholder="Login">
            <template #icon>

            </template>
          </vs-input>
          <vs-input v-model="email" placeholder="E-mail" type="email">
          </vs-input>
          <vs-input type="password" v-model="password" placeholder="Пароль">
            <template #icon>
            </template>
          </vs-input>
          <vs-input type="password" v-model="passwordConfirm" placeholder="Подтвердите пароль">
            <template #icon>
            </template>
          </vs-input>
        </div>

        <template #footer>
          <div class="footer-dialog">
            <vs-button block @click="registerApply">
              Зарегестрироваться
            </vs-button>
            <div class="new">
              Есть аккаунта? <router-link to="login">Войдите!</router-link>
            </div>
            </div>
        </template>
      </vs-dialog>
    </div>
  </template>

  <script>
  import axios from 'axios';
  export default {
    data: () => ({
      active: true,
      login: '',
      email: '',
      passwordConfirm: '',
      password: '',
    }),
    methods: {
      async registerApply() {
        if(this.password !== this.passwordConfirm) {
            alert('Пароли не совпадают!!');
            return;
        }
        const response = await axios.post('/api/register', {
          login: this.login,
          email: this.email,
          password: this.password
        });
        console.log(response);
        if (response.data.success) {

          localStorage.setItem('access_token', response.data.response.token);

          localStorage.setItem('isAuth', true);

          localStorage.setItem('is_admin', response.data.response.user.is_admin);

          /* this.$router.push({ path: '/' }); */
          window.location = "/";

        }

      },
    },
  };
  </script>

  <style lang="css" scoped>


  .not-margin {
    margin: 0px;
    font-weight: normal;
    padding: 10px;
  }


  h4 {
    font-family: sans-serif;
    font-weight: 700;
    font-size: larger;
  }

  .con-form {
    width: 100%;
    display: flex;
    flex-direction: column;
  }

  .con-form>div {
    margin-bottom: 1rem;
  }

  .con-form .flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .con-form .flex a {
    font-size: 0.8rem;
    opacity: 0.7;
  }

  .con-form .flex a:hover {
    opacity: 1;
  }

  .con-form .vs-checkbox-label {
    font-size: 0.8rem;
  }

  .con-form .vs-input-content {
    margin: 10px 0px;
    width: calc(100%);
  }

  .con-form .vs-input-content .vs-input {
    width: 100%;
  }

  .footer-dialog {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: calc(100%);
  }

  .footer-dialog .new {
    margin: 0px;
    margin-top: 20px;
    padding: 0px;
    font-family: sans-serif;
    font-size: medium;
    font-weight: 600;
  }

  .footer-dialog .new a {
    color: rgba(var(--vs-primary), 1) !important;
    margin-left: 6px;
  }

  .footer-dialog .new a:hover {
    text-decoration: underline;
  }

  .footer-dialog .vs-button {
    margin: 0px;
  }</style>
