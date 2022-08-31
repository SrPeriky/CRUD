<div class="container">
	<div id="login" class="row justify-content-md-center p-5">
	      <div class="container">
	         <div class="row">
	            <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
	               <div v-if="!registerActive" class="card p-5">
	                  <h1>Sign In</h1>
	                  <form class="form-group">
	                     <input v-model="emailLogin" type="email" class="form-control" placeholder="Email" required>
	                     <input v-model="passwordLogin" type="password" class="form-control" placeholder="Password" required>
	                     <input type="submit" class="btn btn-primary" @click="doLogin">
	                     <p>Don't have an account? <a href="#" @click="registerActive = !registerActive, emptyFields = false">Sign up here</a>
	                     </p>
	                     <p><a href="#">Forgot your password?</a></p>
	                  </form>
	               </div>

	               <div v-else class="card p-5">
	                  <h1>Sign Up</h1>
	                  <form class="form-group">
	                     <input v-model="emailReg" type="email" class="form-control" placeholder="Email" required>
	                     <input v-model="passwordReg" type="password" class="form-control" placeholder="Password" required>
	                     <input v-model="confirmReg" type="password" class="form-control" placeholder="Confirm Password" required>
	                     <input type="submit" class="btn btn-primary" @click="doRegister">
	                     <p>Already have an account? <a href="#" @click="registerActive = !registerActive, emptyFields = false">Sign in here</a>
	                     </p>
	                  </form>
	               </div>
	            </div>
	         </div>
	      </div>
	</div>
</div>
<script type="text/javascript">
	new Vue({
	   el: "#login",
	   
	   data: {
	      registerActive: false,
	      emailLogin: "",
	      passwordLogin: "",
	      emailReg: "",
	      passwordReg: "",
	      confirmReg: "",
	      emptyFields: false
	   },
	   
	   methods: {
	      doLogin() {
	         if (this.emailLogin === "" || this.passwordLogin === "") {
	            this.emptyFields = true;
	         } else {
	            alert("You are now logged in");
	         }
	      },
	      
	      doRegister() {
	         if (this.emailReg === "" || this.passwordReg === "" || this.confirmReg === "") {
	            this.emptyFields = true;
	         } else {
	            alert("You are now registered");
	         }
	      }
	   }
	});
</script>