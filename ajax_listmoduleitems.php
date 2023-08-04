<?php  include_once("config.php");

if(isset($_GET['scrn']) && !empty($_GET['scrn'])){
	$listmodulename = $_GET['scrn'];
	
?>
		<label class="strong">Existing Module Item</label>
		<input type="hidden" name="hlistmoduleitem"  id="hlistmoduleitem"   value="<?php echo $listmoduleitem; ?>"  />
		<?php 
	
		$sqlmodlfelds = "select * 
						from rptusrfields
						where table_name = '".$listmodulename."'" ;   
		//echo 	$sqlmodlfelds;
		$resmodlfelds = mysqli_query($dbcon, $sqlmodlfelds);
		?>
		<select  name="listmoduleitem"  id="listmoduleitem" class="form-control" >
			<option value="">--Select--</option>
			<?php while($rowmodlfelds = mysqli_fetch_assoc($resmodlfelds)){ ?>
				<option value="<?php echo $rowmodlfelds['field_name']; ?>" <?php if($listmoduleitem == $rowmodlfelds['field_name']){ ?> SELECTED <?php } ?> ><?php echo $rowmodlfelds['field_descr']; ?></option>
			<?php } ?>
		</select>

<?php } ?>
