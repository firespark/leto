                                <div class="calc__block">
                                    <div class="calc__name"><?php echo $fieldsArr['calc_fields_client_info'];?></div>
                                    <div class="calc__left-2row">
                                        
                                        <!-- ФИО -->
                                        <input id="calcFio" autocomplete="off" data-error="Обязательное поле" data-required type="text"
                                            name="fio" placeholder="<?php echo $fieldsArr['calc_fields_fio'];?>" class="input">
                                        
                                        <!-- Телефон -->
                                        <input id="calcMobile" autocomplete="off" type="text" name="phone" placeholder="<?php echo $fieldsArr['calc_fields_phone'];?>" class="input phone_mask calc-input-verification" data-error="Обязательное поле" data-required>
                                    </div>
                                    <div class="calc__left-2row">
                                        <div class="calc__left-2left">
                                            
                                            <!-- Email -->
                                            <input id="calcEmail" autocomplete="off" type="text" name="email" placeholder="<?php echo $fieldsArr['calc_fields_email'];?>" class="input">
                                            
                                            <!-- Компания -->
                                            <input id="calcCompany" autocomplete="off" type="text" name="company" placeholder="<?php echo $fieldsArr['calc_fields_company'];?>"
                                                class="input">
                                            
                                            <!-- ИНН -->
                                            <div class="form__input-parent dropdown-input">
                                                <input id="calcInnHidden" autocomplete="off" type="hidden" value="">
                                                <input id="calcInn" autocomplete="off" data-required type="text" name="inn"
                                                       placeholder="<?php echo $fieldsArr['calc_fields_inn'];?>" class="input" value="" style="padding-top: 0.6875rem;">
                                                <div class="calcInnSearch select__options" style="z-index: 1;" hidden>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <!-- Комментарий -->
                                        <textarea autocomplete="off" name="person_comment" placeholder="<?php echo $fieldsArr['calc_fields_client_comment'];?>"
                                            class="input"></textarea>
                                    </div>
                                    <div class="calc__left-2row">
                                        
                                        <!-- Документ -->
                                        <!--<div class="popup__inputlabel popup__inputlabel-file">
                                            <label>
                                                <input id="formImage" type="file" name="document">
                                                <div class="popup__inputlabel-filebutton button"><span><?php //echo $fieldsArr['calc_fields_add_doc'];?></span>
                                                </div>
                                            </label>
                                        </div>-->
                                    </div>
                                    <div class="checkbox calc__left-2check">

                                        <!-- Политика конфиденциальности -->
                                        <input id="c_2" data-required checked class="checkbox__input" type="checkbox" value="1"
                                            name="agree">
                                        <label id="c_2_label" for="c_2" class="checkbox__label"><span class="checkbox__text"><?php echo $fieldsArr['calc_fields_policy'];?></span></label>
                                    </div>
                                </div>