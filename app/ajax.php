<?php
require 'db.php';
	if (isset($_POST['typePost']) && $_POST['typePost'] == 'city'):
		
		# Получаем список городов и районов области
		$ter_pid = $_POST['ter_pid'];
		$query = "select * from t_koatuu_tree where ter_pid = $ter_pid and ter_level = 2";
		$db = get_connection();
		$res = $db->query($query,PDO::FETCH_ASSOC); ?>
		
			<div class="form-group">	
				<label for="region">Район</label>
				<select data-placeholder="Сделайте выбор" class="chosen-select" id="SelectedDistrict" name="territory">
					<?php if(!empty($res)): ?>
							<option class="form-control" value=""></option>
						<?php foreach($res as $item): ?>
							 <option class="form-control" value="<?= $item['ter_id'] ?>"><?= $item['ter_name'] ?></option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>							
			</div>
	<?php endif; ?>
	
	
	<?php if (isset($_POST['typePost']) && $_POST['typePost'] == 'city2'):
		
		# Получаем список городов и районов области
		$ter_pid = $_POST['ter_pid'];
		$query = "select * from t_koatuu_tree where `ter_pid` = $ter_pid and ter_level > 2
		UNION 
		SELECT * from t_koatuu_tree WHERE `ter_id` = $ter_pid AND ter_type_id <> 2 ORDER BY ter_id";
		$db = get_connection();
		$res = $db->query($query,PDO::FETCH_ASSOC);
		$countResult = $res->rowCount(); echo $count;?>
			<?if($countResult >= 1):?>
			<div class="form-group">	
				<select data-placeholder="Сделайте выбор" class="chosen-select" id="SelectedLocality" name="territory">
				<option class="form-control" value=""></option>
					<?php foreach($res as $item): ?>
						 <option class="form-control" value="<?= $item['ter_id'] ?>"><?= $item['ter_name'] ?></option>
					<?php endforeach; ?>
				</select>							
			</div>	
			<?endif;?>
	<?php endif; ?>	