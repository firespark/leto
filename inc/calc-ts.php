                                <div class="calc__block">
                                    <div class="calc__name"><?php echo $fieldsArr['calc_fields_choose_ts'];?></div>
                                    <div class="calc__half">

                                        <?php if(!empty($nomenclature_attrs['load_capacities'])):?>
                                        <select id="selectLoadCapacity" name="load_capacity" data-required data-class-modif="form" data-name="<?php echo $fieldsArr['calc_fields_load_capacity'];?>">
                                            <option value="" selected><?php echo $fieldsArr['calc_fields_load_capacity_choose'];?></option>
                                            <?php foreach($nomenclature_attrs['load_capacities'] as $load_capacity):?>
                                            <option value="<?php echo $load_capacity;?>"><?php echo $load_capacity;?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <?php endif;?>
                                        <?php if(!empty($nomenclature_attrs['body_types'])):?>
                                        <select id="selectBodyType" name="body_type" data-required data-class-modif="form" data-name="<?php echo $fieldsArr['calc_filelds_body_type'];?>">
                                            <option value="" selected><?php echo $fieldsArr['calc_filelds_body_type_choose'];?></option>
                                            <?php foreach($nomenclature_attrs['body_types'] as $body_type):?>
                                            <option value="<?php echo $body_type;?>"><?php echo $body_type;?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <?php endif;?>
                                    </div>
                                </div>