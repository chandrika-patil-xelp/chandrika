<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-footer_info" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-footer_info" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="account_facebook">Facebook account:</label>
                <div class="col-sm-10">
                    <input type="text" name="module_description[account_facebook]" placeholder="Enter account" id="account_facebook" value="<?php echo isset($module_description['account_facebook']) ? $module_description['account_facebook'] : ''; ?>" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="account_twitter">Twitter account:</label>
                <div class="col-sm-10">
                    <input type="text" name="module_description[account_twitter]" placeholder="Enter account" id="account_twitter" value="<?php echo isset($module_description['account_twitter']) ? $module_description['account_twitter'] : ''; ?>" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="account_twitter">Sort order:</label>
                <div class="col-sm-2">
                    <div>"Facebook" widget</div>
                    <div>
                        <input type="text" name="module_description[sort_order_facebook]" placeholder="Sort order" id="sort_order_facebook" value="<?php echo isset($module_description['sort_order_facebook']) ? $module_description['sort_order_facebook'] : 1; ?>" class="form-control" />
                    </div>
                </div>

                <div class="col-sm-2">
                    <div>"Twitter" widget</div>
                    <div>
                        <input type="text" name="module_description[sort_order_twitter]" placeholder="Sort order" id="sort_order_twitter" value="<?php echo isset($module_description['sort_order_twitter']) ? $module_description['sort_order_twitter'] : 2; ?>" class="form-control" />
                    </div>
                </div>
                <div class="col-sm-2">
                    <div>"About Us" widget</div>
                    <div>
                        <input type="text" name="module_description[sort_order_about]" placeholder="Sort order" id="sort_order_about" value="<?php echo isset($module_description['sort_order_about']) ? $module_description['sort_order_about'] : 3; ?>" class="form-control" />
                    </div>
                </div>
                <div class="col-sm-2">
                    <div>"Testimonials" widget</div>
                    <div>
                        <input type="text" name="module_description[sort_order_testimonials]" placeholder="Sort order" id="sort_order_testimonials" value="<?php echo isset($module_description['sort_order_testimonials']) ? $module_description['sort_order_testimonials'] : 4; ?>" class="form-control" />
                    </div>
                </div>

            </div>


            <div class="tab-pane">
            <ul class="nav nav-tabs" id="language">
              <?php foreach ($languages as $language) { ?>
              <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <?php foreach ($languages as $language) { ?>
              <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-heading_facebook<?php echo $language['language_id']; ?>"><?php echo $heading_facebook; ?></label>
                      <div class="col-sm-10">
                        <input type="text" name="module_description[<?php echo $language['language_id']; ?>][heading_facebook]" placeholder="<?php echo $heading_facebook; ?>" id="input-heading_facebook<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[$language['language_id']]['heading_facebook']) ? $module_description[$language['language_id']]['heading_facebook'] : ''; ?>" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-heading_twitter<?php echo $language['language_id']; ?>"><?php echo $heading_twitter; ?></label>
                      <div class="col-sm-10">
                          <input type="text" name="module_description[<?php echo $language['language_id']; ?>][heading_twitter]" placeholder="<?php echo $heading_twitter; ?>" id="input-heading_twitter<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[$language['language_id']]['heading_twitter']) ? $module_description[$language['language_id']]['heading_twitter'] : ''; ?>" class="form-control" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-heading_about<?php echo $language['language_id']; ?>"><?php echo $heading_about; ?></label>
                      <div class="col-sm-10">
                          <input type="text" name="module_description[<?php echo $language['language_id']; ?>][heading_about]" placeholder="<?php echo $heading_about; ?>" id="input-heading_about<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[$language['language_id']]['heading_about']) ? $module_description[$language['language_id']]['heading_about'] : ''; ?>" class="form-control" />
                      </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-description_about<?php echo $language['language_id']; ?>"><?php echo $description_about; ?></label>
                  <div class="col-sm-10">
                    <textarea name="module_description[<?php echo $language['language_id']; ?>][description_about]" placeholder="<?php echo $description_about; ?>" id="input-description_about<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($module_description[$language['language_id']]['description_about']) ? $module_description[$language['language_id']]['description_about'] : ''; ?></textarea>
                  </div>
                </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-heading_contact<?php echo $language['language_id']; ?>"><?php echo $heading_contact; ?></label>
                      <div class="col-sm-10">
                          <input type="text" name="module_description[<?php echo $language['language_id']; ?>][heading_contact]" placeholder="<?php echo $heading_contact; ?>" id="input-heading_contact<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[$language['language_id']]['heading_contact']) ? $module_description[$language['language_id']]['heading_contact'] : ''; ?>" class="form-control" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-description_contact<?php echo $language['language_id']; ?>"><?php echo $description_contact; ?></label>
                      <div class="col-sm-10">
                          <textarea name="module_description[<?php echo $language['language_id']; ?>][description_contact]" placeholder="<?php echo $description_contact; ?>" id="input-description_contact<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($module_description[$language['language_id']]['description_contact']) ? $module_description[$language['language_id']]['description_contact'] : ''; ?></textarea>
                      </div>
                  </div>


              </div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-description_about<?php echo $language['language_id']; ?>').summernote({height: 300});
      $('#input-description_contact<?php echo $language['language_id']; ?>').summernote({height: 300});
  <?php } ?>
//--></script> 
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>
<?php echo $footer; ?>