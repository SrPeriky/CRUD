<div class="container">
	<div id="app" class="row justify-content-md-center p-5">
	      <div class="container">
	         <div class="row">
	            <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
	            	<p v-if="errors.length">
					    <ul>
					      <li v-for="error in errors">{{ error }}</li>
					    </ul>
					  </p>
	               <div v-if="!registerActive" class="card p-5">
	                  <h1>Sign In</h1>
	                  <form class="form-group" id="login">
	                     <input v-model="email" type="email" name="email" class="form-control" placeholder="Email" required>
	                     <input v-model="password" type="password" name="password" class="form-control" placeholder="Password" required>
	                     <input type="submit" class="btn btn-block col-12 btn-primary" @click="doLogin">
	                     <p>Don't have an account? <a href="#" @click="registerActive = !registerActive,  cleanInputs()">Sign up here</a>
	                     </p>
	                  </form>
	               </div>

	               <div v-else class="card p-5">
	                  <h1>Sign Up</h1>
	                  <form class="form-group" id="register">
	                     <input v-model="name" name="name" type="text" class="form-control" placeholder="Name" required>
	                     <input v-model="email" name="email" type="email" class="form-control" placeholder="Email" required>
	                     <input v-model="password" name="password" type="password" class="form-control" placeholder="Password" required>
	                     <input v-model="confirPassword" type="password" class="form-control" placeholder="Confirm Password" required>
	                     <input type="submit" class="btn btn-block col-12 btn-primary" @click="doRegister">
	                     <p>Already have an account? <a href="#" @click="registerActive = !registerActive, cleanInputs()">Sign in here</a>
	                     </p>
	                  </form>
	               </div>
	            </div>
	         </div>
	      </div>
	</div>
</div>
<script type="text/javascript">
const app = new Vue({
  el:'#app',
  data:{
  	registerActive: false,
    errors:[],
    email:'',
    name:'',
    password:'',
    confirPassword:'',
  },
  methods:{
  	cleanInputs () {
  		this.errors = []
  		this.email = '';
  		this.name = '';
  		this.password = '';
  		this.confirPassword = '';
  	}, 
  	validMail: (email) => 
  		(email.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) ? 
  		true : 
  		false,

    checkFormLogin:function(e) {
    	this.errors = [];
    	e.preventDefault();
    	result = true;
    	if(!this.validMail(this.email)) {
    		result = false; this.errors.push("Email is required.");
    	} 
    	if(this.password === '') { result = false; this.errors.push("Password is required.");}
    	return result;
    },

    checkFormdRegister:function(e) {
    	this.errors = [];
    	e.preventDefault();
    	result = true;
    	if(this.name === '') { result = false; this.errors.push("Name is required.");}
    	if(!this.validMail(this.email)){ result = false; this.errors.push("Email is required.");}
    	if(this.password === '') {result = false; this.errors.push("Password is required.");}
    	if(this.password.length < 8) {result = false; this.errors.push("password requires at least 8 characters.");}
    	if(this.password !== this.confirPassword) {result = false; this.errors.push("Passwords do not match.");}
    	return result;
    },

    sedAjax (action, form) {
    	var parametros = new FormData($('#'+form)[0]);
    	$.ajax({
    		mimeType: 'text/html; charset=utf-8',
    		url: base_url+'user/'+action,
    		method: 'POST',
    		async: true,
    		data: parametros,
    		contentType:false,
    		processData:false,
    		dataType: 'json',
    		success: function(respuesta) {
    			if(respuesta===true) location.href = base_url+'home';
    			else app.errors.push(respuesta);
    		},
    		error: function(jqXHR, textStatus, errorThrown) {
    			alert('ERROR');
    			$("#submit").fadeIn();
    		}
    	});
    },

    doLogin (e) {
    	if(this.checkFormLogin(e)){
		    this.sedAjax('checkUser', 'login');
    	}
    },

    doRegister(e){
    	if(this.checkFormdRegister(e)){
		    this.sedAjax('checkIn', 'register');
    	}
    }
  }
})
</script>