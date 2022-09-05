
<div id="app" class="container p-5">
	<!-- Modal -->
	<div class="modal fade" id="appModal" tabindex="-1" aria-labelledby="appModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="appModalLabel">Modal title</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<form>
		        <div class="form-floating mb-3">
				  <input type="text" class="form-control" v-model="titulo" placeholder="Titulo">
				  <label for="floatingInput">Titulo</label>
				</div>
				<div class="form-floating">
				  <input type="text" class="form-control" v-model="detalle" placeholder="Detalles">
				  <label for="floatingPassword">Detalles</label>
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button type="submit" @click="apiNewTask" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
	      </div>
	  		</form>
	    </div>
	  </div>
	</div>
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Tack</th>
	      <th scope="col">details</th>
	      <th scope="col">fecha</th>
	      <th class="text-center" scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
	      <th class="text-center" scope="col"><i class="fa-solid fa-trash"></i></th>
	      <th class="text-center" scope="col"><i class="fa-solid fa-circle-check"></i></th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr v-for="(task, index) in tasks" class="alert" v-bind:class="{'alert-success': task.activo===0 }">
	      <th scope="row">{{ index+1 }}</th>
	      <td>
	      	<input type="text" 
	      	:disabled="task.edit === 0" 
	      	v-bind:class="{'form-control-plaintext': task.edit ===0, 'form-control': task.edit===1 }" 
	      	v-model="task.title">
	      </td>
	      <td>
	      	<input type="text" 
	      	:disabled="task.edit === 0" 
	      	v-bind:class="{'form-control-plaintext': task.edit ===0, 'form-control': task.edit===1 }" 
	      	v-model="task.detalle">
	      </td>
	      <td><input type="text" disabled class="form-control-plaintext" v-model="task.fecha"></td>
	      
	      <td class="text-center" scope="row">
	      	<button @click="editTask(task.id, index)" class="btn btn-sm " v-bind:class="{'btn-warning': task.edit===0, 'btn-success': task.edit===1 }">
	      		<i class="fa-solid " v-bind:class="{'fa-pen-to-square': task.edit===0, 'fa-floppy-disk': task.edit===1 }"></i>
	      	</button>
	      </td>
	      <td class="text-center" scope="row">
	      	<button @click="apiDeleteTask(task.id, index)" class="btn btn-sm btn-danger">
	      		<i class="fa-solid fa-trash"></i>
	      	</button>
	      </td>
	      <td class="text-center" scope="row">
	      	<button @click="checkTask(task.id, index)" class="btn btn-sm " v-bind:class="{'btn-info': task.activo===1, 'btn-dark': task.activo===0 }">
	      		<i class="fa-solid " v-bind:class="{'fa-circle-check': task.activo===1, 'fa-rotate-left': task.activo===0 }"></i>
	      	</button>
	      </td>
	    </tr>
	  </tbody>
	</table>
</div>

<script type="text/javascript">
	const app = new Vue({
		el: '#app',
		data:{
			titulo: '',
			detalle: '',
			tasks: [
			<?php foreach ($data as $task):?>
				{id: <?php echo $task['id'];  ?>, title: '<?php echo $task['titulo'];  ?>', detalle: '<?php echo $task['detalle'];  ?>', fecha: '<?php echo $task['fecha'];  ?>', activo: <?php echo $task['activo'];  ?>, edit: 0},
			<?php endforeach; ?>
			],
		},
		methods:{
			apiSetTask (id, titulo, detalle, activo) {
				$.ajax({
					type: "POST",
					mimeType: 'text/html; charset=utf-8',
					method: 'POST',
			        dataType: "json",
			        url: base_url+'Task/setTask',
			        cache: false,
			        data: "id="+id+'&titulo='+titulo+'&detalle='+detalle+'&activo='+activo,
			        success: function(respuesta)
			        {
			        	
			        }
			    });
			},
			apiNewTask () {
				$.ajax({
					type: "POST",
					mimeType: 'text/html; charset=utf-8',
					method: 'POST',
			        dataType: "json",
			        url: base_url+'Task/newTask',
			        cache: false,
			        data: 'titulo='+app.titulo+'&detalle='+app.detalle,
			        success: function(respuesta)
			        {
			        	if (respuesta!=null) {
			        		app.newTask(respuesta);
			        	} 
			        }
			    });
			}, 
			newTask(respuesta){
				this.tasks.push({
					id: respuesta.id,
					title: respuesta.titulo,
					detalle: respuesta.detalle,
					fecha: respuesta.fecha,
					activo: respuesta.activo,
					edit: 0,
				});
			    this.titulo = '';
				this.detalles = '';
				toastr["success"]('Creada exitosamente');
			},

			editTask (id, i) {
				console.log("editTask: "+id);
				if (this.tasks[i].edit===1) this.apiSetTask(this.tasks[i].id, this.tasks[i].title, this.tasks[i].detalle, this.tasks[i].activo);
				this.tasks[i].edit = (this.tasks[i].edit==0) ? 1 : 0;
			},

			deleteTask (i) {
				this.tasks.splice(i, 1)
				toastr['error']('eliminada exitosamente');

			},

			apiDeleteTask (id, i) {
				$.ajax({
					type: "POST",
					mimeType: 'text/html; charset=utf-8',
					method: 'POST',
			        dataType: "json",
			        url: base_url+'Task/removeTask',
			        cache: false,
			        data: "id="+id,
			        success: function(respuesta)
			        {
			        	if(!respuesta) app.deleteTask(i);
			        }
			    });
			},
			checkTask (id, i) {
				console.log("deleteTask: "+i);
				this.tasks[i].activo = (this.tasks[i].activo==0) ? 1 : 0;
				this.apiSetTask(this.tasks[i].id, this.tasks[i].title, this.tasks[i].detalle, this.tasks[i].activo);
			},

		}
	});
</script>

