<script setup>
//LUIS
import { Form, Field, ErrorMessage } from 'vee-validate';

//REY
const state = reactive({
  errors: [],
  user:{
      email: null,
      password: null,
  },
})

//KENT
const passwordFieldType = ref('password');
const isInputFocused = ref(false);
let passwordInput = null;


//KENT
const showPassword = () => {
  passwordFieldType.value = passwordFieldType.value === 'password' ? 'text' : 'password';
  if (passwordInput) {
    passwordInput.focus();
  }
};

definePageMeta({
  layout: 'empty'
})



//REY,LUIS
async function handleLogin(){
const params = { 
  email: state.user.email,
  password: state.user.password
}
try{
  const response = await $fetch(`http://127.0.0.1:8000/api/login`, {
  method: 'POST',
  body: params})

  if(response.data){
  localStorage.setItem('_token', response.data.token)
  state.token = localStorage.getItem('_token')
  navigateTo('/admin/dashboard');}
  }

catch(error){
  state.errors = error.response
  console.log(error.response)
  console.log('error', error)
  }
}


</script>

<template>
  <div class="gradient-bg h-full w-full">
    <div class="flex items-center justify-center h-screen">
      <Form @submit="handleLogin()" class="h-auto lg:w-1/3 md:w-2/4 w-3/4 dark-bg duration-200 rounded shadow-custom p-10 long-text tracking-wide">

        <section class="flex justify-between items-center mb-5">
            <nuxt-link to="/login/as-client">
              <BackButton tabindex="5"/>
            </nuxt-link>
          <div class="flex items-center justify-end">
              <Label label="Admin" iconName="material-symbols-light:admin-panel-settings-outline-rounded" class="text-2xl font-semibold" :iconHeight='10'/>
            </div>
        </section>

        <hr class="mb-5">
        {{ state.errors && state.errors._data && state.errors._data.error}}

        <section class="mb-5">
          <div class="flex items-center justify-start">
            <Label label="Username" iconName="material-symbols:person" class="text-base" :iconHeight='5'/>
          </div>
          <Field type="text" name="username" placeholder="Enter your username" class="w-full bg-[#cbd2d7] focus:bg-[#e5e8eb] py-2 px-3 rounded border border-black transition-all duration-300 outline-none focus:border-white text-black mt-1"
            :rules="validateUserName"
            v-model="state.user.email"
            tabindex="1"
          />
          <ErrorMessage class="text-red-500 text-xs italic font-bold" name="username"/>
        </section>

        <section>
          <div class="flex justify-between">
            <div class="flex items-center justify-start">
              <Label label="Password" iconName="solar:lock-password-unlocked-bold" class="text-base" :iconHeight='5'/>
            </div>
            <div class="flex gap-1 items-center w-auto">
              <nuxt-link to="#">
                <LoginForgotPassword tabindex="4"/>
              </nuxt-link>
            </div>
          </div>

          <span class="flex items-center relative">
            <Field :type="passwordFieldType" @focus="isInputFocused = true" @blur="isInputFocused = false" ref="passwordField" name="password" placeholder="Enter your password"
            class="w-full bg-[#cbd2d7] focus:bg-[#e5e8eb] py-2 px-3 pr-12 rounded border border-black transition-all duration-300 outline-none focus:border-white text-black mt-1" :rules="validatePassword" v-model="state.user.password"
            tabindex="2"
            />
            <span @mouseenter="showPassword()" @mouseleave="showPassword()" class="absolute top-2 right-0 cursor-pointer mr-3 text-black hover:text-slate-400 p-1 rounded-full duration-150 m-auto">
              <Icon class="w-auto h-5" name="ic:outline-remove-red-eye" />
            </span>
          </span>
          <ErrorMessage class="text-red-500 text-xs italic font-bold" name="password"/>
        </section>

        <Button tabindex="3" class="bg-[#32414e] mt-5 w-full rounded" label="Login"/>

      </Form>
    </div>
  </div>
</template>









