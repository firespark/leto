                                <div class="calc__block">
                                    <div class="calc__name"><?php echo $fieldsArr['calc_fields_extra_info'];?></div>
                                    <div class="calc__half">
                                        
                                        <select name="package" data-class-modif="form" data-name="<?php echo $fieldsArr['calc_fields_package'];?>">
                                            <option value="" selected><?php echo $fieldsArr['calc_fields_package_choose'];?></option>
                                            <?php if(!empty($fieldsArr['calc_package'])):?>
                                            <?php foreach($fieldsArr['calc_package'] as $package):?>
                                            <option value="<?php echo $package['package'];?>"><?php echo $package['package'];?></option>
                                            <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                        
                                        <div class="form__input-parent form_span_label_wrapper">
                                            <input id="cargo_places" autocomplete="off" type="text" name="comment" placeholder="<?php echo $fieldsArr['calc_fields_comment_placeholder'];?>"
                                                   class="input calc-input-verification" id="cargo_extra_comment" style="padding-top: 25px;resize: both"
                                                   data-max="<?php echo $fieldsArr['calc_max_places'];?>">
                                            
                                            <label for="cargo_places" class="form__input-label" style="top: 10px"><?php echo $fieldsArr['calc_fields_comment'];?></label>
                                            <span class="calc__sizescont"><?php echo $fieldsArr['calc_fields_comment_measure'];?></span>
                                        </div>
                                    </div>
                                </div>