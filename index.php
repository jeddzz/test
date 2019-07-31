<?php
require 'bootstrap.php';
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/js/chosen/chosen.min.css" />
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center mb-5">
                <div class="col-5">
				<h3 class="mb-4">Регистрация пользователя</h3>
                    <form id="registration">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" autocomplete="off" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Введите email">
                            <div class="form-control-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder="Введите имя">
                            <div class="form-control-feedback"></div>
                        </div>
						
						<? $Regions = getRegionsList(); ?>	
						<div class="form-group">	
							<label for="region">Область</label>
							<select required data-placeholder="Выберите область" class="chosen-select" id="SelectedRegion">
								<?php if(!empty($Regions)): ?>
										<option class="form-control" value=""></option>
									<?php foreach($Regions as $Region): ?>
										<option class="form-control" value="<?= $Region['ter_id'] ?>"><?= $Region['ter_name'] ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>							
						</div>
                        
						<div class="reslt1" id="SelectedCity"></div>
						<div class="reslt2"></div>
						
						<button type="submit" disabled="disabled" class="btn btn-primary text-center" id="btn-reg">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
			
            <div class="row justify-content-center mb-3">
				<div class="col-8">
					<div class="user_card"></div>
				</div>
			</div>
			
            <div class="row justify-content-center">
                <div class="col-10">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Адрес</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $users = getUsersList();
                            ?>

                            <?php if(!empty($users)): ?>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <th scope="row"><?= $user['id'] ?></th>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['ter_address'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
			
<div class="modal" id="ModalCard">
  <div class="modal-dialog modal-dialog-centered modal-xs">
    <div class="modal-content" style="display: inline-table">

      <div class="modal-body">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
	
        <div class="htl-modal-header">Вы добавили отель в избранное!</div>
		<div class="text-center mb-4">123</div>
		<div class="">123</div>
		
      </div>

    </div>
  </div>
</div>
			
			
        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/js/form.js"></script>
	<script src="assets/js/chosen/chosen.jquery.min.js"></script>
    </body>
</html>
