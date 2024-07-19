                                <div class="calc__block">
                                    <div class="calc__name"><?php echo $fieldsArr['calc_fields_route'];?></div>
                                    <div class="calc__full calcAddressWrapper">
                                        <img class="calc__double_replace-image" src="<?php echo get_template_directory_uri();?>/img/replace.svg" alt="">
                                        <div class="form__input-parent dropdown-input">
                                            <input autocomplete="off" data-required type="text" name="form_route_begin" class="input calc-input-verification" id="form_route_begin" placeholder="<?php echo $fieldsArr['calc_fields_route_from_placeholder'];?>">
                                            <label for="form_route_begin" class="form__input-label"><?php echo $fieldsArr['calc_fields_route_from'];?></label>
                                            <div class="calcAddressStartSearch select__options" style="z-index: 1;" hidden>
                                                
                                            </div>
                                        </div>
                                        <div class="form__input-parent dropdown-input">
                                            <input autocomplete="off" data-required type="text" name="form_route_end" class="input calc-input-verification" id="form_route_end" placeholder="<?php echo $fieldsArr['calc_fields_route_to_placeholder'];?>">
                                            <label for="form_route_end" class="form__input-label"><?php echo $fieldsArr['calc_fields_route_to'];?></label>
                                            <div class="calcAddressEndSearch select__options" style="z-index: 1;" hidden>
                                                
                                            </div>
                                        </div>
                                        <input type="hidden" name="route_begin_fias" id="route_begin_fias">
                                        <input type="hidden" name="route_begin_fiasId" id="route_begin_fiasId">
                                        <input type="hidden" name="route_begin_fiasRegion" id="route_begin_fiasRegion">
                                        <input type="hidden" name="route_begin_lat" id="route_begin_lat">
                                        <input type="hidden" name="route_begin_long" id="route_begin_long">
                                        
                                        <input type="hidden" name="route_end_fias" id="route_end_fias">
                                        <input type="hidden" name="route_end_fiasId" id="route_end_fiasId">
                                        <input type="hidden" name="route_end_fiasRegion" id="route_end_fiasRegion">
                                        <input type="hidden" name="route_end_lat" id="route_end_lat">
                                        <input type="hidden" name="route_end_long" id="route_end_long">

                                        <div class="calc__errorblock"><?php echo $fieldsArr['calc_fields_route_error'];?></div>
                                    </div>
                                </div>