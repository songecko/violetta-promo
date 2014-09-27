<div id="instructions" class="panel panel-info">
	<div class="panel-heading">Instrucciones de uso</div>
	<ul class="list-group">
	  <li class="list-group-item">Paso 1: Convierte el video haciendo click en este icono <span class="glyphicon glyphicon-compressed"></span>.</li>
	  <li class="list-group-item">Paso 2: Hacer un refresh de la página CMS.</li>
	  <li class="list-group-item">Paso 3: Haz preview del video haciendo click en el icono <span class="glyphicon glyphicon-facetime-video"></span>.</li>
	  <li class="list-group-item">Paso 4: Habilitar los videos que se quiera hacer público usando los íconos de <span class="label label-danger">No</span> o <span class="label label-success">Sí</span>.</li>
	</ul>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Registros</div>
	<table class="table table-condensed table-bordered table-hover">
		<tr>
			<th>#</th>
			<th>Facebook ID</th> 
			<th>Nombre</th>
			<th>Email</th>
			<th>Teléfono</th>
			<th>Tiene DIRECTV?</th>
			<th>Cuenta DIRECTV</th>
			<th>Imagen Video</th>
			<th>Video habilitado?</th>
			<th></th>
		</tr>
		<?php $i = 0; ?>
		<?php foreach ($users as $user): $i++; ?>
		<?php 
			$fileBasename = pathinfo($user['video_file_name'], PATHINFO_FILENAME);
			$fileExtension = pathinfo($user['video_file_name'], PATHINFO_EXTENSION);
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $user["fbid"] ?></td>
			<td><?php echo $user["full_name"] ?></td>
			<td><?php echo $user["email"] ?></td>
			<td><?php echo $user["phone"] ?></td>
			<td>
				<?php if($user["has_dtv"] == 1): ?>
				<span class="label label-success">Sí</span>
				<?php else: ?>
				<span class="label label-danger">No</span>
				<?php endif; ?>
			</td>
			<td><?php echo $user["dtv_account_number"] ?></td>
			<td>
				<?php $imageThumb = $view['assets']->getUrl('uploads/'.$fileBasename.'.jpg') ?>
				<img src="<?php echo $imageThumb ?>" height="74">
			</td>
			<td>
				<a href="<?php echo $view['router']->generate('backend_user_toggle_enabled', array('id' => $user['id'])) ?>">
					<?php if($user["enabled"] == 1): ?>
					<span class="label label-success">Sí</span>
					<?php else: ?>
					<span class="label label-danger">No</span>
					<?php endif; ?>
				</a>
			</td>
			<td class="actions">
				<a href="#" class="showVideo"
					data-video-src="<?php echo $view['assets']->getUrl('uploads/'.$user['video_file_name']) ?>" data-audio-src="<?php echo $user['audio_file_name']?$view['assets']->getUrl('uploads/'.$user['audio_file_name']):'' ?>"
					title="Ver video"
				>
					<span class="glyphicon glyphicon-facetime-video"></span>
				</a>
				<a href="<?php echo $view['router']->generate('backend_user_video_convert', array('id' => $user['id'])) ?>" class="convertVideo"
					title="Convertir video"
				>
					<span class="glyphicon glyphicon-compressed"></span>
				</a>
				<a href="<?php echo $view['router']->generate('backend_user_video_convert', array('id' => $user['id'])) ?>" class="rotateVideo"
					title="Rotar video 180*"
				>
					<span class="glyphicon glyphicon-refresh"></span>
				</a>
				<!-- <a href="<?php echo $view['router']->generate('backend_user_video_convert', array('id' => $user['id'])) ?>" class="rotateHardVideo"
					title="Rotar video 180* mobile"
				>
					<span class="glyphicon glyphicon-refresh"></span>
				</a> -->
				<a class="remove" href="<?php echo $view['router']->generate('backend_user_remove', array('id' => $user['id'])) ?>" 
					onclick="return confirm('Estas seguro?')">
					<span class="glyphicon glyphicon-remove"></span>
				</a>
			</td>
		</tr>
		<?php endforeach;  ?>  		 
	</table>      
</div>

<div class="modal fade videoModal" id="showUserVideoModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<div class="content">			
					<div class="recordReview">
						<button class="playButton"><img src="<?php echo $view['assets']->getUrl('images/playButton.png') ?>"></button>
						<video id="recordReviewVideo" width="640" height="480" controls></video>
						<audio id="recordReviewAudio"></audio>
					</div>
				</div>
      		</div>
    	</div>
  	</div>
</div>