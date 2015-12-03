<ul class="nav nav-tabs main_tabs">
    <li class="active"><a href="#tab-general<?php echo $store['store_id']; ?>" data-toggle="tab">Layout</a></li>
    <li><a href="#tab-colors<?php echo $store['store_id']; ?>" data-toggle="tab">Colors / backgrounds / fonts</a></li>
    <li><a href="#tab-products<?php echo $store['store_id']; ?>" data-toggle="tab">Products / Listings</a></li>
</ul>
<div class="tab-content">
    <!-------------------------------------tab General---------------------------------->
    <div class="tab-pane active" id="tab-general<?php echo $store['store_id']; ?>">
        <ul class="nav nav-tabs col-sm-3 main_tabs_vertical">
            <li class="active"><a href="#tab-general-layout1-<?php echo $store['store_id']; ?>" class="selected" data-toggle="tab">General</a></li>
            <li><a href="#tab-general-layout2-<?php echo $store['store_id']; ?>" data-toggle="tab">Header/Footer Blocks</a></li>
            <li><a href="#tab-general-layout4-<?php echo $store['store_id']; ?>" data-toggle="tab">Product Modules on Main Page</a></li>
            <li><a href="#tab-general-layout5-<?php echo $store['store_id']; ?>" data-toggle="tab">Some language variables</a></li>

        </ul>

        <div class="tab-content col-sm-8">
            <!--general-->
            <div class="tab-pane active" id="tab-general-layout1-<?php echo $store['store_id']; ?>">
            <div class="form-group">
                <label class="col-sm-5 control-label">
                    <span data-toggle="tooltip" title="Enable/Disable preloader block.">Preloader</span>
                </label>
                <div class="col-sm-7">
                    <label class="radio-inline">
                        <?php if (isset($customisation_general_store["preloader"][$store['store_id']]) && $customisation_general_store["preloader"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_general_store[preloader][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_general_store[preloader][<?php echo $store["store_id"]; ?>]" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (isset($customisation_general_store["preloader"][$store['store_id']]) && !$customisation_general_store["preloader"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_general_store[preloader][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_general_store[preloader][<?php echo $store["store_id"]; ?>]" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                    </label>
                </div>
            </div>


            <div class="form-group">
                    <label class="col-sm-5 control-label" for="input-homepage_mode<?php echo $store["store_id"]; ?>">
                        <span data-toggle="tooltip" title="If you choose 'Boxed Home page'
                        <br>Enable second block (boxed slider) in Top Slider module!">Home page width</span>
                    </label>
                    <div class="col-sm-7">
                        <select name="customisation_general_store[homepage_mode][<?php echo $store["store_id"]; ?>]" id="input-homepage_mode<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if (isset($customisation_general_store["homepage_mode"][$store['store_id']]) && $customisation_general_store['homepage_mode'][$store['store_id']] == 'full') : ?> selected="selected" <?php endif; ?> value="full">Full-width Home page</option>
                            <option <?php if (isset($customisation_general_store["homepage_mode"][$store['store_id']]) && $customisation_general_store['homepage_mode'][$store['store_id']] == 'boxed') : ?> selected="selected" <?php endif; ?> value="boxed">Boxed Home page</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-5 control-label">
                        <span data-toggle="tooltip" title="Use any type of images.">Images for arrow and mouse in button "Back to top"</span>
                    </label>
                    <div class="col-sm-7">
                            <div>
                                <span>Upload arrow image in path: image/catalog/ and write here only name, for example: icon-scroll-arrow.png</span><br>
                                <input type="text" name="customisation_general_store[back_top_arrow][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['back_top_arrow'][$store['store_id']]) ? $customisation_general_store['back_top_arrow'][$store['store_id']] : ''); ?>" placeholder="Image for arrow" id="back_top_arrow<?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                        <div>
                            <br>
                            <span>Upload mouse image in path: image/catalog/ and write here only name, for example: icon-scroll-mouse.png</span><br>
                            <input type="text" name="customisation_general_store[back_top_mouse][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['back_top_mouse'][$store['store_id']]) ? $customisation_general_store['back_top_mouse'][$store['store_id']] : ''); ?>" placeholder="'Image for mouse" id="back_top_mouse<?php echo $store["store_id"]; ?>" class="form-control" />
                        </div>
                        <div>
                            <br>
                            <div>Display or not button "Back to top"</div>
                            <label class="radio-inline">
                                <?php if (isset($customisation_general_store["back_top_status"][$store['store_id']]) && $customisation_general_store["back_top_status"][$store['store_id']]) { ?>
                                <input type="radio" name="customisation_general_store[back_top_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                                <?php echo $text_yes; ?>
                                <?php } else { ?>
                                <input type="radio" name="customisation_general_store[back_top_status][<?php echo $store["store_id"]; ?>]" value="1" />
                                <?php echo $text_yes; ?>
                                <?php } ?>
                            </label>
                            <label class="radio-inline">
                                <?php if (isset($customisation_general_store["back_top_status"][$store['store_id']]) && !$customisation_general_store["back_top_status"][$store['store_id']]) { ?>
                                <input type="radio" name="customisation_general_store[back_top_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                                <?php echo $text_no; ?>
                                <?php } else { ?>
                                <input type="radio" name="customisation_general_store[back_top_status][<?php echo $store["store_id"]; ?>]" value="0" />
                                <?php echo $text_no; ?>
                                <?php } ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">
                        <span data-toggle="tooltip" title="Enable/disable Search Block">Search Block</span>
                    </label>
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["search_block"][$store['store_id']]) && $customisation_general_store["search_block"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[search_block][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                            <?php echo $text_yes; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[search_block][<?php echo $store["store_id"]; ?>]" value="1" />
                            <?php echo $text_yes; ?>
                            <?php } ?>
                        </label>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["search_block"][$store['store_id']]) && !$customisation_general_store["search_block"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[search_block][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                            <?php echo $text_no; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[search_block][<?php echo $store["store_id"]; ?>]" value="0" />
                            <?php echo $text_no; ?>
                            <?php } ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">
                        <span data-toggle="tooltip" title="Enable/disable Right Shopping cart button">Shopping cart button</span>
                    </label>
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["cart_button"][$store['store_id']]) && $customisation_general_store["cart_button"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[cart_button][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                            <?php echo $text_yes; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[cart_button][<?php echo $store["store_id"]; ?>]" value="1" />
                            <?php echo $text_yes; ?>
                            <?php } ?>
                        </label>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["cart_button"][$store['store_id']]) && !$customisation_general_store["cart_button"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[cart_button][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                            <?php echo $text_no; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[cart_button][<?php echo $store["store_id"]; ?>]" value="0" />
                            <?php echo $text_no; ?>
                            <?php } ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">
                        <span data-toggle="tooltip" title="Enable/disable Header Button with service links">Header Button with service links</span>
                    </label>
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["header_service_buttons"][$store['store_id']]) && $customisation_general_store["header_service_buttons"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[header_service_buttons][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                            <?php echo $text_yes; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[header_service_buttons][<?php echo $store["store_id"]; ?>]" value="1" />
                            <?php echo $text_yes; ?>
                            <?php } ?>
                        </label>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["header_service_buttons"][$store['store_id']]) && !$customisation_general_store["header_service_buttons"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[header_service_buttons][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                            <?php echo $text_no; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[header_service_buttons][<?php echo $store["store_id"]; ?>]" value="0" />
                            <?php echo $text_no; ?>
                            <?php } ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">
                        <span data-toggle="tooltip" title="Enable/disable Footer Popup info block">Footer Popup info block</span>
                    </label>
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["footerpopup"][$store['store_id']]) && $customisation_general_store["footerpopup"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[footerpopup][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                            <?php echo $text_yes; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[footerpopup][<?php echo $store["store_id"]; ?>]" value="1" />
                            <?php echo $text_yes; ?>
                            <?php } ?>
                        </label>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["footerpopup"][$store['store_id']]) && !$customisation_general_store["footerpopup"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[footerpopup][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                            <?php echo $text_no; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[footerpopup][<?php echo $store["store_id"]; ?>]" value="0" />
                            <?php echo $text_no; ?>
                            <?php } ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">
                        <span data-toggle="tooltip" title="Enable/disable custom.css file. <br>(Originally it is named 'custom_example.css' and located in catalog/view/theme/coolbaby/stylesheet/custom_example.css)">Using custom.css file</span>
                    </label>
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["css_file"][$store['store_id']]) && $customisation_general_store["css_file"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[css_file][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                            <?php echo $text_yes; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[css_file][<?php echo $store["store_id"]; ?>]" value="1" />
                            <?php echo $text_yes; ?>
                            <?php } ?>
                        </label>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["css_file"][$store['store_id']]) && !$customisation_general_store["css_file"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[css_file][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                            <?php echo $text_no; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[css_file][<?php echo $store["store_id"]; ?>]" value="0" />
                            <?php echo $text_no; ?>
                            <?php } ?>
                        </label>
                    </div>
                </div>

            </div>
            <!--general-->

            <!--Header/Footer Blocks-->
            <div id="tab-general-layout2-<?php echo $store['store_id']; ?>" class="tab-pane">
            <fieldset>
                <legend>Header (Top Spy Panel/blocks)</legend>

                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span data-toggle="tooltip" title="Here you can enable / disable phone number in top.">Phone number</span>
                    </label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store['phone_number'][$store['store_id']]) && $customisation_general_store["phone_number"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[phone_number][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                            <?php echo $text_yes; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[phone_number][<?php echo $store["store_id"]; ?>]" value="1" />
                            <?php echo $text_yes; ?>
                            <?php } ?>
                        </label>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store['phone_number'][$store['store_id']]) && !$customisation_general_store["phone_number"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[phone_number][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                            <?php echo $text_no; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[phone_number][<?php echo $store["store_id"]; ?>]" value="0" />
                            <?php echo $text_no; ?>
                            <?php } ?>
                        </label>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-sm-4 control-label">
                          <span data-toggle="tooltip" title="Set Default welcome message near Logo in Header.">
                               Default welcome message:
                          </span>
                    </label>
                    <div class="col-sm-8">
                        <ul class="nav nav-tabs" id="language-welcome_message<?php echo $store["store_id"]; ?>">
                            <?php foreach ($languages as $language) : ?>
                            <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-welcome_message<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($languages as $language) : ?>
                            <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-welcome_message<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                                <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][welcome_message][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store[$language['language_id']]['welcome_message'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['welcome_message'][$store['store_id']] : ''); ?>" placeholder="Default welcome message" class="form-control" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="header_type<?php echo $store["store_id"]; ?>">
                         <span data-toggle="tooltip" title=" - type 1: left welcome message, centered logo<br>
                                                            - type 2: left logo, centered welcome message">
                                                                Type of Header
                         </span>
                    </label>
                    <div class="col-sm-8">
                        <select name="customisation_general_store[header_type][<?php echo $store["store_id"]; ?>]" id="header_type<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if (isset($customisation_general_store['header_type'][$store['store_id']]) && $customisation_general_store['header_type'][$store['store_id']]  == 1) : ?> selected="selected" <?php endif; ?> value="1">Type 1</option>
                            <option <?php if (isset($customisation_general_store['header_type'][$store['store_id']]) && $customisation_general_store['header_type'][$store['store_id']]  == 2) : ?> selected="selected" <?php endif; ?> value="2">Type 2</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="service_buttons_type<?php echo $store["store_id"]; ?>">
                     <span data-toggle="tooltip" title=" - type 1: hidden titles<br>
                                                            - type 2: visible titles">
                                                                Type of Service buttons
                     </span>
                    </label>
                    <div class="col-sm-8">
                        <select name="customisation_general_store[service_buttons_type][<?php echo $store["store_id"]; ?>]" id="service_buttons_type<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if (isset($customisation_general_store['service_buttons_type'][$store['store_id']]) && $customisation_general_store['service_buttons_type'][$store['store_id']] == 1) : ?> selected="selected" <?php endif; ?> value="1">Hidden</option>
                            <option <?php if (isset($customisation_general_store['service_buttons_type'][$store['store_id']]) && $customisation_general_store['service_buttons_type'][$store['store_id']] == 2) : ?> selected="selected" <?php endif; ?> value="2">Visible</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-4 control-label" for="top_menu_type<?php echo $store["store_id"]; ?>">
                     <span data-toggle="tooltip" title=" - type 1: advanced items<br>
                                                            - type 2: simple menu">
                                                                Type of items in Top menu accept categories items
                     </span>
                    </label>
                    <div class="col-sm-8">
                        <select name="customisation_general_store[top_menu_type][<?php echo $store["store_id"]; ?>]" id="top_menu_type<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if (isset($customisation_general_store['top_menu_type'][$store['store_id']]) && $customisation_general_store['top_menu_type'][$store['store_id']] == 1) : ?> selected="selected" <?php endif; ?> value="1">Advanced</option>
                            <option <?php if (isset($customisation_general_store['top_menu_type'][$store['store_id']]) && $customisation_general_store['top_menu_type'][$store['store_id']] == 2) : ?> selected="selected" <?php endif; ?> value="2">Simple</option>
                        </select>
                    </div>
                </div>


            </fieldset>
            <fieldset>
            <legend>Header (Top Menu)</legend>

            <div class="form-group">
                <label class="col-sm-4 control-label">
                    <span data-toggle="tooltip" title="Here you can enable / disable divider between columns with subcategories.">Divider</span>
                </label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <?php if (isset($customisation_general_store['category_divider'][$store['store_id']]) && $customisation_general_store["category_divider"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_general_store[category_divider][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_general_store[category_divider][<?php echo $store["store_id"]; ?>]" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (isset($customisation_general_store['category_divider'][$store['store_id']]) && !$customisation_general_store["category_divider"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_general_store[category_divider][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_general_store[category_divider][<?php echo $store["store_id"]; ?>]" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="input-name-customitem_item_title1<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">
                    <span data-toggle="tooltip" title="Set menu item title.">
                        Custom menu item - title:
                    </span>
                </label>
                <div class="col-sm-8">
                    <ul class="nav nav-tabs" id="language-customitem_item_title1">
                        <?php foreach ($languages as $language) : ?>
                        <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-customitem_item_title1<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach ($languages as $language) : ?>
                        <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-customitem_item_title1<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                            <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][customitem_item_title1][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['customitem_item_title1'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['customitem_item_title1'][$store['store_id']] : ''; ?>" placeholder="Custom menu item - title:" id="input-name-customitem_item_title1<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="customitem_item_url<?php echo $store["store_id"]; ?>">
                     <span data-toggle="tooltip" title="Set url for custom menu item (use full url format starting with http:// for outer links).">
                         Custom menu item - url:
                     </span>
                </label>
                <div class="col-sm-8">
                    <input type="text" name="customisation_general_store[customitem_item_url1][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['customitem_item_url1'][$store['store_id']]) ? $customisation_general_store['customitem_item_url1'][$store['store_id']] : ''); ?>" placeholder="Custom menu item - url" id="customitem_item_url<?php echo $store["store_id"]; ?>" class="form-control" />
                </div>
            </div>
            <!--blog-->
            <div class="form-group">
                <label class="col-sm-4 control-label">Link Blog in top menu - status:</label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <?php if (isset($customisation_general_store["blog_link_status"][$store['store_id']]) && $customisation_general_store["blog_link_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_general_store[blog_link_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_general_store[blog_link_status][<?php echo $store["store_id"]; ?>]" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (isset($customisation_general_store["blog_link_status"][$store['store_id']]) && !$customisation_general_store["blog_link_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_general_store[blog_link_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_general_store[blog_link_status][<?php echo $store["store_id"]; ?>]" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="blog_link_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">
                     <span data-toggle="tooltip" title="Set menu item title.">
                          Set Link Blog title.
                     </span>
                </label>
                <div class="col-sm-8">
                    <ul class="nav nav-tabs" id="language-blog_link_title">
                        <?php foreach ($languages as $language) : ?>
                        <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-blog_link_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach ($languages as $language) : ?>
                        <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-blog_link_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                            <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][blog_link_title][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['blog_link_title'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['blog_link_title'][$store['store_id']] : ''; ?>" placeholder="Set Link Blog title" id="blog_link_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="blog_link_url<?php echo $store["store_id"]; ?>">Link Blog in top menu - url:</label>
                <div class="col-sm-8">
                    <input type="text" name="customisation_general_store[blog_link_url][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['blog_link_url'][$store['store_id']]) ? $customisation_general_store['blog_link_url'][$store['store_id']] : ''); ?>" placeholder="Link Blog in top menu - url" id="blog_link_url<?php echo $store["store_id"]; ?>" class="form-control" />
                </div>
            </div>
            <!--blog-->
            <!--link pages-->
            <div class="form-group">
                <label class="col-sm-4 control-label" for="pages_link_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">
                    Link Pages in top menu - title:
                </label>
                <div class="col-sm-8">
                    <ul class="nav nav-tabs" id="language-pages_link_title">
                        <?php foreach ($languages as $language) : ?>
                        <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-pages_link_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach ($languages as $language) : ?>
                        <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-pages_link_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                            <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][pages_link_title][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['pages_link_title'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['pages_link_title'][$store['store_id']] : ''; ?>" placeholder="Custom menu item - title:" id="pages_link_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="pages_link_url<?php echo $store["store_id"]; ?>">
                     <span data-toggle="tooltip" title="Set url for link pages item, for example, 'index.php?route=information/contact'  (use full url format starting with // for outer links).">
                          Link Pages in top menu - url:
                     </span>
                </label>
                <div class="col-sm-8">
                    <input type="text" name="customisation_general_store[pages_link_url][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['pages_link_url'][$store['store_id']]) ? $customisation_general_store['pages_link_url'][$store['store_id']] : ''); ?>" placeholder="Link Pages in top menu - url:" id="pages_link_url<?php echo $store["store_id"]; ?>" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">
                    <span data-toggle="tooltip" title="Here you can enable / disable this link in top menu.">Link Pages in top menu :</span>
                </label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <?php if (isset($customisation_general_store["pages_status"][$store['store_id']]) && $customisation_general_store["pages_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_general_store[pages_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_general_store[pages_status][<?php echo $store["store_id"]; ?>]" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (isset($customisation_general_store["pages_status"][$store['store_id']]) && !$customisation_general_store["pages_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_general_store[pages_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_general_store[pages_status][<?php echo $store["store_id"]; ?>]" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">
                    <span data-toggle="tooltip" title="Here you can enable / disable this link in top menu.">Link Contact in top menu display:</span>
                </label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <?php if (isset($customisation_general_store["contact_map_status"][$store['store_id']]) && $customisation_general_store["contact_map_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_general_store[contact_map_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_general_store[contact_map_status][<?php echo $store["store_id"]; ?>]" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (isset($customisation_general_store["contact_map_status"][$store['store_id']]) && !$customisation_general_store["contact_map_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_general_store[contact_map_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_general_store[contact_map_status][<?php echo $store["store_id"]; ?>]" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="contact_map_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">
                    Link Contact in top menu - title:
                </label>
                <div class="col-sm-8">
                    <ul class="nav nav-tabs" id="language-contact_map_title">
                        <?php foreach ($languages as $language) : ?>
                        <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-contact_map_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach ($languages as $language) : ?>
                        <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-contact_map_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                            <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][contact_map_title][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['contact_map_title'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['contact_map_title'][$store['store_id']] : ''; ?>" placeholder="Custom menu item - title:" id="contact_map_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!--pages-->
            <div>
                <div class="form-group"><h4>Links in item "PAGES" in Top Menu</h4></div>
                <?php if (isset($information_pages)) : ?>
                <?php foreach ($information_pages as $information_page) : ?>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="additional_page_status<?php echo $information_page['information_id']; ?><?php echo $store["store_id"]; ?>">Link: <?php echo $information_page['title']; ?></label>
                        <div class="col-sm-8">
                            <input type="hidden" name="customisation_general_store[additional_page_id][<?php echo $information_page['information_id']; ?>]" value="<?php echo $information_page['information_id']; ?>">

                            <select name="customisation_general_store[additional_page_status][<?php echo $information_page['information_id']; ?>][<?php echo $store["store_id"]; ?>]" id="additional_page_status<?php echo $information_page['information_id']; ?><?php echo $store["store_id"]; ?>" class="form-control">
                                <option <?php if ($customisation_general_store['additional_page_status'][$information_page['information_id']][$store['store_id']] == '1') : ?> selected="selected" <?php endif; ?> value="1">Enable</option>
                                <option <?php if ($customisation_general_store['additional_page_status'][$information_page['information_id']][$store['store_id']] == '0') : ?> selected="selected" <?php endif; ?> value="0">Disable</option>
                            </select>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="additional_page_checkout_status<?php echo $store["store_id"]; ?>">Link: Checkout</label>
                    <div class="col-sm-8">
                        <select name="customisation_general_store[additional_page_checkout_status][<?php echo $store["store_id"]; ?>]" id="additional_page_checkout_status<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if ($customisation_general_store['additional_page_checkout_status'][$store['store_id']] == '1') : ?> selected="selected" <?php endif; ?> value="1">Enable</option>
                            <option <?php if ($customisation_general_store['additional_page_checkout_status'][$store['store_id']] == '0') : ?> selected="selected" <?php endif; ?> value="0">Disable</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="additional_page_account_status<?php echo $store["store_id"]; ?>">Link: Account</label>
                    <div class="col-sm-8">
                        <select name="customisation_general_store[additional_page_account_status][<?php echo $store["store_id"]; ?>]" id="additional_page_account_status<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if ($customisation_general_store['additional_page_account_status'][$store['store_id']] == '1') : ?> selected="selected" <?php endif; ?> value="1">Enable</option>
                            <option <?php if ($customisation_general_store['additional_page_account_status'][$store['store_id']] == '0') : ?> selected="selected" <?php endif; ?> value="0">Disable</option>
                        </select>
                    </div>
                </div>

            </div>
            <!--pages-->
            </fieldset>
            <fieldset>
                <legend>Footer</legend>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="footer_type<?php echo $store["store_id"]; ?>">
                         <span data-toggle="tooltip" title=" - type 1: footer closed and opened after clicking on button<br>
                                                            - type 2: always opened footer">
                                                                Type of Footer
                         </span>
                    </label>
                    <div class="col-sm-8">
                        <select name="customisation_general_store[footer_type][<?php echo $store["store_id"]; ?>]" id="footer_type<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if (isset($customisation_general_store['footer_type'][$store['store_id']]) && $customisation_general_store['footer_type'][$store['store_id']]  == 1) : ?> selected="selected" <?php endif; ?> value="1">Popup Effect</option>
                            <option <?php if (isset($customisation_general_store['footer_type'][$store['store_id']]) && $customisation_general_store['footer_type'][$store['store_id']]  == 2) : ?> selected="selected" <?php endif; ?> value="2">Static Footer</option>
                        </select>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-sm-4 control-label" for="meta-title<?php echo $store["store_id"]; ?>">
                        <span data-toggle="tooltip" title="Here you can enter simple text or html content for footer copyright.">
                            Footer copyright content:
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <input type="text" name="customisation_general_store[footercopyright][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['footercopyright'][$store['store_id']]) ? $customisation_general_store['footercopyright'][$store['store_id']] : ''); ?>" placeholder="Footer copyright content" id="meta-title<?php echo $store["store_id"]; ?>" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="name-footer_socials_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">
                         <span data-toggle="tooltip" title="Set title for Footer Social Block.">
                            Footer Social Block - title:
                         </span>
                    </label>
                    <div class="col-sm-8">
                        <ul class="nav nav-tabs" id="language-footer_socials_title">
                            <?php foreach ($languages as $language) : ?>
                            <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-footer_socials_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($languages as $language) : ?>
                            <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-footer_socials_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                                <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][footer_socials_title][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['footer_socials_title'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['footer_socials_title'][$store['store_id']] : ''; ?>" placeholder="Footer Social Block - title" id="name-footer_socials_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span data-toggle="tooltip" title="Edit content here or add your own">
                            Footer Social Block:
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <textarea name="customisation_general_store[socials][<?php echo $store["store_id"]; ?>]" rows="5" placeholder="Footer Social Block" id="input-socials" class="form-control"><?php echo (isset($customisation_general_store['socials'][$store['store_id']]) ? $customisation_general_store['socials'][$store['store_id']] : ''); ?></textarea>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["socials_status"][$store['store_id']]) && $customisation_general_store["socials_status"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[socials_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                            <?php echo $text_yes; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[socials_status][<?php echo $store["store_id"]; ?>]" value="1" />
                            <?php echo $text_yes; ?>
                            <?php } ?>
                        </label>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["socials_status"][$store['store_id']]) && !$customisation_general_store["socials_status"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[socials_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                            <?php echo $text_no; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[socials_status][<?php echo $store["store_id"]; ?>]" value="0" />
                            <?php echo $text_no; ?>
                            <?php } ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span data-toggle="tooltip" title="Edit content here or change / add your own images for payment icons">
                            Footer payment icons images:
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <textarea name="customisation_general_store[footerpayment][<?php echo $store["store_id"]; ?>]" rows="5" placeholder="Footer payment icons images" id="input-footerpayment" class="form-control"><?php echo (isset($customisation_general_store['footerpayment'][$store['store_id']]) ? $customisation_general_store['footerpayment'][$store['store_id']] : ''); ?></textarea>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["footerpayment_status"][$store['store_id']]) && $customisation_general_store["footerpayment_status"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[footerpayment_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                            <?php echo $text_yes; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[footerpayment_status][<?php echo $store["store_id"]; ?>]" value="1" />
                            <?php echo $text_yes; ?>
                            <?php } ?>
                        </label>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["footerpayment_status"][$store['store_id']]) && !$customisation_general_store["footerpayment_status"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[footerpayment_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                            <?php echo $text_no; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[footerpayment_status][<?php echo $store["store_id"]; ?>]" value="0" />
                            <?php echo $text_no; ?>
                            <?php } ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="name-custom_html_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">
                        <span data-toggle="tooltip" title="Set html block title.">
                            Custom footer block title:
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <ul class="nav nav-tabs" id="language-custom_html_title">
                            <?php foreach ($languages as $language) : ?>
                            <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-custom_html_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($languages as $language) : ?>
                            <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-custom_html_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                                <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][custom_html_title][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['custom_html_title'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['custom_html_title'][$store['store_id']] : ''; ?>" placeholder="Custom footer block title" id="name-custom_html_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="input-description-customblock<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>">
                        Custom footer block content:
                    </label>
                    <div class="col-sm-8">
                        <ul class="nav nav-tabs" id="language-customblock">
                            <?php foreach ($languages as $language) : ?>
                            <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-customblock<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($languages as $language) : ?>
                            <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-customblock<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>">
                                <textarea name="customisation_general_store[<?php echo $language['language_id']; ?>][customblock_html][<?php echo $store["store_id"]; ?>]" placeholder="Custom footer block content" id="input-description-customblock<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>"><?php echo isset($customisation_general_store[$language['language_id']]['customblock_html'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['customblock_html'][$store['store_id']] : ''; ?></textarea>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span data-toggle="tooltip" title="Here you can enable / disable custom html block in dark footer">
                             Custom footer block visibility:
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["customblock_status"][$store['store_id']]) && $customisation_general_store["customblock_status"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[customblock_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                            <?php echo $text_yes; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[customblock_status][<?php echo $store["store_id"]; ?>]" value="1" />
                            <?php echo $text_yes; ?>
                            <?php } ?>
                        </label>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["customblock_status"][$store['store_id']]) && !$customisation_general_store["customblock_status"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[customblock_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                            <?php echo $text_no; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[customblock_status][<?php echo $store["store_id"]; ?>]" value="0" />
                            <?php echo $text_no; ?>
                            <?php } ?>
                        </label>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>NEWSLETTER SIGHUP block</legend>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="apikey<?php echo $store["store_id"]; ?>">
                        API keys:<br>
                        <span class="help" data-toggle="tooltip" title="Enter your API keys to your Mailchimp account">
                             <a href="http://kb.mailchimp.com/accounts/management/about-api-keys" target="_blank">Read here</a>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <input type="text" name="customisation_general_store[apikey][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['apikey'][$store['store_id']]) ? $customisation_general_store['apikey'][$store['store_id']] : ''); ?>" placeholder="API keys:" id="apikey<?php echo $store["store_id"]; ?>" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="list_unique_id<?php echo $store["store_id"]; ?>">
                        List ID:<br>
                        <span class="help" data-toggle="tooltip" title="Enter your list ID to your Mailchimp account">
                            <a href="http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id" target="_blank">Read here</a>
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <input type="text" name="customisation_general_store[list_unique_id][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['list_unique_id'][$store['store_id']]) ? $customisation_general_store['list_unique_id'][$store['store_id']] : ''); ?>" placeholder="List ID:" id="list_unique_id<?php echo $store["store_id"]; ?>" class="form-control" />
                    </div>
                </div>

                <!--newsletter texts-->
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="name-newsletter_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">Title for Newsletter block:</label>
                    <div class="col-sm-8">
                        <ul class="nav nav-tabs" id="language-newsletter_title">
                            <?php foreach ($languages as $language) : ?>
                            <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-newsletter_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($languages as $language) : ?>
                            <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-newsletter_title<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                                <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][newsletter_title][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['newsletter_title'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['newsletter_title'][$store['store_id']] : ''; ?>" placeholder="Newsletter title:" id="name-newsletter_title<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="name-newsletter_promo<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">Promo text for Newsletter block:</label>
                    <div class="col-sm-8">
                        <ul class="nav nav-tabs" id="language-newsletter_promo">
                            <?php foreach ($languages as $language) : ?>
                            <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-newsletter_promo<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($languages as $language) : ?>
                            <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-newsletter_promo<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                                <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][newsletter_promo][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['newsletter_promo'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['newsletter_promo'][$store['store_id']] : ''; ?>" placeholder="Newsletter promo:" id="name-newsletter_promo<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="name-newsletter_placeholder<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">Placeholder in text field for Newsletter block:</label>
                    <div class="col-sm-8">
                        <ul class="nav nav-tabs" id="language-newsletter_placeholder">
                            <?php foreach ($languages as $language) : ?>
                            <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-newsletter_placeholder<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($languages as $language) : ?>
                            <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-newsletter_placeholder<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                                <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][newsletter_placeholder][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['newsletter_placeholder'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['newsletter_placeholder'][$store['store_id']] : ''; ?>" placeholder="Newsletter text field placeholder:" id="name-newsletter_placeholder<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="name-newsletter_button<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">Button text for Newsletter block:</label>
                    <div class="col-sm-8">
                        <ul class="nav nav-tabs" id="language-newsletter_button">
                            <?php foreach ($languages as $language) : ?>
                            <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-newsletter_button<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($languages as $language) : ?>
                            <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-newsletter_button<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                                <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][newsletter_button][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['newsletter_button'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['newsletter_button'][$store['store_id']] : ''; ?>" placeholder="Button text:" id="name-newsletter_button<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="name-newsletter_close<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>">Close text:</label>
                    <div class="col-sm-8">
                        <ul class="nav nav-tabs" id="language-newsletter_close">
                            <?php foreach ($languages as $language) : ?>
                            <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-newsletter_close<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($languages as $language) : ?>
                            <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-newsletter_close<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                                <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][newsletter_close][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['newsletter_close'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['newsletter_close'][$store['store_id']] : ''; ?>" placeholder="Close text:" id="name-newsletter_close<?php echo $language['language_id']; ?><?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!--end newsletter texts-->

                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span data-toggle="tooltip" title="Here you can enable / disable Newsletter subscribe block in bottom">
                             Newsletter subscribe block visibility:
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["newsletter_status"][$store['store_id']]) && $customisation_general_store["newsletter_status"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[newsletter_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                            <?php echo $text_yes; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[newsletter_status][<?php echo $store["store_id"]; ?>]" value="1" />
                            <?php echo $text_yes; ?>
                            <?php } ?>
                        </label>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["newsletter_status"][$store['store_id']]) && !$customisation_general_store["newsletter_status"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[newsletter_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                            <?php echo $text_no; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[newsletter_status][<?php echo $store["store_id"]; ?>]" value="0" />
                            <?php echo $text_no; ?>
                            <?php } ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span data-toggle="tooltip" title="Here you can enable / disable popup window with Newsletter subscribe block">
                             Popoup Newsletter subscribe block visibility:
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["newsletter_popup_status"][$store['store_id']]) && $customisation_general_store["newsletter_popup_status"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[newsletter_popup_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                            <?php echo $text_yes; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[newsletter_popup_status][<?php echo $store["store_id"]; ?>]" value="1" />
                            <?php echo $text_yes; ?>
                            <?php } ?>
                        </label>
                        <label class="radio-inline">
                            <?php if (isset($customisation_general_store["newsletter_popup_status"][$store['store_id']]) && !$customisation_general_store["newsletter_popup_status"][$store['store_id']]) { ?>
                            <input type="radio" name="customisation_general_store[newsletter_popup_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                            <?php echo $text_no; ?>
                            <?php } else { ?>
                            <input type="radio" name="customisation_general_store[newsletter_popup_status][<?php echo $store["store_id"]; ?>]" value="0" />
                            <?php echo $text_no; ?>
                            <?php } ?>
                        </label>
                    </div>
                </div>
            </fieldset>


            </div>
            <!--end Header/Footer Blocks-->

            <!--sliders-->
            <div id="tab-general-layout4-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="form-group">
                    <label class="col-sm-5 control-label">Share buttons links in Product "Quick view":</label>
                    <div class="col-sm-7">
                        <div>Facebook account link:</div>
                        <input type="text" name="customisation_general_store[share_block1][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['share_block1'][$store['store_id']]) ? $customisation_general_store['share_block1'][$store['store_id']] : ''); ?>" placeholder="Facebook link:" id="share_block1<?php echo $store["store_id"]; ?>" class="form-control" />
                        <div>Twitter account link:</div>
                        <input type="text" name="customisation_general_store[share_block2][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['share_block2'][$store['store_id']]) ? $customisation_general_store['share_block2'][$store['store_id']] : ''); ?>" placeholder="Twitter link:" id="share_block2<?php echo $store["store_id"]; ?>" class="form-control" />
                        <div>Google account link:</div>
                        <input type="text" name="customisation_general_store[share_block3][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['share_block3'][$store['store_id']]) ? $customisation_general_store['share_block3'][$store['store_id']] : ''); ?>" placeholder="Google link:" id="share_block3<?php echo $store["store_id"]; ?>" class="form-control" />
                        <div>PinInterest account link:</div>
                        <input type="text" name="customisation_general_store[share_block4][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['share_block4'][$store['store_id']]) ? $customisation_general_store['share_block4'][$store['store_id']] : ''); ?>" placeholder="PinInterest link:" id="share_block4<?php echo $store["store_id"]; ?>" class="form-control" />

                    </div>
                </div>


            <div class="form-group">
                <label class="col-sm-5 control-label">Number of products in one row in "Slick" slider:</label>
                <div class="col-sm-7">
                    <input type="text" name="customisation_general_store[slick_row][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_general_store['slick_row'][$store['store_id']]) ? $customisation_general_store['slick_row'][$store['store_id']] : ''); ?>" placeholder="Set number:" id="slick_row<?php echo $store["store_id"]; ?>" class="form-control" />
                </div>
            </div>


            <fieldset>
                <legend>Settings: product module type</legend>
                <div>
                    - Types "Horizontal Carousel Slider" and "Slick Slider" <span style="color:red">can not be used</span> in Position: "Footer Universal Products Block".<br>
                    - Type "Vertical Slider" can be used <span style="color:red">only!</span> in "Footer Universal Products Block" Layout.<br>
                    P.S. <strong style="color:red">NOTE!!!</strong> If you need to use for some slider type "Horizontal Carousel Slider" or "Slick Slider" you have to set only one module in "Footer Universal Products Block" Layout.
                    <br><br>
                </div>

                <!--sliders-->
                <div class="featured">
                    <div class="form-group">
                        <h2 class="title_h2">Featured Slider</h2>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="col-sm-4 control-label" for="featured_type<?php echo $store["store_id"]; ?>">
                                Slider type:
                            </label>
                            <div class="col-sm-8">
                                <select name="customisation_slider_store[featured_type][<?php echo $store["store_id"]; ?>]" id="featured_type<?php echo $store["store_id"]; ?>" class="form-control">
                                    <option <?php if (isset($customisation_slider_store['featured_type'][$store['store_id']]) && $customisation_slider_store['featured_type'][$store['store_id']] == 'horizontal') : ?> selected="selected" <?php endif; ?> value="horizontal">Horizontal Carousel Slider</option>
                                    <option <?php if (isset($customisation_slider_store['featured_type'][$store['store_id']]) && $customisation_slider_store['featured_type'][$store['store_id']] == 'vertical') : ?> selected="selected" <?php endif; ?> value="vertical">Vertical Slider</option>
                                    <option <?php if (isset($customisation_slider_store['featured_type'][$store['store_id']]) && $customisation_slider_store['featured_type'][$store['store_id']] == 'slick') : ?> selected="selected" <?php endif; ?> value="slick">Slick Slider</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="latest">
                    <div class="form-group">
                        <h2 class="title_h2">Latest Slider</h2>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="col-sm-4 control-label" for="latest_type<?php echo $store["store_id"]; ?>">Slider type:</label>
                            <div class="col-sm-8">
                                <select name="customisation_slider_store[latest_type][<?php echo $store["store_id"]; ?>]" id="latest_type<?php echo $store["store_id"]; ?>" class="form-control">
                                    <option <?php if (isset($customisation_slider_store['latest_type'][$store['store_id']]) && $customisation_slider_store['latest_type'][$store['store_id']] == 'horizontal') : ?> selected="selected" <?php endif; ?> value="horizontal">Horizontal Carousel Slider</option>
                                    <option <?php if (isset($customisation_slider_store['latest_type'][$store['store_id']]) && $customisation_slider_store['latest_type'][$store['store_id']] == 'vertical') : ?> selected="selected" <?php endif; ?> value="vertical">Vertical Slider</option>
                                    <option <?php if (isset($customisation_slider_store['latest_type'][$store['store_id']]) && $customisation_slider_store['latest_type'][$store['store_id']] == 'slick') : ?> selected="selected" <?php endif; ?> value="slick">Slick Slider</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bestseller">
                    <div class="form-group">
                        <h2 class="title_h2">Bestsellers Slider</h2>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="col-sm-4 control-label" for="bestseller_type<?php echo $store["store_id"]; ?>">Slider type:</label>
                            <div class="col-sm-8">
                                <select name="customisation_slider_store[bestseller_type][<?php echo $store["store_id"]; ?>]" id="bestseller_type<?php echo $store["store_id"]; ?>" class="form-control">
                                    <option <?php if (isset($customisation_slider_store['bestseller_type'][$store['store_id']]) && $customisation_slider_store['bestseller_type'][$store['store_id']] == 'horizontal') : ?> selected="selected" <?php endif; ?> value="horizontal">Horizontal Carousel Slider</option>
                                    <option <?php if (isset($customisation_slider_store['bestseller_type'][$store['store_id']]) && $customisation_slider_store['bestseller_type'][$store['store_id']] == 'vertical') : ?> selected="selected" <?php endif; ?> value="vertical">Vertical Slider</option>
                                    <option <?php if (isset($customisation_slider_store['bestseller_type'][$store['store_id']]) && $customisation_slider_store['bestseller_type'][$store['store_id']] == 'slick') : ?> selected="selected" <?php endif; ?> value="slick">Slick Slider</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popular">
                    <div class="form-group">
                        <h2 class="title_h2">Popular Products Slider</h2>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="col-sm-4 control-label" for="popular_type<?php echo $store["store_id"]; ?>">Slider type:</label>
                            <div class="col-sm-8">
                                <select name="customisation_slider_store[popular_type][<?php echo $store["store_id"]; ?>]" id="popular_type<?php echo $store["store_id"]; ?>" class="form-control">
                                    <option <?php if (isset($customisation_slider_store['popular_type'][$store['store_id']]) && $customisation_slider_store['popular_type'][$store['store_id']] == 'horizontal') : ?> selected="selected" <?php endif; ?> value="horizontal">Horizontal Carousel Slider</option>
                                    <option <?php if (isset($customisation_slider_store['popular_type'][$store['store_id']]) && $customisation_slider_store['popular_type'][$store['store_id']] == 'vertical') : ?> selected="selected" <?php endif; ?> value="vertical">Vertical Slider</option>
                                    <option <?php if (isset($customisation_slider_store['popular_type'][$store['store_id']]) && $customisation_slider_store['popular_type'][$store['store_id']] == 'slick') : ?> selected="selected" <?php endif; ?> value="slick">Slick Slider</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="specials">
                    <div class="form-group">
                        <h2 class="title_h2">Specials Slider</h2>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="col-sm-4 control-label" for="special_type<?php echo $store["store_id"]; ?>">Slider type:</label>
                            <div class="col-sm-8">
                                <select name="customisation_slider_store[special_type][<?php echo $store["store_id"]; ?>]" id="special_type<?php echo $store["store_id"]; ?>" class="form-control">
                                    <option <?php if (isset($customisation_slider_store['special_type'][$store['store_id']]) && $customisation_slider_store['special_type'][$store['store_id']] == 'horizontal') : ?> selected="selected" <?php endif; ?> value="horizontal">Horizontal Carousel Slider</option>
                                    <option <?php if (isset($customisation_slider_store['special_type'][$store['store_id']]) && $customisation_slider_store['special_type'][$store['store_id']] == 'vertical') : ?> selected="selected" <?php endif; ?> value="vertical">Vertical Slider</option>
                                    <option <?php if (isset($customisation_slider_store['special_type'][$store['store_id']]) && $customisation_slider_store['special_type'][$store['store_id']] == 'slick') : ?> selected="selected" <?php endif; ?> value="slick">Slick Slider</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="random">
                    <div class="form-group">
                        <h2 class="title_h2">Random Slider</h2>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="col-sm-4 control-label" for="random_type<?php echo $store["store_id"]; ?>">Slider type:</label>
                            <div class="col-sm-8">
                                <select name="customisation_slider_store[random_type][<?php echo $store["store_id"]; ?>]" id="random_type<?php echo $store["store_id"]; ?>" class="form-control">
                                    <option <?php if (isset($customisation_slider_store['random_type'][$store['store_id']]) && $customisation_slider_store['random_type'][$store['store_id']] == 'horizontal') : ?> selected="selected" <?php endif; ?> value="horizontal">Horizontal Carousel Slider</option>
                                    <option <?php if (isset($customisation_slider_store['random_type'][$store['store_id']]) && $customisation_slider_store['random_type'][$store['store_id']] == 'vertical') : ?> selected="selected" <?php endif; ?> value="vertical">Vertical Slider</option>
                                    <option <?php if (isset($customisation_slider_store['random_type'][$store['store_id']]) && $customisation_slider_store['random_type'][$store['store_id']] == 'slick') : ?> selected="selected" <?php endif; ?> value="slick">Slick Slider</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!--sliders-->
            </fieldset>
            </div>
            <!--sliders-->

            <!--Some language variables-->
            <div id="tab-general-layout5-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="form-group">
                    <div class="col-sm-12 display_block help">Keep in mind, if you leave some field empty corresponding block will not be displayed.</div>
                </div>
                <ul class="nav nav-tabs" id="translation">
                    <?php foreach ($languages as $language) : ?>
                    <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#translation<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>

                <div class="tab-content">
                    <?php foreach ($languages as $language) : ?>
                    <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="translation<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                        <div class="form-group">
                            <label class="col-sm-5 control-label" for="dd_title<?php echo $store["store_id"]; ?>">Title of product slider in dropdown part of Top menu:</label>
                            <div class="col-sm-7">
                                <input type="text" name="customisation_translation_store[<?php echo $language['language_id']; ?>][dd_title][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_translation_store[$language['language_id']]['dd_title'][$store['store_id']]) ? $customisation_translation_store[$language['language_id']]['dd_title'][$store['store_id']] : ''; ?>" placeholder="top menu slider" id="dd_title<?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label" for="view_details<?php echo $store["store_id"]; ?>">"view details" button in inline "quick view" block:</label>
                            <div class="col-sm-7">
                                <input type="text" name="customisation_translation_store[<?php echo $language['language_id']; ?>][view_details][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_translation_store[$language['language_id']]['view_details'][$store['store_id']]) ? $customisation_translation_store[$language['language_id']]['view_details'][$store['store_id']] : ''; ?>" placeholder="'view details' button" id="view_details<?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label" for="share_title<?php echo $store["store_id"]; ?>">"share" title neare social buttons in inline "quick view" block:</label>
                            <div class="col-sm-7">
                                <input type="text" name="customisation_translation_store[<?php echo $language['language_id']; ?>][share_title][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_translation_store[$language['language_id']]['share_title'][$store['store_id']]) ? $customisation_translation_store[$language['language_id']]['share_title'][$store['store_id']] : ''; ?>" placeholder="'share' title" id="share_title<?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label" for="tags_tab_title<?php echo $store["store_id"]; ?>">"tags" tab title on Product page:</label>
                            <div class="col-sm-7">
                                <input type="text" name="customisation_translation_store[<?php echo $language['language_id']; ?>][tags_tab_title][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_translation_store[$language['language_id']]['tags_tab_title'][$store['store_id']]) ? $customisation_translation_store[$language['language_id']]['tags_tab_title'][$store['store_id']] : ''; ?>" placeholder="'tags' tab" id="tags_tab_title<?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label" for="brands_title<?php echo $store["store_id"]; ?>">"Brands" title in Carousel module:</label>
                            <div class="col-sm-7">
                                <input type="text" name="customisation_translation_store[<?php echo $language['language_id']; ?>][brands_title][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_translation_store[$language['language_id']]['brands_title'][$store['store_id']]) ? $customisation_translation_store[$language['language_id']]['brands_title'][$store['store_id']] : ''; ?>" placeholder="'Brands' title" id="brands_title<?php echo $store["store_id"]; ?>" class="form-control" />
                            </div>
                        </div>



                        <fieldset>
                            <legend>Countdown block</legend>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="countdown_title<?php echo $store["store_id"]; ?>">Title:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="customisation_translation_store[<?php echo $language['language_id']; ?>][countdown_title][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_translation_store[$language['language_id']]['countdown_title'][$store['store_id']]) ? $customisation_translation_store[$language['language_id']]['countdown_title'][$store['store_id']] : ''; ?>" placeholder="countdown title" id="countdown_title<?php echo $store["store_id"]; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="countdown_title_day<?php echo $store["store_id"]; ?>">"Day" title:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="customisation_translation_store[<?php echo $language['language_id']; ?>][countdown_title_day][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_translation_store[$language['language_id']]['countdown_title_day'][$store['store_id']]) ? $customisation_translation_store[$language['language_id']]['countdown_title_day'][$store['store_id']] : ''; ?>" placeholder="Day" id="countdown_title_day<?php echo $store["store_id"]; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="countdown_title_hour<?php echo $store["store_id"]; ?>">"Hour" title:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="customisation_translation_store[<?php echo $language['language_id']; ?>][countdown_title_hour][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_translation_store[$language['language_id']]['countdown_title_hour'][$store['store_id']]) ? $customisation_translation_store[$language['language_id']]['countdown_title_hour'][$store['store_id']] : ''; ?>" placeholder="Hour" id="countdown_title_hour<?php echo $store["store_id"]; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="countdown_title_minute<?php echo $store["store_id"]; ?>">"Minute" title:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="customisation_translation_store[<?php echo $language['language_id']; ?>][countdown_title_minute][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_translation_store[$language['language_id']]['countdown_title_minute'][$store['store_id']]) ? $customisation_translation_store[$language['language_id']]['countdown_title_minute'][$store['store_id']] : ''; ?>" placeholder="Minute" id="countdown_title_minute<?php echo $store["store_id"]; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="countdown_title_second<?php echo $store["store_id"]; ?>">"Second" title:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="customisation_translation_store[<?php echo $language['language_id']; ?>][countdown_title_second][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_translation_store[$language['language_id']]['countdown_title_second'][$store['store_id']]) ? $customisation_translation_store[$language['language_id']]['countdown_title_second'][$store['store_id']] : ''; ?>" placeholder="Second" id="countdown_title_second<?php echo $store["store_id"]; ?>" class="form-control" />
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <?php endforeach; ?>

                </div>





            </div>
            <!--end Some language variables-->

        </div>
    </div>
    <!-------------------------------------end tab General---------------------------------->

    <!-------------------------------------tab Colors,backgrounds,fonts-->
    <div class="tab-pane" id="tab-colors<?php echo $store['store_id']; ?>">

        <ul class="nav nav-tabs col-sm-3 main_tabs_vertical">
            <li class="active"><a href="#tab-colors-layout1-<?php echo $store['store_id']; ?>" class="selected" data-toggle="tab">General</a></li>
            <li><a href="#tab-colors-layout2-<?php echo $store['store_id']; ?>" data-toggle="tab">Captions</a></li>
            <li><a href="#tab-colors-layout3-<?php echo $store['store_id']; ?>" data-toggle="tab">Header</a></li>
            <li><a href="#tab-colors-layout4-<?php echo $store['store_id']; ?>" data-toggle="tab">Header / Toolline panel</a></li>
            <li><a href="#tab-colors-layout5-<?php echo $store['store_id']; ?>" data-toggle="tab">Header / Top Navigation</a></li>
            <li><a href="#tab-colors-layout6-<?php echo $store['store_id']; ?>" data-toggle="tab">Content / Promo blocks</a></li>
            <li><a href="#tab-colors-layout7-<?php echo $store['store_id']; ?>" data-toggle="tab">Content / General</a></li>
            <li><a href="#tab-colors-layout8-<?php echo $store['store_id']; ?>" data-toggle="tab">Content / Products listings</a></li>
            <li><a href="#tab-colors-layout9-<?php echo $store['store_id']; ?>" data-toggle="tab">Footer / Information Block</a></li>
            <li><a href="#tab-colors-layout10-<?php echo $store['store_id']; ?>" data-toggle="tab">Footer / Bottom Info Block</a></li>
        </ul>
        <div class="tab-content col-sm-8">
            <!--subtabs: General -->
            <div class="tab-pane active" id="tab-colors-layout1-<?php echo $store['store_id']; ?>">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="layout_skin<?php echo $store["store_id"]; ?>">
                        <span data-toggle="tooltip" title="This option changes only colors of site. To see also blocks in different positions you have to prepare file install.sql and reinstall theme.">
                             Layout skin:
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <select onchange="getVal<?php echo $store["store_id"]; ?>(this);" name="customisation_colors_store[layout_skin][<?php echo $store["store_id"]; ?>]" id="layout_skin<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if (isset($customisation_colors_store['layout_skin'][$store['store_id']]) && $customisation_colors_store['layout_skin'][$store['store_id']] == 'default') : ?> selected="selected" <?php endif; ?> value="default">Default layout</option>
                            <option <?php if (isset($customisation_colors_store['layout_skin'][$store['store_id']]) && $customisation_colors_store['layout_skin'][$store['store_id']] == 'marina') : ?> selected="selected" <?php endif; ?> value="marina">Marina Grey layout</option>
                            <option <?php if (isset($customisation_colors_store['layout_skin'][$store['store_id']]) && $customisation_colors_store['layout_skin'][$store['store_id']] == 'bio') : ?> selected="selected" <?php endif; ?> value="bio">Bio layout</option>
                            <option <?php if (isset($customisation_colors_store['layout_skin'][$store['store_id']]) && $customisation_colors_store['layout_skin'][$store['store_id']] == 'tools') : ?> selected="selected" <?php endif; ?> value="tools">Tools layout</option>
                            <option <?php if (isset($customisation_colors_store['layout_skin'][$store['store_id']]) && $customisation_colors_store['layout_skin'][$store['store_id']] == 'kids') : ?> selected="selected" <?php endif; ?> value="kids">Kids layout</option>
                            <option <?php if (isset($customisation_colors_store['layout_skin'][$store['store_id']]) && $customisation_colors_store['layout_skin'][$store['store_id']] == 'art') : ?> selected="selected" <?php endif; ?> value="art">Art layout</option>
                            <option <?php if (isset($customisation_colors_store['layout_skin'][$store['store_id']]) && $customisation_colors_store['layout_skin'][$store['store_id']] == 'lingerie') : ?> selected="selected" <?php endif; ?> value="lingerie">Lingerie layout</option>
                        </select>
                    </div>
                </div>


                <!--options for Lingerie skin-->
                    <fieldset id="lingerie_skin<?php echo $store["store_id"]; ?>" class="display_none">
                        <legend>Additional Options for Lingerie Layout</legend>
                        <div class="form-group">
                                <label class="col-sm-4 control-label" for="preloader_status<?php echo $store["store_id"]; ?>">Preloader for Lingerie layout:</label>
                                <div class="col-sm-8">
                                    <select name="customisation_general_store[preloader_status][<?php echo $store["store_id"]; ?>]" id="preloader_status<?php echo $store["store_id"]; ?>" class="form-control">
                                        <option <?php if (isset($customisation_general_store['preloader_status'][$store['store_id']]) && $customisation_general_store['preloader_status'][$store['store_id']] == '1') : ?> selected="selected" <?php endif; ?> value="1">Enable</option>
                                        <option <?php if (isset($customisation_general_store['preloader_status'][$store['store_id']]) && $customisation_general_store['preloader_status'][$store['store_id']] == '0') : ?> selected="selected" <?php endif; ?> value="0">Disable</option>
                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="input-description-preloader<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>">
                                Preloader content:
                                <div style="font-weight:normal;text-align:left">
                                    for example, you can enter such content:<br>
                                    &lt;div id="preload-image" style="background-image:url('image/catalog/skin_lingerie/preload-image.jpg');" data-img-width="1280" data-img-height="920"&gt;<br>
                                    &lt;div class="preloadText"&gt;<br>
                                    &lt;div class="inside"&gt;<br>
                                    &lt;img src="image/catalog/skin_lingerie/logo-invert.png" alt=""/&gt;<br>
                                    &lt;div&gt;Premium responsive theme&lt;/div&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;<br>
                                    &lt;div&gt;&lt;a id="goToSite" class="btn"&gt;GET STARTED NOW&lt;/a&gt;<br>
                                    &lt;/div&gt;<br>
                                    &lt;/div&gt;<br>
                                    &lt;/div&gt;<br>
                                    &lt;/div&gt;<br>

                                </div>
                            </label>
                            <div class="col-sm-8">
                                <ul class="nav nav-tabs" id="language-preloader">
                                    <?php foreach ($languages as $language) : ?>
                                    <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#language-preloader<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="tab-content">
                                    <?php foreach ($languages as $language) : ?>
                                    <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="language-preloader<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>">
                                        <textarea name="customisation_general_store[<?php echo $language['language_id']; ?>][preloader_html][<?php echo $store["store_id"]; ?>]" placeholder="Preloader content" id="input-description-preloader<?php echo $language['language_id']; ?>-<?php echo $store['store_id']; ?>"><?php echo isset($customisation_general_store[$language['language_id']]['preloader_html'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['preloader_html'][$store['store_id']] : ''; ?></textarea>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>




                    </fieldset>
                <!--end options for Lingerie skin-->


                <div class="form-group">
                    <label class="col-sm-4 control-label" for="customisation_colors_general_bgcolor<?php echo $store["store_id"]; ?>">
                         <span data-toggle="tooltip" title="Set background color for all content.">
                             Background Color:
                         </span>
                    </label>
                    <div class="col-sm-8">
                        <input class="form-control width_auto" id="customisation_colors_general_bgcolor<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['general_bgcolor'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[general_bgcolor][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['general_bgcolor'][$store['store_id']]; ?>" placeholder="Background color:" />
                    </div>
                </div>




                <div class="form-group">
                    <label class="col-sm-4 control-label">
                         <span data-toggle="tooltip" title="Set background image for all site.">
                              Background Image:
                         </span>
                    </label>
                    <div class="col-sm-8">
                        <p>Upload image in path: image/catalog/ and write here only name as "image.png"</p>
                        <input type="text" name="customisation_colors_store[contentbg][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_colors_store['contentbg'][$store['store_id']]) ? $customisation_colors_store['contentbg'][$store['store_id']] : ''); ?>" placeholder="Background image" id="contentbg<?php echo $store["store_id"]; ?>" class="form-control" />
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-4 control-label" for="content_bg_mode<?php echo $store["store_id"]; ?>">
                         <span data-toggle="tooltip" title="Set background image display mode">
                             Background Image display mode:
                         </span>
                    </label>
                    <div class="col-sm-8">
                        <select name="customisation_colors_store[content_bg_mode][<?php echo $store["store_id"]; ?>]" id="content_bg_mode<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if (isset($customisation_colors_store['content_bg_mode'][$store['store_id']]) && $customisation_colors_store['content_bg_mode'][$store['store_id']] == 'repeat') : ?> selected="selected" <?php endif; ?> value="repeat">Repeat</option>
                            <option <?php if (isset($customisation_colors_store['content_bg_mode'][$store['store_id']]) && $customisation_colors_store['content_bg_mode'][$store['store_id']] == 'no-repeat') : ?> selected="selected" <?php endif; ?> value="no-repeat">no-repeat</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="customisation_colors_general_themecolor<?php echo $store["store_id"]; ?>">
                        <span data-toggle="tooltip" title="This color will be used for buttons and icons.">
                            Theme color:
                        </span>
                    </label>
                    <div class="col-sm-8">
                        <input class="form-control width_auto" id="customisation_colors_general_themecolor<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['general_themecolor'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[general_themecolor][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['general_themecolor'][$store['store_id']]; ?>" placeholder="Theme color:" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="customisation_colors_general_text<?php echo $store["store_id"]; ?>">
                         <span data-toggle="tooltip" title="Set default text color for all blocks.">
                             Text Color:
                         </span>
                    </label>
                    <div class="col-sm-8">
                        <input class="form-control width_auto" id="customisation_colors_general_text<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['general_text'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[general_text][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['general_text'][$store['store_id']]; ?>" placeholder="Text Color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="customisation_colors_general_link<?php echo $store["store_id"]; ?>">
                          <span data-toggle="tooltip" title="Set default link color for all blocks.">
                              Link Color:
                          </span>
                    </label>
                    <div class="col-sm-8">
                        <input class="form-control width_auto" id="customisation_colors_general_link<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['general_link'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[general_link][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['general_link'][$store['store_id']]; ?>" placeholder="Link Color:" />
                    </div>
                </div>

            </div>
            <!--subtabs: General -->

            <!--subtabs: Captions  -->
            <div id="tab-colors-layout2-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="form-group">
                    <label class="col-sm-6 control-label">
                        Font:<div class="help">Select font which will be used for headings, buttons, block titles etc. Theme use Google font's library. Find out more here - <a target="_blank" href="//www.google.com/fonts/">Google web fonts free library</a></div>
                    </label>
                    <div class="col-sm-6">
                        <select class="form-control width_auto" id="customisation_colors_captions_font<?php echo $store["store_id"]; ?>" name="customisation_colors_store[captions_font][<?php echo $store["store_id"]; ?>]" data-active="<?php echo (isset($customisation_colors_store['captions_font'][$store['store_id']]) ? $customisation_colors_store['captions_font'][$store['store_id']] : ''); ?>">
                            <option value="-">Select</option>
                            <option value="Oswald">Oswald</option>
                            <option value="Aclonica">Aclonica</option>
                            <option value="Allan">Allan</option>
                            <option value="Allerta">Allerta</option>
                            <option value="Amaranth">Amaranth</option>
                            <option value="Anton">Anton</option>
                            <option value="Arimo">Arimo</option>
                            <option value="Artifika">Artifika</option>
                            <option value="Arvo">Arvo</option>
                            <option value="Asset">Asset</option>
                            <option value="Astloch">Astloch</option>
                            <option value="Bangers">Bangers</option>
                            <option value="Bentham">Bentham</option>
                            <option value="Bevan">Bevan</option>
                            <option value="Cabin">Cabin</option>
                            <option value="Calligraffitti">Calligraffitti</option>
                            <option value="Candal">Candal</option>
                            <option value="Cantarell">Cantarell</option>
                            <option value="Cardo">Cardo</option>
                            <option value="Coda">Coda</option>
                            <option value="Crushed">Crushed</option>
                            <option value="Cuprum">Cuprum</option>
                            <option value="Damion">Damion</option>
                            <option value="Forum">Forum</option>
                            <option value="Geo">Geo</option>
                            <option value="Gruppo">Gruppo</option>
                            <option value="Inconsolata">Inconsolata</option>
                            <option value="Judson">Judson</option>
                            <option value="Jura">Jura</option>
                            <option value="Kameron">Kameron</option>
                            <option value="Kenia">Kenia</option>
                            <option value="Kranky">Kranky</option>
                            <option value="Kreon">Kreon</option>
                            <option value="Kristi">Kristi</option>
                            <option value="Lekton">Lekton</option>
                            <option value="Limelight">Limelight</option>
                            <option value="Lobster">Lobster</option>
                            <option value="Lora">Lora</option>
                            <option value="Mako">Mako</option>
                            <option value="MedievalSharp">MedievalSharp</option>
                            <option value="Megrim">Megrim</option>
                            <option value="Merriweather">Merriweather</option>
                            <option value="Metrophobic">Metrophobic</option>
                            <option value="Michroma">Michroma</option>
                            <option value="Monofett">Monofett</option>
                            <option value="Neucha">Neucha</option>
                            <option value="Neuton">Neuton</option>
                            <option value="Orbitron">Orbitron</option>
                            <option value="Pacifico">Pacifico</option>
                            <option value="Philosopher">Philosopher</option>
                            <option value="Play">Play</option>
                            <option value="Puritan">Puritan</option>
                            <option value="Quattrocento">Quattrocento</option>
                            <option value="Radley">Radley</option>
                            <option value="Rokkitt">Rokkitt</option>
                            <option value="Schoolbell">Schoolbell</option>
                            <option value="Slackey">Slackey</option>
                            <option value="Smythe">Smythe</option>
                            <option value="Sunshiney">Sunshiney</option>
                            <option value="Syncopate">Syncopate</option>
                            <option value="Tangerine">Tangerine</option>
                            <option value="Ubuntu">Ubuntu</option>
                            <option value="Ultra">Ultra</option>
                            <option value="Varela">Varela</option>
                            <option value="Vibur">Vibur</option>
                            <option value="Wallpoet">Wallpoet</option>
                            <option value="Zeyada">Zeyada</option>
                        </select>
                        <span id="customisation_colors_captions_font_preview<?php echo $store["store_id"]; ?>" style="font-size:30px;line-height: 30px; display:block;padding:8px 0 0 0">Lorem Ipsum Dolor</span>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label" for="customisation_colors_captions_text<?php echo $store["store_id"]; ?>">
                        <span data-toggle="tooltip" title="Set text color for all captions.">
                             Text Color:
                        </span>
                    </label>
                    <div class="col-sm-6">
                        <input class="form-control width_auto" id="customisation_colors_captions_text<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['captions_text'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[captions_text][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['captions_text'][$store['store_id']]; ?>" placeholder="Set text color for all captions." />
                    </div>
                </div>
            </div>
            <!--subtabs: Captions  -->

            <!--subtabs: header  -->
            <div id="tab-colors-layout3-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="customisation_colors_topline_bgcolor<?php echo $store["store_id"]; ?>">Background Color:</label>
                    <div class="col-sm-8">
                        <input class="form-control width_auto" id="customisation_colors_topline_bgcolor<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['topline_bgcolor'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[topline_bgcolor][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['topline_bgcolor'][$store['store_id']]; ?>" placeholder="Background Color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="customisation_colors_topline_texts<?php echo $store["store_id"]; ?>">Texts color:</label>
                    <div class="col-sm-8">
                        <input class="form-control width_auto" id="customisation_colors_topline_texts<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['topline_texts'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[topline_texts][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['topline_texts'][$store['store_id']]; ?>" placeholder="Text color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="customisation_colors_header_icons_color<?php echo $store["store_id"]; ?>">Icons color:</label>
                    <div class="col-sm-8">
                        <input class="form-control width_auto" id="customisation_colors_header_icons_color<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['header_icons_color'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[header_icons_color][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['header_icons_color'][$store['store_id']]; ?>" placeholder="Icons color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="customisation_colors_toolline_border<?php echo $store["store_id"]; ?>">Separator line color:</label>
                    <div class="col-sm-8">
                        <input class="form-control width_auto" id="customisation_colors_toolline_border<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['toolline_border'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[toolline_border][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_colors_store['toolline_border'][$store['store_id']]) ? $customisation_colors_store['toolline_border'][$store['store_id']] : ''); ?>" placeholder="Separators:" />
                    </div>
                </div>

            </div>
            <!--subtabs: header -->

            <!--subtabs: toolline   -->
            <div id="tab-colors-layout4-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="customisation_colors_toolline_ink<?php echo $store["store_id"]; ?>">Link Color:</label>
                    <div class="col-sm-9">
                        <input class="form-control width_auto" id="customisation_colors_toolline_ink<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['toolline_ink'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[toolline_ink][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['toolline_ink'][$store['store_id']]; ?>" placeholder="Link Color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="customisation_colors_toolline_icons<?php echo $store["store_id"]; ?>">Icons color:</label>
                    <div class="col-sm-9">
                        <input class="form-control width_auto" id="customisation_colors_toolline_icons<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['toolline_icons'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[toolline_icons][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['toolline_icons'][$store['store_id']]; ?>" placeholder="Toolline icons:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="customisation_colors_toolline_bgcolor<?php echo $store["store_id"]; ?>">Background Color:</label>
                    <div class="col-sm-9">
                        <input class="form-control width_auto" id="customisation_colors_toolline_bgcolor<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['toolline_bgcolor'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[toolline_bgcolor][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['toolline_bgcolor'][$store['store_id']]; ?>" placeholder="Background Color:" />
                    </div>
                </div>

            </div>
            <!--subtabs: toolline  -->

            <!--subtabs: Header top Navigation   -->
            <div id="tab-colors-layout5-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_top_menu_bgcolor<?php echo $store["store_id"]; ?>">Top menu background color:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_top_menu_bgcolor<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['top_menu_bgcolor'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[top_menu_bgcolor][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['top_menu_bgcolor'][$store['store_id']]; ?>" placeholder="Top menu background color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_topmenu_items<?php echo $store["store_id"]; ?>">Top menu items color:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_topmenu_items<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['topmenu_items'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[topmenu_items][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_colors_store['topmenu_items'][$store['store_id']]) ? $customisation_colors_store['topmenu_items'][$store['store_id']] : ''); ?>" placeholder="Top menu items color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_toopmenu_highlight<?php echo $store["store_id"]; ?>">Top menu items highlight border color:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_toopmenu_highlight<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['toopmenu_highlight'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[toopmenu_highlight][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['toopmenu_highlight'][$store['store_id']]; ?>" placeholder="Top menu highlight color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_topmenu_hot<?php echo $store["store_id"]; ?>">Color of label "HOT"</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_topmenu_hot<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['topmenu_hot'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[topmenu_hot][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['topmenu_hot'][$store['store_id']]; ?>" placeholder="Label 'HOT':" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_topmenu_new<?php echo $store["store_id"]; ?>">Color of label "NEW"</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_topmenu_new<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['topmenu_new'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[topmenu_new][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['topmenu_new'][$store['store_id']]; ?>" placeholder="Label 'NEW':" />
                    </div>
                </div>
            </div>
            <!--subtabs: Header top Navigation   -->

            <!--subtabs: Content / promo blocks -->
            <div id="tab-colors-layout6-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_promo_bg<?php echo $store["store_id"]; ?>">Background of Top promo block</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_promo_bg<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['promo_bg'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[promo_bg][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['promo_bg'][$store['store_id']]; ?>" placeholder="Promo block background:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_promo_texts<?php echo $store["store_id"]; ?>">Color of texts in Top promo block</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_promo_texts<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['promo_texts'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[promo_texts][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['promo_texts'][$store['store_id']]; ?>" placeholder="Promo block texts:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_circle_texts<?php echo $store["store_id"]; ?>">Color of texts in Circle Banners</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_circle_texts<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['circle_texts'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[circle_texts][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['circle_texts'][$store['store_id']]; ?>" placeholder="Circle banners texts:" />
                    </div>
                </div>

            </div>
            <!--subtabs: Content / promo blocks -->

            <!--subtabs: content / general -->
            <div id="tab-colors-layout7-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_container_bgcolor<?php echo $store["store_id"]; ?>">Background Color of full content part:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_container_bgcolor<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['container_bgcolor'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[container_bgcolor][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['container_bgcolor'][$store['store_id']]; ?>" placeholder="Background  Color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_blog_bg<?php echo $store["store_id"]; ?>">Blog background Color:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_blog_bg<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['blog_bg'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[blog_bg][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['blog_bg'][$store['store_id']]; ?>" placeholder="Text Color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">Blog Background Image:</label>
                    <div class="col-sm-7">
                        <p>Upload image in path: image/catalog/ and write here only name as "image.png"</p>
                        <input type="text" name="customisation_colors_store[blog_bg_image][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_colors_store['blog_bg_image'][$store['store_id']]) ? $customisation_colors_store['blog_bg_image'][$store['store_id']] : ''); ?>" placeholder="Blog background image" id="blog_bg_image<?php echo $store["store_id"]; ?>" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="blog_bg_mode<?php echo $store["store_id"]; ?>">Blog Background Image display mode:</label>
                    <div class="col-sm-7">
                        <select name="customisation_colors_store[blog_bg_mode][<?php echo $store["store_id"]; ?>]" id="blog_bg_mode<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if (isset($customisation_colors_store['blog_bg_mode'][$store['store_id']]) && $customisation_colors_store['blog_bg_mode'][$store['store_id']] == 'repeat') : ?> selected="selected" <?php endif; ?> value="repeat">Repeat</option>
                            <option <?php if (isset($customisation_colors_store['blog_bg_mode'][$store['store_id']]) && $customisation_colors_store['blog_bg_mode'][$store['store_id']] == 'no-repeat') : ?> selected="selected" <?php endif; ?> value="no-repeat">no-repeat</option>
                            <option <?php if (isset($customisation_colors_store['blog_bg_mode'][$store['store_id']]) && $customisation_colors_store['blog_bg_mode'][$store['store_id']] == 'none') : ?> selected="selected" <?php endif; ?> value="none">No image</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_newsletter_wrapper_bg<?php echo $store["store_id"]; ?>">Background of wrapper block of Newsletter subscribe block:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_newsletter_wrapper_bg<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['newsletter_wrapper_bg'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[newsletter_wrapper_bg][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['newsletter_wrapper_bg'][$store['store_id']]; ?>" placeholder="Captions  Color:" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_newsletter_bg<?php echo $store["store_id"]; ?>">Background of Newsletter subscribe block</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_newsletter_bg<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['newsletter_bg'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[newsletter_bg][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['newsletter_bg'][$store['store_id']]; ?>" placeholder="Promo block icons:" />
                    </div>
                </div>
            </div>
            <!--subtabs: content / general -->

            <!--subtabs: Content / Products listings -->
            <div id="tab-colors-layout8-<?php echo $store['store_id']; ?>" class="tab-pane">

                <div class="form-group">
                    <label class="col-sm-6 control-label" for="customisation_colors_listing_border<?php echo $store["store_id"]; ?>">Border color of products cells</label>
                    <div class="col-sm-6">
                        <input class="form-control width_auto" id="customisation_colors_listing_border<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['listing_border'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[listing_border][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['listing_border'][$store['store_id']]; ?>" placeholder="Border Color:" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-6 control-label" for="customisation_colors_listing_regular_price<?php echo $store["store_id"]; ?>">Regular price color</label>
                    <div class="col-sm-6">
                        <input class="form-control width_auto" id="customisation_colors_listing_regular_price<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['listing_regular_price'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[listing_regular_price][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['listing_regular_price'][$store['store_id']]; ?>" placeholder="Regular price Color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label" for="customisation_colors_listing_old_price<?php echo $store["store_id"]; ?>">Old price color</label>
                    <div class="col-sm-6">
                        <input class="form-control width_auto" id="customisation_colors_listing_old_price<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['listing_old_price'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[listing_old_price][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['listing_old_price'][$store['store_id']]; ?>" placeholder="Old price color:" />
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-6 control-label" for="customisation_colors_listing_special_price<?php echo $store["store_id"]; ?>">Special price color</label>
                    <div class="col-sm-6">
                        <input class="form-control width_auto" id="customisation_colors_listing_special_price<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['listing_special_price'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[listing_special_price][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['listing_special_price'][$store['store_id']]; ?>" placeholder="Special price color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">
                        Price Font:<div class="help">Select font which will be used for prices. Theme use Google font's library. Find out more here - <a target="_blank" href="//www.google.com/fonts/">Google web fonts free library</a></div>
                    </label>
                    <div class="col-sm-6">
                        <select class="form-control width_auto" id="customisation_colors_price_font<?php echo $store["store_id"]; ?>" name="customisation_colors_store[price_font][<?php echo $store["store_id"]; ?>]" data-active="<?php echo (isset($customisation_colors_store['price_font'][$store['store_id']]) ? $customisation_colors_store['price_font'][$store['store_id']] : ''); ?>">
                            <option value="-">Select</option>
                            <option value="Oswald">Oswald</option>
                            <option value="Aclonica">Aclonica</option>
                            <option value="Allan">Allan</option>
                            <option value="Allerta">Allerta</option>
                            <option value="Amaranth">Amaranth</option>
                            <option value="Anton">Anton</option>
                            <option value="Arimo">Arimo</option>
                            <option value="Artifika">Artifika</option>
                            <option value="Arvo">Arvo</option>
                            <option value="Asset">Asset</option>
                            <option value="Astloch">Astloch</option>
                            <option value="Bangers">Bangers</option>
                            <option value="Bentham">Bentham</option>
                            <option value="Bevan">Bevan</option>
                            <option value="Cabin">Cabin</option>
                            <option value="Calligraffitti">Calligraffitti</option>
                            <option value="Candal">Candal</option>
                            <option value="Cantarell">Cantarell</option>
                            <option value="Cardo">Cardo</option>
                            <option value="Coda">Coda</option>
                            <option value="Crushed">Crushed</option>
                            <option value="Cuprum">Cuprum</option>
                            <option value="Damion">Damion</option>
                            <option value="Forum">Forum</option>
                            <option value="Geo">Geo</option>
                            <option value="Gruppo">Gruppo</option>
                            <option value="Inconsolata">Inconsolata</option>
                            <option value="Judson">Judson</option>
                            <option value="Jura">Jura</option>
                            <option value="Kameron">Kameron</option>
                            <option value="Kenia">Kenia</option>
                            <option value="Kranky">Kranky</option>
                            <option value="Kreon">Kreon</option>
                            <option value="Kristi">Kristi</option>
                            <option value="Lekton">Lekton</option>
                            <option value="Limelight">Limelight</option>
                            <option value="Lobster">Lobster</option>
                            <option value="Lora">Lora</option>
                            <option value="Mako">Mako</option>
                            <option value="MedievalSharp">MedievalSharp</option>
                            <option value="Megrim">Megrim</option>
                            <option value="Merriweather">Merriweather</option>
                            <option value="Metrophobic">Metrophobic</option>
                            <option value="Michroma">Michroma</option>
                            <option value="Monofett">Monofett</option>
                            <option value="Neucha">Neucha</option>
                            <option value="Neuton">Neuton</option>
                            <option value="Orbitron">Orbitron</option>
                            <option value="Pacifico">Pacifico</option>
                            <option value="Philosopher">Philosopher</option>
                            <option value="Play">Play</option>
                            <option value="Puritan">Puritan</option>
                            <option value="Quattrocento">Quattrocento</option>
                            <option value="Radley">Radley</option>
                            <option value="Rokkitt">Rokkitt</option>
                            <option value="Schoolbell">Schoolbell</option>
                            <option value="Slackey">Slackey</option>
                            <option value="Smythe">Smythe</option>
                            <option value="Sunshiney">Sunshiney</option>
                            <option value="Syncopate">Syncopate</option>
                            <option value="Tangerine">Tangerine</option>
                            <option value="Ubuntu">Ubuntu</option>
                            <option value="Ultra">Ultra</option>
                            <option value="Varela">Varela</option>
                            <option value="Vibur">Vibur</option>
                            <option value="Wallpoet">Wallpoet</option>
                            <option value="Zeyada">Zeyada</option>
                        </select>
                        <span id="customisation_colors_price_font_preview<?php echo $store["store_id"]; ?>" style="font-size:30px;line-height: 30px; display:block;padding:8px 0 0 0">Lorem Ipsum Dolor</span>

                    </div>
                </div>


            </div>
            <!--subtabs: Content / Products listings -->

            <!--subtabs: Footer / Information Block-->
            <div id="tab-colors-layout9-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_footerpopup_captions<?php echo $store["store_id"]; ?>">Captions text color:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_footerpopup_captions<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['footerpopup_captions'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[footerpopup_captions][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['footerpopup_captions'][$store['store_id']]; ?>" placeholder="Captions text color:" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_footerpopup_link<?php echo $store["store_id"]; ?>">Links and texts Color:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_footerpopup_link<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['footerpopup_link'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[footerpopup_link][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['footerpopup_link'][$store['store_id']]; ?>" placeholder="Link Color:" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_footerpopup_bgcolor<?php echo $store["store_id"]; ?>">Background Color:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_footerpopup_bgcolor<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['footerpopup_bgcolor'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[footerpopup_bgcolor][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['footerpopup_bgcolor'][$store['store_id']]; ?>" placeholder="Background Color:" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-5 control-label">Footer Info background image:</label>
                    <div class="col-sm-7">
                        <p>Upload image in path: image/catalog/ and write here only name as "image.png"</p>
                        <input type="text" name="customisation_colors_store[footerpopup_image][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_colors_store['footerpopup_image'][$store['store_id']]) ? $customisation_colors_store['footerpopup_image'][$store['store_id']] : ''); ?>" placeholder="Background image" id="footerpopup_image<?php echo $store["store_id"]; ?>" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="footerpopup_bg_mode<?php echo $store["store_id"]; ?>">Footer Info Background Image display mode:</label>
                    <div class="col-sm-7">
                        <select name="customisation_colors_store[footerpopup_bg_mode][<?php echo $store["store_id"]; ?>]" id="footerpopup_bg_mode<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if (isset($customisation_colors_store['footerpopup_bg_mode'][$store['store_id']]) && $customisation_colors_store['footerpopup_bg_mode'][$store['store_id']] == 'repeat') : ?> selected="selected" <?php endif; ?> value="repeat">Repeat</option>
                            <option <?php if (isset($customisation_colors_store['footerpopup_bg_mode'][$store['store_id']]) && $customisation_colors_store['footerpopup_bg_mode'][$store['store_id']] == 'no-repeat') : ?> selected="selected" <?php endif; ?> value="no-repeat">no-repeat</option>
                            <option <?php if (isset($customisation_colors_store['footerpopup_bg_mode'][$store['store_id']]) && $customisation_colors_store['footerpopup_bg_mode'][$store['store_id']] == 'none') : ?> selected="selected" <?php endif; ?> value="none">No image</option>
                        </select>
                    </div>
                </div>



            </div>
            <!--subtabs: Footer / Information Block-->

            <!--subtabs: Footer / Bottom Info Block-->
            <div id="tab-colors-layout10-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_footerbottom_captions<?php echo $store["store_id"]; ?>">Captions text color:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_footerbottom_captions<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['footerbottom_captions'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[footerbottom_captions][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['footerbottom_captions'][$store['store_id']]; ?>" placeholder="Captions text color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_footerbottom_texts<?php echo $store["store_id"]; ?>">Links and texts color:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_footerbottom_texts<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['footerbottom_texts'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[footerbottom_texts][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['footerbottom_texts'][$store['store_id']]; ?>" placeholder="Texts color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_footerbottom_bg<?php echo $store["store_id"]; ?>">Background color:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_footerbottom_bg<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['footerbottom_bg'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[footerbottom_bg][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['footerbottom_bg'][$store['store_id']]; ?>" placeholder="Background color:" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="customisation_colors_footerbottom_icons<?php echo $store["store_id"]; ?>">Icons color:</label>
                    <div class="col-sm-7">
                        <input class="form-control width_auto" id="customisation_colors_footerbottom_icons<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_colors_store['footerbottom_icons'][$store['store_id']]; ?>;color:white" type="text" name="customisation_colors_store[footerbottom_icons][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_colors_store['footerbottom_icons'][$store['store_id']]; ?>" placeholder="Icons color:" />
                    </div>
                </div>
            </div>
            <!--subtabs: Footer / Bottom Info Block-->

        </div>


    </div>
    <!-------------------------------------end tab Colors,backgrounds,fonts-->

    <!-------------------------------------tab Products sliders, products listings-->
    <div class="tab-pane" id="tab-products<?php echo $store['store_id']; ?>">

        <ul class="nav nav-tabs col-sm-3 main_tabs_vertical">
            <li class="active"><a href="#tab-products-layout1-<?php echo $store['store_id']; ?>" class="selected" data-toggle="tab">Listings</a></li>
            <li><a href="#tab-products-layout2-<?php echo $store['store_id']; ?>" data-toggle="tab">Product labels</a></li>
            <li><a href="#tab-products-layout3-<?php echo $store['store_id']; ?>" data-toggle="tab">Product Page</a></li>
        </ul>
        <div class="tab-content col-sm-8">
            <!--subtabs: Listings -->
            <div class="tab-pane active" id="tab-products-layout1-<?php echo $store['store_id']; ?>">
                <div class="form-group">
                    <label class="col-sm-6 control-label" for="input-product_catalog_mode">
                                                        <span data-toggle="tooltip" title="Create your listings into simple catalog.">
                                                             Catalog mode:
                                                        </span>
                    </label>
                    <div class="col-sm-6">
                        <select name="customisation_products_store[product_catalog_mode][<?php echo $store["store_id"]; ?>]" id="input-product_catalog_mode" class="form-control">
                            <option <?php if (isset($customisation_products_store['product_catalog_mode'][$store['store_id']]) && $customisation_products_store['product_catalog_mode'][$store['store_id']] == 0) : ?> selected="selected" <?php endif; ?> value="0">Disable catalog mode</option>
                            <option <?php if (isset($customisation_products_store['product_catalog_mode'][$store['store_id']]) && $customisation_products_store['product_catalog_mode'][$store['store_id']] == 1) : ?> selected="selected" <?php endif; ?> value="1">Enable catalog mode</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-6 control-label" for="input-product_listing_type">
                         <span data-toggle="tooltip" title="Choose product image preview size in listing.">
                             Product listing type:
                         </span>
                    </label>
                    <div class="col-sm-6">
                        <select name="customisation_products_store[product_listing_type][<?php echo $store["store_id"]; ?>]" id="input-product_listing_type" class="form-control">
                            <option <?php if (isset($customisation_products_store['product_listing_type'][$store['store_id']]) && $customisation_products_store['product_listing_type'][$store['store_id']] == 'small_with_column') : ?> selected="selected" <?php endif; ?> value="small_with_column">Simple listing with left column</option>
                            <option <?php if (isset($customisation_products_store['product_listing_type'][$store['store_id']]) && $customisation_products_store['product_listing_type'][$store['store_id']] == 'small_without_column') : ?> selected="selected" <?php endif; ?> value="small_without_column">Simple listing without left column</option>
                            <option <?php if (isset($customisation_products_store['product_listing_type'][$store['store_id']]) && $customisation_products_store['product_listing_type'][$store['store_id']] == 'slick_with_column') : ?> selected="selected" <?php endif; ?> value="slick_with_column">Slick listing with left column</option>
                            <option <?php if (isset($customisation_products_store['product_listing_type'][$store['store_id']]) && $customisation_products_store['product_listing_type'][$store['store_id']] == 'slick_without_column') : ?> selected="selected" <?php endif; ?> value="slick_without_column">Slick listing without left column</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">"Quick view" type in carousel sliders:</label>
                    <div class="col-sm-6">
                        <select name="customisation_products_store[quick_sliders_type][<?php echo $store["store_id"]; ?>]" class="form-control">
                            <option <?php if (isset($customisation_products_store['quick_sliders_type'][$store['store_id']]) && $customisation_products_store['quick_sliders_type'][$store['store_id']] == 1) : ?> selected="selected" <?php endif; ?> value="1">Inline type</option>
                            <option <?php if (isset($customisation_products_store['quick_sliders_type'][$store['store_id']]) && $customisation_products_store['quick_sliders_type'][$store['store_id']] == 2) : ?> selected="selected" <?php endif; ?> value="2">Popup window</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">"Quick view" type in "Slick" sliders:</label>
                    <div class="col-sm-6">
                        <select name="customisation_products_store[quick_sliders_slick_type][<?php echo $store["store_id"]; ?>]" class="form-control">
                            <option <?php if (isset($customisation_products_store['quick_sliders_slick_type'][$store['store_id']]) && $customisation_products_store['quick_sliders_slick_type'][$store['store_id']] == 1) : ?> selected="selected" <?php endif; ?> value="1">Inline type</option>
                            <option <?php if (isset($customisation_products_store['quick_sliders_slick_type'][$store['store_id']]) && $customisation_products_store['quick_sliders_slick_type'][$store['store_id']] == 2) : ?> selected="selected" <?php endif; ?> value="2">Popup window</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">"Quick view" type in listings:</label>
                    <div class="col-sm-6">
                        <select name="customisation_products_store[quick_listing_type][<?php echo $store["store_id"]; ?>]" id="input-quick_listing_type" class="form-control">
                            <option <?php if (isset($customisation_products_store['quick_listing_type'][$store['store_id']]) && $customisation_products_store['quick_listing_type'][$store['store_id']] == 1) : ?> selected="selected" <?php endif; ?> value="1">Inline type</option>
                            <option <?php if (isset($customisation_products_store['quick_listing_type'][$store['store_id']]) && $customisation_products_store['quick_listing_type'][$store['store_id']] == 2) : ?> selected="selected" <?php endif; ?> value="2">Popup window</option>
                        </select>
                    </div>
                </div>
            </div>

            <!--subtabs: labels -->
            <div id="tab-products-layout2-<?php echo $store['store_id']; ?>" class="tab-pane">
            <div class="form-group">
                <label class="col-sm-4 control-label">Show "Sale" label:</label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <?php if ($customisation_products_store["sale_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[sale_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[sale_status][<?php echo $store["store_id"]; ?>]" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (!$customisation_products_store["sale_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[sale_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[sale_status][<?php echo $store["store_id"]; ?>]" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="sale_text1">Title for "Sale" label:</label>
                <div class="col-sm-8">
                    <ul class="nav nav-tabs" id="sale_text">
                        <?php foreach ($languages as $language) : ?>
                        <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#sale_text<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach ($languages as $language) : ?>
                        <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="sale_text<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                            <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][sale_text][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['sale_text'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['sale_text'][$store['store_id']] : ''; ?>" placeholder="'Sale' label title:" id="sale_text1" class="form-control" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="customisation_products_sale_label_bg<?php echo $store["store_id"]; ?>">
                                                        <span data-toggle="tooltip" title="Set background color of 'Sale' label.">
                                                            Color of "Sale" label:
                                                        </span>
                </label>
                <div class="col-sm-8">
                    <input class="form-control width_auto" id="customisation_products_sale_label_bg<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_products_store['sale_label_bg'][$store['store_id']]; ?>;color:white" type="text" name="customisation_products_store[sale_label_bg][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_products_store['sale_label_bg'][$store['store_id']]) ? $customisation_products_store['sale_label_bg'][$store['store_id']] : ''); ?>" placeholder="Color of 'Sale' label:" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Show "New" label:</label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <?php if ($customisation_products_store["new_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[new_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[new_status][<?php echo $store["store_id"]; ?>]" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (!$customisation_products_store["new_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[new_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[new_status][<?php echo $store["store_id"]; ?>]" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="new_text1">Title for "New" label:</label>
                <div class="col-sm-8">
                    <ul class="nav nav-tabs" id="new_text">
                        <?php foreach ($languages as $language) : ?>
                        <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#new_text<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach ($languages as $language) : ?>
                        <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="new_text<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                            <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][new_text][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['new_text'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['new_text'][$store['store_id']] : ''; ?>" placeholder="'new' label title:" id="new_text1" class="form-control" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="input-days">
                    <span data-toggle="tooltip" title="Number of days from the date "Date Available" to today date for a product.">
                    Period of holding "New" label:
                    </span>
                </label>
                <div class="col-sm-8">
                    <input type="text" name="customisation_products_store[days][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_products_store['days'][$store['store_id']]) ? $customisation_products_store['days'][$store['store_id']] : ''); ?>" placeholder="Period of holding 'New' label:" id="input-days" class="form-control width_auto" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="customisation_products_new_label_bg<?php echo $store["store_id"]; ?>">
                                                        <span data-toggle="tooltip" title="Set background color of 'New' label.">
                                                            Color of "New" label:
                                                        </span>
                </label>
                <div class="col-sm-8">
                    <input class="form-control width_auto" id="customisation_products_new_label_bg<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_products_store['new_label_bg'][$store['store_id']]; ?>;color:white" type="text" name="customisation_products_store[new_label_bg][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_products_store['new_label_bg'][$store['store_id']]; ?>" placeholder="Color of 'New' label:" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="customisation_products_discount_label_bg<?php echo $store["store_id"]; ?>">
                                                        <span data-toggle="tooltip" title="Set background color of 'Discount' label.">
                                                            Color of "Discount" label:
                                                        </span>
                </label>
                <div class="col-sm-8">
                    <input class="form-control width_auto" id="customisation_products_discount_label_bg<?php echo $store["store_id"]; ?>" style="background-color:<?php echo $customisation_products_store['discount_label_bg'][$store['store_id']]; ?>;color:white" type="text" name="customisation_products_store[discount_label_bg][<?php echo $store["store_id"]; ?>]" value="<?php echo $customisation_products_store['discount_label_bg'][$store['store_id']]; ?>" placeholder="Color of 'Discount' label:" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">
                    <span data-toggle="tooltip" title="Set display or not 'QUICK VIEW' function on products in sliders.">Show "QUICK VIEW" function:</span>
                </label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <?php if ($customisation_products_store["quick_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[quick_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[quick_status][<?php echo $store["store_id"]; ?>]" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (!$customisation_products_store["quick_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[quick_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[quick_status][<?php echo $store["store_id"]; ?>]" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="quick_view_text1">Title for "Quick view" label:</label>
                <div class="col-sm-8">
                    <ul class="nav nav-tabs" id="quick_view_text">
                        <?php foreach ($languages as $language) : ?>
                        <li class="<?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>"><a href="#quick_view_text<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach ($languages as $language) : ?>
                        <div class="tab-pane <?php echo ($language['language_id'] == 1 ? 'active' : ''); ?>" id="quick_view_text<?php echo $language['language_id']; ?>-<?php echo $store["store_id"]; ?>">
                            <input type="text" name="customisation_general_store[<?php echo $language['language_id']; ?>][quick_view_text][<?php echo $store["store_id"]; ?>]" value="<?php echo isset($customisation_general_store[$language['language_id']]['quick_view_text'][$store['store_id']]) ? $customisation_general_store[$language['language_id']]['quick_view_text'][$store['store_id']] : ''; ?>" placeholder="'Quick view' label title:" id="quick_view_text1" class="form-control" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>






            <div class="form-group">
                <label class="col-sm-4 control-label">
                    <span data-toggle="tooltip" title="Set display or not 'Discount' label.">Show "Discount" label:</span>
                </label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <?php if ($customisation_products_store["discount_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[discount_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[discount_status][<?php echo $store["store_id"]; ?>]" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (!$customisation_products_store["discount_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[discount_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[discount_status][<?php echo $store["store_id"]; ?>]" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">
                    <span data-toggle="tooltip" title="Set display or not countdown of Special Offer in product sliders.">Show countdown of Special Offer:</span>
                </label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <?php if ($customisation_products_store["countdown_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[countdown_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[countdown_status][<?php echo $store["store_id"]; ?>]" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (!$customisation_products_store["countdown_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[countdown_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[countdown_status][<?php echo $store["store_id"]; ?>]" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Show popup box (rating,quick view)</label>
                <div class="col-sm-8">
                    <label class="radio-inline">
                        <?php if ($customisation_products_store["popup_small_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[popup_small_status][<?php echo $store["store_id"]; ?>]" value="1" checked="checked" />
                        <?php echo $text_yes; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[popup_small_status][<?php echo $store["store_id"]; ?>]" value="1" />
                        <?php echo $text_yes; ?>
                        <?php } ?>
                    </label>
                    <label class="radio-inline">
                        <?php if (!$customisation_products_store["popup_small_status"][$store['store_id']]) { ?>
                        <input type="radio" name="customisation_products_store[popup_small_status][<?php echo $store["store_id"]; ?>]" value="0" checked="checked" />
                        <?php echo $text_no; ?>
                        <?php } else { ?>
                        <input type="radio" name="customisation_products_store[popup_small_status][<?php echo $store["store_id"]; ?>]" value="0" />
                        <?php echo $text_no; ?>
                        <?php } ?>
                    </label>
                </div>
            </div>

            </div>

            <!--subtabs: product page -->
            <div id="tab-products-layout3-<?php echo $store['store_id']; ?>" class="tab-pane">
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="input-related<?php echo $store["store_id"]; ?>">"Related products" module in right column (right column on Product Page):</label>
                    <div class="col-sm-7">
                        <select name="customisation_products_store[related][<?php echo $store["store_id"]; ?>]" id="input-related<?php echo $store["store_id"]; ?>" class="form-control">
                            <option <?php if ($customisation_products_store['related'][$store['store_id']] == 'enable') : ?> selected="selected" <?php endif; ?> value="enable">Enable Related block</option>
                            <option <?php if ($customisation_products_store['related'][$store['store_id']] == 'disable') : ?> selected="selected" <?php endif; ?> value="disable">Disable Related block</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-5 control-label">
                        <span data-toggle="tooltip" title="Use any type of images.">Image for video button on Product Page.</span>
                    </label>
                    <div class="col-sm-7">
                            <span>Upload video image in path: image/catalog/ and write here only name, for example: product-video.jpg</span><br><br>
                            <input type="text" name="customisation_products_store[video_image][<?php echo $store["store_id"]; ?>]" value="<?php echo (isset($customisation_products_store['video_image'][$store['store_id']]) ? $customisation_products_store['video_image'][$store['store_id']] : ''); ?>" placeholder="Image for video" id="video_image<?php echo $store["store_id"]; ?>" class="form-control" />
                    </div>
                </div>


                <fieldset>
                    <legend>Social buttons on Product Page</legend>
                    <div class="form-group">
                        <label class="col-sm-5 control-label" for="product_page_button<?php echo $store["store_id"]; ?>">
                                                            <span data-toggle="tooltip" title="Here you can enter any html of iframe content of buttons">
                                                                Content for buttons:
                                                            </span>
                        </label>
                        <div class="col-sm-7">
                            <textarea name="customisation_products_store[product_page_button][<?php echo $store["store_id"]; ?>]" rows="5" placeholder="Footer payment icons images:" id="product_page_button<?php echo $store["store_id"]; ?>" class="form-control"><?php echo (isset($customisation_products_store['product_page_button'][$store['store_id']]) ? $customisation_products_store['product_page_button'][$store['store_id']] : ''); ?></textarea>
                        </div>
                    </div>

                </fieldset>

            </div>
        </div>

    </div>
    <!------------------------------------end tab Products sliders, products listings-->

</div>


<script type="text/javascript">
    $current_val = $("#layout_skin<?php echo $store["store_id"]; ?> option:selected").val();
    if ($current_val == 'lingerie') {
        $("#lingerie_skin<?php echo $store["store_id"]; ?>").show();
    }
    function getVal<?php echo $store["store_id"]; ?>(sel) {
        if (sel.value == 'lingerie'){
            $("#lingerie_skin<?php echo $store["store_id"]; ?>").show();
        } else {
            $("#lingerie_skin<?php echo $store["store_id"]; ?>").hide();
        }
    }

</script>