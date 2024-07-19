                                <div class="calc__block calc__block-bb">
                                    <div class="calc__name"><?php echo $fieldsArr['calc_fields_cargo_data'];?></div>
                                    <div class="calc__sizes">
                                        <div class="calc__half calcCargoWrapper">
                                            <div class="form__input-parent dropdown-input">
                                                <input id="calcCargoTitleHidden" autocomplete="off" type="hidden" value="">
                                                <input id="calcCargoTitle" autocomplete="off" data-required type="text" name="cargo_title"
                                                       placeholder="<?php echo $fieldsArr['calc_fields_cargo_placeholder'];?>" class="input calc-input-verification" value="">
                                                <label for="calcCargoTitle" class="form__input-label"><?php echo $fieldsArr['calc_fileds_cargo_title'];?></label>
                                                <div class="calcCargoSearch select__options" style="z-index: 1;" hidden>
                                                    <!--<div class="select__scroll">
                                                        <button class="select__option" data-value="1" type="button"><strong>ме</strong>бель
                                                        </button>
                                                        <button class="select__option" data-value="2" type="button"><strong>ме</strong>дтовары
                                                        </button>
                                                        <button class="select__option" data-value="3" type="button">кос<strong>ме</strong>тика
                                                        </button>
                                                        <button class="select__option" data-value="4" type="button"><strong>ме</strong>х
                                                        </button>
                                                    </div>-->
                                                </div>
                                            </div>
                                            <!--<ul id="searchResults">
                                            </ul>-->
                                            <div class="calc__errorblock"><?php echo $fieldsArr['calc_fields_cargo_error'];?></div>
                                            <!--<select name="form[]" data-required data-class-modif="form">
                                                <option value="" selected>Строительные материалы</option>
                                                <option value="1">Пункт №1</option>
                                                <option value="2">Пункт №2</option>
                                                <option value="3">Пункт №3</option>
                                                <option value="4">Пункт №4</option>
                                            </select>-->
                                        </div>
                                        <div class="calc__sizescont form__input-parent">
                                            <input autocomplete="off" data-required type="text" name="cargo_weight" placeholder="<?php echo $fieldsArr['calc_fields_cargo_weight_placeholder'];?>"
                                                class="input calc-input-verification" id="cargo_weight" data-max="<?php echo $fieldsArr['calc_max_weight'];?>">
                                            <label for="calcCargoTitle" class="form__input-label">Вес (макс. <?php echo $fieldsArr['calc_max_weight'];?>)</label>
                                            <span class="calc__sizescont"><?php echo $fieldsArr['calc_fields_cargo_measure'];?></span>
                                        </div>
                                        <div class="calc__sizescont form__input-parent">
                                            <input autocomplete="off" data-required type="text" name="cargo_size" placeholder="<?php echo $fieldsArr['calc_fields_cargo_size_placeholder'];?>"
                                                class="input calc-input-verification" id="cargo_size" data-max="<?php echo $fieldsArr['calc_max_size'];?>">
                                            <label for="calcCargoTitle" class="form__input-label">Объём (макс. <?php echo $fieldsArr['calc_max_size'];?>)</label>
                                            <span class="calc__sizescont"><?php echo $fieldsArr['calc_fields_cargo_size_measure'];?></span>
                                        </div>
                                    </div>
                                </div>