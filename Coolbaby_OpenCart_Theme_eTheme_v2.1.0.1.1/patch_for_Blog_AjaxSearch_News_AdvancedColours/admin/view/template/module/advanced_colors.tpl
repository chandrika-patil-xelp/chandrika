<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
	<div class="container-fluid">
		<div class="pull-right">
		<button type="submit" form="form-advanced_colors" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
		<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
		<h1><?php echo $heading_title; ?></h1>
		<ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
		</ul>
	</div>
	</div>
	<div class="container-fluid">
	<?php if ($error_warning) { ?>
	<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	<?php } ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
		</div>
		<div class="panel-body">
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-advanced_colors" class="form-horizontal">
			<div class="form-group">
				<h3 style="padding:5px 10px;"><?php echo $text_select_option;?></h3>
				<label class="col-sm-2 control-label"><?php echo $text_select_option; ?></label>
				<div class="col-sm-10">
					<?php if(!$productselectoptions) : ?>
					<select name="option_selected" class="form-control">
						<option value="0">---</option>
					</select>
					<?php else : ?>
					<select name="option_selected" class="form-control">
						<option value="0">---</option>
						<?php foreach($productselectoptions as $productselectoption) :?>
						<option value="<?php echo $productselectoption['option_id'];?>" <?php if(isset($option_selected) and $option_selected==$productselectoption['option_id']) echo 'selected="selected"';?>><?php echo $productselectoption['name']?></option>
						<?php endforeach;?>
					</select>
					<?php endif;?>
				</div>
			</div>	
			<h3 style="padding:5px 10px;"><?php echo $text_list_page;?></h3>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo $text_enable_title; ?></label>
				<div class="col-sm-10">
					<select name="enable_product_list" class="form-control">
						<option value="enable" <?php if($enable_product_list=='enable') echo 'selected="selected"';?>><?php echo $text_enable?></option>
						<option value="disable" <?php if($enable_product_list=='disable') echo 'selected="selected"';?>><?php echo $text_disable?></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo $text_icon_swatch_width; ?></label>
				<div class="col-sm-10">
					<input class="form-control" type="text" name="icon_swatch_width_product_list" value="<?php echo $icon_swatch_width_product_list; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo $text_icon_swatch_height; ?></label>
				<div class="col-sm-10">
					<input class="form-control" type="text" name="icon_swatch_height_product_list" value="<?php echo $icon_swatch_height_product_list; ?>" />
				</div>
			</div>
			<h3 style="padding:5px 10px;"><?php echo $text_product_page;?></h3>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo $text_enable_title; ?></label>
				<div class="col-sm-10">
					<select name="enable_product_page" class="form-control">
						<option value="enable" <?php if($enable_product_page=='enable') echo 'selected="selected"';?>><?php echo $text_enable?></option>
						<option value="disable" <?php if($enable_product_page=='disable') echo 'selected="selected"';?>><?php echo $text_disable?></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo $text_icon_swatch_width; ?></label>
				<div class="col-sm-10">
					<input class="form-control" type="text" name="icon_swatch_width_product_page" value="<?php echo $icon_swatch_width_product_page; ?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo $text_icon_swatch_height; ?></label>
				<div class="col-sm-10">
					<input class="form-control" type="text" name="icon_swatch_height_product_page" value="<?php echo $icon_swatch_height_product_page; ?>" />
				</div>
			</div>
			</form>
		</div>
	</div>
	</div>
</div>
<?php echo $footer; ?>