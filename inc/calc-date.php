                                <div class="calc__block calc__block-bb">
                                    <div class="calc__name"><?php echo $fieldsArr['calc_fields_date'];?></div>
                                    <div class="calc__datepicker _icon-calendar">
                                        <input id="calcDeliveryDate" data-datepicker data-required autocomplete="off" type="text" name="date"
                                            placeholder="<?php echo $datetime->format('d.m.Y');?>" class="input" value="<?php echo $datetime->format('d.m.Y');?>">
                                    </div>
                                </div>