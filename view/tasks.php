
<div id="app" class="container p-5">
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Tack</th>
	      <th scope="col">details</th>
	      <th scope="col">fecha</th>
	      <th class="text-center" scope="col"><i class="fa-sharp fa-solid fa-eye"></i></th>
	      <th class="text-center" scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
	      <th class="text-center" scope="col"><i class="fa-solid fa-trash"></i></th>
	      <th class="text-center" scope="col"><i class="fa-solid fa-circle-check"></i></th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr v-for="(task, index) in tasks" class="alert" v-bind:class="{'alert-success': task.activo }">
	      <th scope="row">{{ index+1 }}</th>
	      <td> {{task.title}} </td>
	      <td>{{task.detalle}}</td>
	      <td>{{task.fecha}}</td>
	      <td class="text-center" scope="row"><button class="btn btn-sm btn-info"><i class="fa-sharp fa-solid fa-eye"></i></button></td>
	      <td class="text-center" scope="row"><button class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></button></td>
	      <td class="text-center" scope="row"><button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button></td>
	      <td class="text-center" scope="row">
	      	<button class="btn btn-sm " v-bind:class="{'btn-success': !task.activo, 'btn-dark': task.activo }"><i class="fa-solid fa-circle-check"></i></button>
	      </td>
	    </tr>
	  </tbody>
	</table>
</div>
			
				
			

<script type="text/javascript">
	const app = new Vue({
		el: '#app',
		data:{
			tasks: [
			<?php foreach ($data as $task):?>
			{id: <?php echo $task['id'];  ?>, title: '<?php echo $task['titulo'];  ?>', detalle: '<?php echo $task['detalle'];  ?>', fecha: '<?php echo $task['fecha'];  ?>', activo: <?php echo $task['activo'];  ?>},
			<?php endforeach; ?>
			],
		},
		methods:{
			viewTask (id) {
				console.log("viewTask");
			},
			editTask (id) {
				console.log("viewTask");
			},
			deleteTask (id) {
				console.log("viewTask");
			},
			checkTask (id) {
				console.log("viewTask");
			},
		}
	});
</script>

